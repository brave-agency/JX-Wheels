<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.wearebfi.co.uk
 * @since      1.0.0
 *
 * @package    BFI_Finance_Calculator
 * @subpackage BFI_Finance_Calculator/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    BFI_Finance_Calculator
 * @subpackage BFI_Finance_Calculator/public
 * @author     BFI <info@wearebfi.co.uk>
 */


class BFI_Finance_Calculator_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $BFI_Finance_Calculator    The ID of this plugin.
	 */
	private $BFI_Finance_Calculator;
	const MIN_DEPOSIT = 0;
	const MAX_DEPOSIT = 100;
	const MIN_FINANCEABLE = 250;
	const DEFAULT_MIN_DEPOSIT = 10;
	const MIN_LOAN = 100;
	const MAX_LOAN = 15000;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *price
	 * @since    1.0.0
	 * @param      string    $BFI_Finance_Calculator       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $BFI_Finance_Calculator, $version ) {
		$this->BFI_Finance_Calculator = $BFI_Finance_Calculator;
		$this->version = $version;
		add_filter( 'woocommerce_product_tabs', array($this, 'woo_finance_tab' ) );
		add_action( 'woocommerce_after_shop_loop_item_title', array($this, 'v12_smallest_monthly_payment_display_shop') , 10);
		add_action( 'woocommerce_single_product_summary', array($this, 'v12_smallest_monthly_payment_display'), 20 );
		add_action( 'bfi_finance_calc_box', array($this, 'v12_show_finance'), 10 );
	}


	/**
	 * Display the finance from on the single product summary
	 *
	 * @since    1.0.0
	 * @param      string    $BFI_Finance_Calculator       Finance Calculator
	 * @param      string    $version    Finance Claculator
	 */
	public function v12_smallest_monthly_payment_display_shop() {
		$smallest_payment = $this->v12_get_smallest_monthly_payment();
		$options = get_option( 'woocommerce_v12retailfinance_settings', null );
		$min_payment = $options["enable_monthly_minimum_payments"];
		if ($smallest_payment == true && $smallest_payment != '0.00' && $smallest_payment != false && $min_payment == "yes") {
			echo apply_filters('bfi_finance_calc_payment_shop', "From &pound" . $smallest_payment . " Per Month*", $smallest_payment);
		}
	}

	/**
	 * Display the finance from on the shop loop
	 *
	 * @since    1.0.0
	 * @param      string    $BFI_Finance_Calculator       Finance Calculator
	 * @param      string    $version    Finance Claculator
	 */
	public function v12_smallest_monthly_payment_display() {
		$smallest_payment = $this->v12_get_smallest_monthly_payment();
		$options = get_option( 'woocommerce_v12retailfinance_settings', null );
		$min_payment = $options["enable_monthly_minimum_payments"];
		if ($smallest_payment == true && $smallest_payment != '0.00' && $smallest_payment != false && $min_payment == "yes") {
			echo apply_filters('bfi_finance_calc_payment', '<p class="price"><a href="#tab-finance_tab" id="finance-available">From &pound' . $smallest_payment . ' Per Month*</a></p>', $smallest_payment);
		}
	}

	/**
	 * Find the smallest possible monthly payment (taking in to account the maximum deposit). The
	 * return value is what is displayed in the woocommerce_after_shop_loop_item_title hook.
	 *
	 * @since    1.0.0
	 * @param      string    $BFI_Finance_Calculator       Finance Calculator
	 * @param      string    $version    Finance Claculator
	 */
	public function v12_get_smallest_monthly_payment() {
		global $wpdb;
		global $product;

		$price = $product->get_price();
		$price = (float)$price;

		// if we don't get a price then check if there are children to use instead
		if ( empty($price) ) {
			$child_prices     = array();
			foreach ( $product->get_children() as $child_id ) {
				$child = wc_get_product( $child_id );
				if ( '' !== $child->get_price() ) {
					$child_prices[] = 'incl' === $tax_display_mode ? wc_get_price_including_tax( $child ) : wc_get_price_excluding_tax( $child );
				}
			}

			if ( ! empty( $child_prices ) ) {
				$price = min( $child_prices );
			}
		}

		list($min_deposit_percentage, $max_deposit_percentage, $min_deposit_amount, $max_deposit_amount) = $this->get_min_max_deposit($price);

		$min_borrow_amount = $price - $min_deposit_amount;

		$max_discount = $this->calculate_discount();

		$product_table = $wpdb->prefix . BFI_WC_V12_TABLE;

		$db_finance_prods = $wpdb->get_results( $wpdb->prepare( "
			SELECT
				id,
				apr,
				deferred_period,
				description,
				months,
				monthly_rate,
				calculation_factor,
				service_fee,
				settlement_fee,
				name,
				product_guid,
				product_id,
				tag,
				wc_min_loan,
				wc_max_loan,
				wc_min_discount,
				wc_max_discount
			FROM
				{$product_table}
			WHERE
				state = 1
				AND is_enabled = 1
				AND wc_min_loan <= %f
				AND wc_min_discount <= %f
				AND wc_max_discount >= %f
			ORDER BY
				months DESC,
				monthly_rate ASC,
				months ASC
			LIMIT 1
		",  $min_borrow_amount, $max_discount, $max_discount ) );

		// get the variables
		$interest_rate = (float)$db_finance_prods[0]->monthly_rate * 12;
		$interest_rate = round($interest_rate,2,PHP_ROUND_HALF_EVEN);
		$calculation_factor = (float)$db_finance_prods[0]->calculation_factor;
		$apr = (float)$db_finance_prods[0]->apr;
		$months = (int)$db_finance_prods[0]->months;

		// start calclations
		$price = $price - (float)$min_deposit_amount;
		$interest = 0;
		$monthly_payment = 0;

		$monthly_payment = ($price + ((($price / 100) * $apr))) / $months;

		// round to the same precision as the JS script
		$monthly_payment =  round($monthly_payment,2,PHP_ROUND_HALF_EVEN);

		// make sure we include any trailing zeroes
		$monthly_payment = sprintf ("%.2f",$monthly_payment);

		if ($max_deposit_amount >= $min_deposit_amount){
			return $monthly_payment;
		}
		else {
			return false;
		}
	}

	/**
	 * Creates the finance tab, the tab is only created when finance options are available for a specific WooCommerce ID.
	 * The finance options are passed in callback_parameters to the v12_finance_tab_content() function.
	 *
	 * @since    1.0.0
	 * @param      string    $BFI_Finance_Calculator       Finance Calculator
	 * @param      string    $version    Finance Claculator
	 */
	public function woo_finance_tab( $tabs ) {
		global $wpdb;
		$options = get_option( 'woocommerce_v12retailfinance_settings', null );
		$calc_enabled = $options["enable_finance_calculator"];
		if ($calc_enabled == "yes") {
			$active_products = $wpdb->get_var($wpdb->prepare('SELECT COUNT(*) FROM ' . $wpdb->prefix . BFI_WC_V12_TABLE . ' WHERE state = %f AND is_enabled = %f',1,1));

			if ($active_products) {
				$available_finance = $this->pull_available_finance_options();
			}

			if (is_product() && is_woocommerce() && $active_products == true && $available_finance == true){
				$tabs['finance_tab'] = array(
					'title' 	=> __( 'Finance Options', 'woocommerce' ),
					'priority' 	=> apply_filters( 'bfi_finance_calc_tab_priority', 50),
					'callback' 	=> array ($this, 'v12_finance_tab_content' ),
					'callback_parameters' => array ($this, $available_finance)
				);
				return $tabs;
			}
		}
		else {
			return false;
		}
	}

	/**
	 * Pulls finance options which might be available to a product
	 *
	 *
	 * @since    1.0.0
	 * @param      string    $BFI_Finance_Calculator       Finance Calculator
	 * @param      string    $version    Finance Claculator
	 */
	public function pull_available_finance_options(){
		global $wpdb;
		global $product;

		$options = get_option( 'woocommerce_v12retailfinance_settings', null );

		$price = $product->price;
		$price = (float)$price;

		// if we don't get a price then check if there are children to use instead
		if ( empty($price) ) {
			$child_prices     = array();
			foreach ( $product->get_children() as $child_id ) {
				$child = wc_get_product( $child_id );
				if ( '' !== $child->get_price() ) {
					$child_prices[] = 'incl' === $tax_display_mode ? wc_get_price_including_tax( $child ) : wc_get_price_excluding_tax( $child );
				}
			}

			if ( ! empty( $child_prices ) ) {
				$price = min( $child_prices );
			}
		}

		list($min_deposit_percentage, $max_deposit_percentage, $min_deposit_amount, $max_deposit_amount) = $this->get_min_max_deposit($price);

		$min_borrow_amount = $price - $min_deposit_amount;

		$max_discount = $this->calculate_discount();

		$product_table = $wpdb->prefix . BFI_WC_V12_TABLE;
		$db_finance_prods = apply_filters( 'bfi_finance_calc_products', $wpdb->get_results( $wpdb->prepare( "
			SELECT
				id,
				apr,
				deferred_period,
				description,
				months,
				custom_label,
				monthly_rate,
				calculation_factor,
				service_fee,
				settlement_fee,
				name,
				product_guid,
				product_id,
				tag,
				wc_min_loan,
				wc_max_loan,
				wc_min_discount,
				wc_max_discount
			FROM
				{$product_table}
			WHERE
				state = 1
				AND is_enabled = 1
				AND wc_min_loan <= %f
				AND wc_min_discount <= %f
				AND wc_max_discount >= %f
			ORDER BY
				alt_tag ASC,
				monthly_rate ASC,
				months ASC
		",  $min_borrow_amount, $max_discount, $max_discount ) ) );

		return $db_finance_prods;
	}

	/**
	 * This is only called if a WooCommerce product has finance available, it sets up the content of the finance tab
	 *
	 * @since    1.0.0
	 * @param      string    $BFI_Finance_Calculator       Finance Calculator
	 * @param      string    $version    Finance Claculator
	 */
	public function v12_finance_tab_content($name,$tab_arr) {
		global $product;

		$db_finance_prods = $tab_arr["callback_parameters"]["1"];
		$options = get_option( 'woocommerce_v12retailfinance_settings', null );

		$price = $product->price;
		$price = (float)$price;

		// if we don't get a price then check if there are children to use instead
		if ( empty($price) ) {
			$child_prices     = array();
			foreach ( $product->get_children() as $child_id ) {
				$child = wc_get_product( $child_id );
				if ( '' !== $child->get_price() ) {
					$child_prices[] = 'incl' === $tax_display_mode ? wc_get_price_including_tax( $child ) : wc_get_price_excluding_tax( $child );
				}
			}

			if ( ! empty( $child_prices ) ) {
				$price = min( $child_prices );
			}
		}

		list($min_deposit_percentage, $max_deposit_percentage, $min_deposit_amount, $max_deposit_amount) = $this->get_min_max_deposit($price);

		$min_borrow_amount = $price - $min_deposit_amount;

		$max_discount = $this->calculate_discount();

		if ( ! empty( $db_finance_prods ) && $max_deposit_amount >= $min_deposit_amount) {
			// convert this into a key value array
			$finance_products = array();
			foreach ($db_finance_prods as $fprod) {
				$finance_products[$fprod->product_id] = $fprod;
			}
			$deposit_amount = $min_deposit_amount;
			$options = get_option( 'woocommerce_v12retailfinance_settings', null );
			$variable_deposit = $options["variable_deposit"];

			$order_total = $price;

			require ( plugin_dir_path(__FILE__) . 'partials/gateway-v12-finance-selection.php');

			wp_localize_script( 'v12_payment', 'v12_settings', array(
				'order_total' => $order_total,
				'deposit' => array(
					'min_percentage' => $min_deposit_percentage,
					'max_percentage' => $max_deposit_percentage,
					'min_amount' => $min_deposit_amount,
					'max_amount' => $max_deposit_amount
				)
			) );
			wp_localize_script( 'v12_payment', 'v12_products', $finance_products );
			wp_enqueue_script( 'v12_payment' );
			wp_enqueue_style( 'v12_payment' );
		}
		else {
			echo __('Payment error:', 'woothemes') . ' ' . __( 'Sorry, no finance products are available at this time.', 'woocommerce_v12retailfinance' );
		}
	}

	/**
	 * Gets the mimimum and maximum deposit amounts
	 *
	 * @since    1.0.0
	 * @param      string    $BFI_Finance_Calculator       Finance Calculator
	 * @param      string    $version    Finance Claculator
	 */
	public function get_min_max_deposit($price = 0) {
		global $wpdb;

		$options = get_option( 'woocommerce_v12retailfinance_settings', null );
		$min_deposit_percentage = $options["min_desposit_percentage"];

		//$max_deposit_persentage  = $options["max_desposit_percentage"];

		$min_deposit_amount = 0;

		if ( ! empty($min_deposit_percentage) && $min_deposit_percentage > 0) {
			$min_deposit_amount = ($min_deposit_percentage / 100) * $price;
		}

		$max_deposit_amount = $price;

		$max_deposit_percentage = self::MAX_DEPOSIT;
		$min_financeable = self::MIN_FINANCEABLE;

		if ( ! empty($min_financeable) && $min_financeable > 0) {
			$max_deposit_amount = $price - $min_financeable;
		}

		// get the maximum amount of finance available and check we aren't trying to go above that
		$product_table = $wpdb->prefix . BFI_WC_V12_TABLE;
		$max_finance_value = $wpdb->get_var( "
			SELECT
				wc_max_loan
			FROM
				{$product_table}
			WHERE
				state = 1
				AND is_enabled = 1
			ORDER BY
				wc_max_loan DESC
			LIMIT 1
		" );
		if ( $price > $max_finance_value ) {
			$finance_difference = $price - $max_finance_value;
			$min_deposit_amount += $finance_difference;
		}

		return array($min_deposit_percentage, $max_deposit_percentage, $min_deposit_amount, $max_deposit_amount);
	}

	/**
	 * Calculates the discount
	 *
	 * @since    1.0.0
	 * @param      string    $BFI_Finance_Calculator       Finance Calculator
	 * @param      string    $version    Finance Claculator
	 */
	private function calculate_discount() {
		global $woocommerce;
		global $product;

		$max_discount = 0;
		if ( $product->is_on_sale() ) {
			if ( $product->has_child() ) {
				// parent product - we need to get the child price to work out the amount discounted
				$sale_price = $product->price;
				$regular_price = $product->price;

				foreach ( $product->get_children() as $child_id ) {
					$child_price = get_post_meta( $child_id, '_price', true );
					if ( $child_price == $sale_price ) {
						$regular_price = get_post_meta( $child_id, '_regular_price', true );
					}
				}
				$discount_amount = $regular_price - $sale_price;
				$discount_percent = ($discount_amount / $regular_price) * 100;
				if ( $discount_percent > $max_discount) {
					$max_discount = $discount_percent;
				}
			}
			else {
				// simple product (so use price from this item)
				$discount_amount = $product->get_regular_price() - $product->get_sale_price();
				$discount_percent = ($discount_amount / $product->get_regular_price()) * 100;
				if ( $discount_percent > $max_discount) {
					$max_discount = $discount_percent;
				}
			}
		}

		return $max_discount;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		wp_register_style('v12_payment', plugin_dir_url( __FILE__ ) . 'css/bfi-woocommerce-v12-finance-public.css', array());
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		wp_register_script('v12_payment', plugin_dir_url( __FILE__ ) . 'js/bfi-woocommerce-v12-finance-public.js', array( 'jquery' ), false, true);
	}

	/**
	 * This is only called if a WooCommerce product has finance available, it sets up the content of the finance tab
	 *
	 * @since    1.0.0
	 * @param      string    $BFI_Finance_Calculator       Finance Calculator
	 * @param      string    $version    Finance Claculator
	 */
	public function v12_show_finance() {
		global $wpdb;
		global $product;

		// only show when calc is NOT enabled!
		$options = get_option( 'woocommerce_v12retailfinance_settings', null );
		$calc_enabled = $options["enable_finance_calculator"];
		if ($calc_enabled != "yes") {
			$available_finance = $this->pull_available_finance_options();

			$price = $product->price;
			$price = (float)$price;

			// if we don't get a price then check if there are children to use instead
			if ( empty($price) ) {
				$child_prices     = array();
				foreach ( $product->get_children() as $child_id ) {
					$child = wc_get_product( $child_id );
					if ( '' !== $child->get_price() ) {
						$child_prices[] = 'incl' === $tax_display_mode ? wc_get_price_including_tax( $child ) : wc_get_price_excluding_tax( $child );
					}
				}

				if ( ! empty( $child_prices ) ) {
					$price = min( $child_prices );
				}
			}

			list($min_deposit_percentage, $max_deposit_percentage, $min_deposit_amount, $max_deposit_amount) = $this->get_min_max_deposit($price);

			$min_borrow_amount = $price - $min_deposit_amount;

			$max_discount = $this->calculate_discount();

			if ( ! empty( $available_finance ) && $max_deposit_amount >= $min_deposit_amount) {
				// convert this into a key value array
				$finance_products = array();
				foreach ($available_finance as $fprod) {
					$finance_products[$fprod->product_id] = $fprod;
				}
				$deposit_amount = $min_deposit_amount;
				$options = get_option( 'woocommerce_v12retailfinance_settings', null );
				$variable_deposit = $options["variable_deposit"];

				$order_total = $price;

				require ( plugin_dir_path(__FILE__) . 'partials/gateway-v12-finance-selection.php');

				wp_localize_script( 'v12_payment', 'v12_settings', array(
					'order_total' => $order_total,
					'deposit' => array(
						'min_percentage' => $min_deposit_percentage,
						'max_percentage' => $max_deposit_percentage,
						'min_amount' => $min_deposit_amount,
						'max_amount' => $max_deposit_amount
					)
				) );
				wp_localize_script( 'v12_payment', 'v12_products', $finance_products );
				wp_enqueue_script( 'v12_payment' );
				wp_enqueue_style( 'v12_payment' );
			}
			else {
				echo __('Payment error:', 'woothemes') . ' ' . __( 'Sorry, no finance products are available at this time.', 'woocommerce_v12retailfinance' );
			}
		}
	}

}
