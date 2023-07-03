<?php

/**
 * V12 Finance WC Payment Gateway
 *
 * @link       http://www.wearebfi.co.uk
 * @since      1.0.0
 *
 * @package    BFI_Woocommerce_V12_Finance
 * @subpackage BFI_Woocommerce_V12_Finance/includes
 */

/**
 * This class extends the WC Payment Gateway class to make V12 appear
 * as a payment option during the checkout process
 *
 * @package    BFI_Woocommerce_V12_Finance
 * @subpackage BFI_Woocommerce_V12_Finance/admin
 * @author     BFI <info@wearebfi.co.uk>
 */
class BFI_WC_Gateway_V12_Finance_Gateway extends WC_Payment_Gateway {
	const MIN_DEPOSIT = 0;
	const MAX_DEPOSIT = 75;
	const MIN_FINANCEABLE = 250;
	const DEFAULT_MIN_DEPOSIT = 10;
	const MIN_LOAN = 100;
	const MAX_LOAN = 15000;

	/**
	 * V12 Options.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      array    $options    Currently set options.
	 */
	private $options;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $BFI_Woocommerce_V12_Finance       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct(  ) {
		// Set WC details
		$this->id                   = 'v12retailfinance';
		$this->icon                 = plugin_dir_url( __FILE__ ) . '../public/images/v12-retail-finance-logo.png';
		$this->has_fields           = false;
		$this->method_title         = __( 'V12 Retail Finance', 'woocommerce_v12retailfinance' );
		$this->method_description   = $this->v12_description();

		// set V12 Specific details
		$this->api_url = BFI_WC_V12_API_URL;

		// Load the form fields
		$this->init_form_fields();

		// Load the settings.
		$this->init_settings();

		// set the title
		$this->title = $this->get_option( 'title' );
		$this->description = $this->get_option( 'description' );

		// hook to save the settings
		add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options' ) );
		add_action( 'woocommerce_update_options_payment_gateways', array( &$this, 'process_admin_options' ) );
		// add hook for receipt page
		add_action( 'woocommerce_receipt_' . $this->id, array( $this, 'receipt_page' ) );

		// set V12 Specific details
		$this->options = get_option( 'woocommerce_v12retailfinance_settings', null );

		// Check that V12 has been configured
		add_action( 'admin_notices', array( $this, $this->id . '_check_config') );
	}

	/**
	 * Show Module Description
	 *
	 * @since    1.0.0
	 */
	private function v12_description() {
		// set the description here
		return __( 'V12 Retail Finance', 'woocommerce_v12retailfinance' );
	}

	/**
	 * Initialise Form Fields
	 *
	 * @since    1.0.0
	 */
	public function init_form_fields() {
		$wc_order_status = wc_get_order_statuses();

		$this->form_fields = apply_filters( 'bfi_v12_gateway_fields', array(
			'enabled' => array(
				'title' => __( 'Enable/Disable', 'woocommerce' ),
				'type' => 'checkbox',
				'label' => __( 'Enable V12 Retail Finance', 'woocommerce' ),
				'default' => 'yes'
			),
			'title' => array(
				'title' => __( 'Title', 'woocommerce' ),
				'type' => 'text',
				'description' => __( 'This controls the title which the user sees during checkout.', 'woocommerce' ),
				'default' => __( 'V12 Retail Finance', 'woocommerce_v12retailfinance' ),
				'desc_tip'      => true
			),
			'description' => array(
				'title' => __( 'Customer Message', 'woocommerce' ),
				'type' => 'textarea',
				'default' => __( 'Pay using our finance options', 'woocommerce_v12retailfinance' ),
				'description' => __( 'Please enter a description to appear on the checkout (required).', 'woocommerce_v12retailfinance' ),
			),
			'authentication_key' => array(
				'title' => __( 'Authentication Key', 'woocommerce_v12retailfinance' ),
				'type' => 'text',
				'description' => __( 'This should have been supplied by V12 Retail Finance when you created your account (required).', 'woocommerce_v12retailfinance' ),
				'default' => ''
			),
			'retailer_guid'  => array(
				'title' => __( 'Retailer Guid', 'woocommerce_v12retailfinance' ),
				'type' => 'text',
				'description' => __( 'This should have been supplied by V12 Retail Finance when you created your account (required).', 'woocommerce_v12retailfinance' ),
				'default' => ''
			),
			'retailer_id' => array(
				'title' => __( 'Retailer Id', 'woocommerce_v12retailfinance' ),
				'type' => 'text',
				'description' => __( 'This should have been supplied by V12 Retail Finance when you created your account (required).', 'woocommerce_v12retailfinance' ),
				'default' => ''
			),
			'min_desposit_percentage' => array(
				'title' => __( 'Minimum Deposit Percentage', 'woocommerce_v12retailfinance' ),
				'type' => 'text',
				'description' => sprintf(__( 'This value should be between %d and %d. If not set, the standard value will be %d.', 'woocommerce_v12retailfinance' ), self::MIN_DEPOSIT, self::MAX_DEPOSIT, self::MIN_DEPOSIT),
				'default' => self::DEFAULT_MIN_DEPOSIT
			),
			'variable_deposit' => array(
				'title' => __( 'Variable Deposit', 'woocommerce_v12retailfinance' ),
				'type' => 'select',
				'description' => __( 'Enable or disable variable deposit.', 'woocommerce_v12retailfinance' ),
				'default' => 'yes',
				'options' => array(
					'yes' => __( 'Yes', 'woocommerce_v12retailfinance' ),
					'no' => __( 'No', 'woocommerce_v12retailfinance' )
				)
			),
			'email_pending_status' => array(
				'title' => __( 'Customer E-mail: Pending V12 Result', 'woocommerce_v12retailfinance' ),
				'type' => 'textarea',
				'default' => __( 'Once your finance application has been fully approved by V12 we will be able to process your order for shipping, which may include a lead time if the item has to be ordered from our supplier.', 'woocommerce_v12retailfinance' ),
				'description' => __( 'Please enter a description to appear on the e-mail to the customer when V12 is pending.', 'woocommerce_v12retailfinance' ),
			),
			'email_completed_status' => array(
				'title' => __( 'Customer E-mail: Completed V12 Result', 'woocommerce_v12retailfinance' ),
				'type' => 'textarea',
				'default' => __( 'Your finance application has been fully approved by V12. We will now process your order for shipping.', 'woocommerce_v12retailfinance' ),
				'description' => __( 'Please enter a description to appear on the e-mail to the customer when V12 has approved finance.', 'woocommerce_v12retailfinance' ),
			),
			'stop_on_coupon' => array(
				'title' => __( 'Don\'t allow Coupons', 'woocommerce_v12retailfinance' ),
				'type' => 'select',
				'description' => __( 'Stop the user from checking out with finance when using Coupon Codes', 'woocommerce_v12retailfinance' ),
				'default' => 'no',
				'options' => array(
					'yes' => __( 'Yes', 'woocommerce_v12retailfinance' ),
					'no' => __( 'No', 'woocommerce_v12retailfinance' )
				)
			),

		));
	}

	/**
	 * Extend the V12 Admin Options to include a table of the products
	 *
	 * @since    1.0.0
	 */
	function admin_options() {
		global $wpdb;

		// build the admin options screen
		echo '<h2>' . $this->method_title . '</h2>';

		echo '<p><a href="/wp-admin/admin.php?page=bfi_wc_v12_key">Click here to check Licence Key and Activate.</a></p>';

		echo '<table class="form-table">';
		echo $this->generate_settings_html();
		echo '</table>';

		// add the table of available options
		echo '<h3>' . __('V12 Available Finance Options', 'woocommerce_v12retailfinance') . '</h3>';
		echo '<p><strong>' . __('Please Note:', 'woocommerce_v12retailfinance') . '</strong> ';
		echo sprintf(__( 'If no minimum or maximum values are entered and saved, then it will default to the minimum value of %d and a maximum value of %d.', 'woocommerce_v12retailfinance' ), self::MIN_LOAN, self::MAX_LOAN);
		echo '</p><p>';
		echo __('When setting the min/max Discount values, to exclude any discounted products make sure both min and max are set to 0.', 'woocommerce_v12retailfinance');
		echo '</p>';

		// grab all the options from the DB
		$results = $wpdb->get_results('
			SELECT
				id,
				name,
				is_enabled,
				wc_min_loan,
				wc_max_loan,
				wc_min_discount,
				wc_max_discount
			FROM
				' . $wpdb->prefix . BFI_WC_V12_TABLE . '
			WHERE
				state = 1
			ORDER BY
				alt_tag ASC,
				monthly_rate ASC,
				months ASC
		');

		if ( count($results) ) {

			echo '<table>';

			echo '<th>' . __( 'Product', 'woocommerce_v12retailfinance' ) . '</th>';
			echo '<th>' . __( 'Enabled', 'woocommerce_v12retailfinance' ) . '</th>';
			echo '<th>' . __( 'Minimum Value', 'woocommerce_v12retailfinance' ) . '</th>';
			echo '<th>' . __( 'Maximum Value', 'woocommerce_v12retailfinance' ) . '</th>';
			echo '<th>' . __( 'Minimum Discount', 'woocommerce_v12retailfinance' ) . '</th>';
			echo '<th>' . __( 'Maximum Discount', 'woocommerce_v12retailfinance' ) . '</th>';
			echo '</tr>';

			foreach ($results as $row) {

				echo '<tr>';
				echo '<td>' . $row->name . '</td>';
				echo '<td><input type="checkbox" name="v12prod[' . $row->id . '][enabled]" value="1"' . ($row->is_enabled ? ' checked' : '') . '></td>';
				echo '<td><input type="text" class="bfi_min_value" name="v12prod[' . $row->id . '][min_val]" value="' . $row->wc_min_loan . '"></td>';
				echo '<td><input type="text" name="v12prod[' . $row->id . '][max_val]" value="' . $row->wc_max_loan . '"></td>';
				echo '<td><input type="text" name="v12prod[' . $row->id . '][min_disc]" value="' . $row->wc_min_discount . '"></td>';
				echo '<td><input type="text" name="v12prod[' . $row->id . '][max_disc]" value="' . $row->wc_max_discount . '"></td>';
				echo '</tr>';
			}

			echo '</table>';
		}
		else {
			// no options
			echo '<p><strong>' . __( 'Sorry, no finance products to display.', 'woocommerce_v12retailfinance' ) . '</strong></p>';
		}

		// build array of statuses (using filter, so can be changed by other plugins)
		$finance_status = apply_filters( 'bfi_v12_finance_status', array(
			'Acknowledged' => array(
				'v12' => 'Acknowledged',
				'wc' => 'Processing',
				'stage' => '1'
			),
			'Referred' => array(
				'v12' => 'Referred',
				'wc' => 'On Hold',
				'stage' => '2'
			),
			'Accepted' => array(
				'v12' => 'Accepted',
				'wc' => 'Processing',
				'stage' => '3'
			),
			'AwaitingFulfilment' => array(
				'v12' => 'Awaiting Fulfilment',
				'wc' => 'Processing',
				'stage' => '4'
			),
			'PaymentRequested' => array(
				'v12' => 'Payment Requested',
				'wc' => 'Completed',
				'stage' => '5'
			),
			'PaymentProcessed' => array(
				'v12' => 'Payment Processed',
				'wc' => 'Completed',
				'stage' => '6'
			),
			'Cancelled' => array(
				'v12' => 'Cancelled',
				'wc' => 'Cancelled',
				'stage' => ''
			),
			'Error' => array(
				'v12' => 'Error',
				'wc' => 'Cancelled',
				'stage' => ''
			),
			'Declined' => array(
				'v12' => 'Declined',
				'wc' => 'Cancelled',
				'stage' => ''
			)
		) );

		echo '<p><a href="' . wp_nonce_url( admin_url( 'admin-ajax.php?action=update_v12_products' ), 'update-v12-products' ) . '">' . __( 'Update Finance Products from V12.', 'woocommerce_v12retailfinance' ) . '</a></p>';

		echo '<h3>' . __('V12 Status Map', 'woocommerce_v12retailfinance') . '</h3>';

		echo '<p>' . __('A V12 applications status is shown in the WooCommerce `Orders` section, WooCommerce status types are mapped with  V12 status types below:', 'woocommerce_v12retailfinance') . '</p>';

		echo '<table class="widefat fixed" cellspacing="0">';
		echo '<tr>';
		echo '<th class="manage-column column-columnname" scope="col">' . __( 'V12 Status', 'woocommerce_v12retailfinance' ) . '</th>';
		echo '<th class="manage-column column-columnname" scope="col">' . __( 'WooCommerce Status', 'woocommerce_v12retailfinance' ) . '</th>';
		echo '<th class="manage-column column-columnname" scope="col">' . __( 'Stage', 'woocommerce_v12retailfinance' ) . '</th>';
		echo '</tr>';

		$row_count = 0;
		foreach ( $finance_status as $fs_key => $fs_details ) {
			$row_class = '';
			if ( $row_count == 0) {
				$row_class = ' class="alternate"';
			}
			echo '<tr' . $row_class . '>';
			echo '<td> ' . $fs_details['v12'] . ' </td>';
			echo '<td> ' . $fs_details['wc'] . ' </td>';
			echo '<td> ' . $fs_details['stage'] . ' </td>';
			echo '</tr>';
			$row_count++;
			$row_count %= 2;
		}
		echo '</table>';
	}

	/**
	 * Process changes tot he admin options
	 *
	 * @since    1.0.0
	 */
	function process_admin_options() {
		global $wpdb;

		// use the parent function to save the main options
		$updated = parent::process_admin_options();

		// now handle updating the V12 products
		if ( isset($_POST['v12prod']) && is_array($_POST['v12prod']) ) {
			foreach ($_POST['v12prod'] as $prod_id => $prod_options) {
				$enabled = ( ! empty($_POST['v12prod'][$prod_id]['enabled']) ? 1 : 0);

				// check the values entered
				$min_val = $_POST['v12prod'][$prod_id]['min_val'];
				if ( $min_val < self::MIN_LOAN || $min_val > self::MAX_LOAN) {
					$min_val = self::MIN_LOAN;
				}

				$max_val = $_POST['v12prod'][$prod_id]['max_val'];
				if ( $max_val < self::MIN_LOAN || $max_val > self::MAX_LOAN ) {
					$max_val = self::MAX_LOAN;
				}

				// only allow discount values between 0 and 100
				$min_disc = $_POST['v12prod'][$prod_id]['min_disc'];
				if ( $min_disc < 0 || $min_disc > 100 ) {
					$min_disc = 0;
				}

				$max_disc = $_POST['v12prod'][$prod_id]['max_disc'];
				if ( $max_disc < 0 || $max_disc > 100 ) {
					$max_disc = 100;
				}

				$wpdb->query(
					$wpdb->prepare( "
						UPDATE
							" . $wpdb->prefix . BFI_WC_V12_TABLE . "
						SET
							is_enabled = %d,
							wc_min_loan = %f,
							wc_max_loan = %f,
							wc_min_discount = %f,
							wc_max_discount = %f
						WHERE
							id = %d
						",
						$enabled,
						$min_val,
						$max_val,
						$min_disc,
						$max_disc,
						$prod_id
					)
				);
			}
		}

		return $updated;
	}

	/**
	 * Show Payment Fields & Description
	 *
	 * @since    1.0.0
	 */
	function payment_fields() {
		if ( $this->description ) {
			echo '<p>' . $this->description . '</p>';
		}

		// show the finance selection form
		$this->v12_finance_form();
	}

	/**
	 * Process the Select and save the details to the order
	 *
	 * @since    1.0.0
	 */
	function process_payment( $order_id ) {
		global $woocommerce;

		$order = new WC_Order( $order_id );

		// get the values from the form
		$finance_option 		= isset($_POST['v12_finance_option']) ? woocommerce_clean($_POST['v12_finance_option']) : '';
		$deposit_amount 		= isset($_POST['v12_deposit_amount']) ? woocommerce_clean($_POST['v12_deposit_amount']) : '';

		// get the finance product details from the DB
		$borrow_amount = $this->get_order_total() - $deposit_amount;
		$finance_product = $this->get_finance_product_details($finance_option, $borrow_amount);

		if ( empty($finance_option) || empty($finance_product) ) {
			throw new Exception( __( 'Please choose a valid finance option from the drop down', 'woocommerce_v12retailfinance' ) );
		}

		$order_total = $this->get_order_total();
		$min_deposit_amount = $order_total - $finance_product->wc_max_loan;
		if ( $min_deposit_amount < 0) {
			$min_deposit_amount = $finance_product->wc_min_loan;
		}
		$max_deposit_amount = $order_total - $finance_product->wc_min_loan;
		if ( $max_deposit_amount < 0) {
			$max_deposit_amount = $finance_product->wc_max_loan;
		}

		if ( empty($deposit_amount) || $deposit_amount < $min_deposit_amount || $deposit_amount > $max_deposit_amount) {
			throw new Exception( sprintf(__( 'Please enter a deposit amount between %.2f and %.2f', 'woocommerce_v12retailfinance' ), number_format($min_deposit_amount, 2, '.', ''), number_format($max_deposit_amount, 2, '.', '') ) );
		}

		// save the details to the order
		update_post_meta($order_id, '_v12_product', $finance_option);
		update_post_meta($order_id, '_v12_deposit', $deposit_amount);

		// Mark as on-hold (we're awaiting the finance decision)
		$order->update_status('wc-pending', __( 'Awaiting finance results.', 'woocommerce_v12retailfinance' ));

		// Reduce stock levels
		$order->reduce_order_stock();

		// Remove cart
		$woocommerce->cart->empty_cart();

		// Return redirect page
		return array(
                'result'    => 'success',
            	'redirect'	=> $order->get_checkout_payment_url( true )
		);
	}

	/**
	 * Show Receipt page
	 *
	 * @since    1.0.0
	 */
	function receipt_page( $order_id ) {
		global $wpdb;
		global $woocommerce;

		$order = new WC_Order( $order_id );

		// get the values from the form
		$finance_option = get_post_meta($order_id, '_v12_product', true);
		$deposit_amount = get_post_meta($order_id, '_v12_deposit', true);

		// get the finance product details from the DB
		$borrow_amount = $this->get_order_total() - $deposit_amount;
		$finance_product = $this->get_finance_product_details($finance_option, $borrow_amount);

		// build an array of order lines to add to the order
		$order_lines = array();
		$items = $order->get_items();
		if ( ! empty( $items ) ) {
			foreach( $items as $item ) {
				$item_details = new WC_Product($item['product_id']);
				$item_price =  number_format($item['line_total'] / $item['qty'], 2, '.', '');
				$order_lines[] = (object) array(
					'Item' => $item['name'],
					'Price' => number_format($item_price, 2, '.', ''),
					'Qty' => $item['qty'],
					'SKU' => $item_details->get_sku()
				);
			}
		}

		// build the details to send to V12
		$v12_request = (object) array(
			'Customer' => (object) array(
				'EmailAddress' => $order->billing_email,
				'FirstName' => $order->billing_first_name,
				'HomeTelephone' => (object) array(
					'Number' => $order->billing_phone
				),
				'LastName' => $order->billing_last_name
			),
			'Order' => (object) array(
				'CashPrice' => number_format($this->get_order_total(), 2, '.', ''),
				'Deposit' => number_format($deposit_amount, 2, '.', ''),
				'DuplicateSalesReferenceMethod' => 'ShowError',
				'Lines' => $order_lines,
				'ProductGuid' => $finance_product->product_guid,
				'ProductId' => $finance_option,
				'SalesReference' => $order_id,
				'vLink' => false,
				'IpAddress' => $_SERVER['REMOTE_ADDR']
			),
			'Retailer' => (object) array(
				'AuthenticationKey' => $this->options['authentication_key'],
				'RetailerGuid' => $this->options['retailer_guid'],
				'RetailerId' => $this->options['retailer_id'],
				'UserId' => null
			),
			'WaitForDecision' => false
		);

		// Make the V12 API Request
		$v12_plugin = new BFI_Woocommerce_V12_Finance();
		$v12_result = $v12_plugin->bfi_v12_api->do_api_post('SubmitApplication', 'applicationRequest', 'SubmitApplicationResult', $v12_request);

		$v12_status = 0;
		if ( ! empty($v12_result->Status) ) {
			$v12_status = $v12_result->Status;
		}
		update_post_meta($order_id, '_v12_status', $v12_status);

		if ( $v12_status != 'ErrorProcessing' ) {
			// save the application details against the order
			update_post_meta($order_id, '_v12_status', $v12_result->Status);
			update_post_meta($order_id, '_v12_application_guid', $v12_result->ApplicationGuid);
			update_post_meta($order_id, '_v12_application_id', $v12_result->ApplicationId);

    		// Mark as on-hold (we're awaiting the finaince decision)
            $order->update_status('wc-processing', __( 'Awaiting finance results', 'woocommerce_v12retailfinance' ));

            echo '<p><a href="' . $v12_result->ApplicationFormUrl . '">';
            echo __('Continue to V12 Finance Form', 'woocommerce_v12retailfinance');
            echo '</a></p>';

            wc_enqueue_js('
                jQuery("body").block({
                    message: "<img src=\"' . esc_url( apply_filters( 'woocommerce_ajax_loader_url', $woocommerce->plugin_url() . '/assets/images/select2-spinner.gif' ) ) . '\" alt=\"Redirecting&hellip;\" style=\"float:left; margin-right: 10px;\" />'.__('Thank you for your order. We are now redirecting you to V12 to arrange your finance.', 'woocommerce_v12retailfinance').'",
                    overlayCSS:
                    {
                        background: "#fff",
                        opacity: 0.6
                    },
                    css: {
                        padding:        20,
                        textAlign:      "center",
                        color:          "#555",
                        border:         "3px solid #aaa",
                        backgroundColor:"#fff",
                        cursor:         "wait",
                        lineHeight:		"32px"
                    }
                });
                jQuery(location).attr(\'href\', \'' . $v12_result->ApplicationFormUrl . '\')
            ');
		}
		else {
			// an error occured, so show contact info
			if ( ! empty($v12_result->Errors) ) {
				update_post_meta($order_id, '_v12_errors', $v12_result->Errors);
			}
			echo __('An error occured when trying to process your finance application, please contact us to complete your order.', 'woocommerce_v12retailfinance');
		}
	}

	/**
	 * Build the V12 Product / Deposit Selection
	 *
	 * @since    1.0.0
	 */
	public function v12_finance_form() {
		global $wpdb;

		$stop_on_coupon = $this->get_option( 'stop_on_coupon' );

		if ( isset($stop_on_coupon) && $stop_on_coupon == 'yes' ) {
			echo  __( 'Sorry, we can not process finance payments when using a ', 'woocommerce_v12retailfinance' ) . __( 'Coupon code', 'woocommerce' );
		}
		else {
			// get the min / max deposit values & min borrowing amount
			$order_total = $this->get_order_total();

			list($min_deposit_percentage, $max_deposit_percentage, $min_deposit_amount, $max_deposit_amount) = $this->get_min_max_deposit($order_total);

			$min_borrow_amount = $order_total - $min_deposit_amount;

			// check for any discounts on products, this will determin what finance options are available to use
			$max_discount = $this->calculate_discount();

			// first get all the available products from the DB
			$product_table = $wpdb->prefix . BFI_WC_V12_TABLE;
			$db_finance_sql = $wpdb->prepare( "
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
					alt_tag ASC,
					monthly_rate ASC,
					months ASC
			",  $min_borrow_amount, $max_discount, $max_discount );
			$db_finance_prods = apply_filters( 'bfi_v12_checkout_finance_products', $wpdb->get_results( $db_finance_sql ) );

			if ( ! empty( $db_finance_prods ) ) {
				// convert this into a key value array
				$finance_products = array();
				foreach ($db_finance_prods as $fprod) {
					$finance_products[$fprod->product_id] = $fprod;
				}

				$deposit_amount = $min_deposit_amount;
				$variable_deposit = $this->get_option( 'variable_deposit' );

				// load the template for the page
				include(plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/gateway-v12-finance-selection.php');

				// Localize the script with new data
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
				// get the min and max order value
				$min_finance_value = $wpdb->get_var( "
					SELECT
						wc_min_loan
					FROM
						{$product_table}
					WHERE
						state = 1
						AND is_enabled = 1
					ORDER BY
						wc_min_loan ASC
					LIMIT 1
				" );

				list($min_deposit_percentage, $max_deposit_percentage, $min_deposit_amount, $max_deposit_amount) = $this->get_min_max_deposit($min_finance_value);

				$min_finance_value += $min_deposit_amount;
				echo sprintf( '%s &pound;%.02f', __( 'Sorry, the minimum order value for V12 Retail Finance is', 'woocommerce_v12retailfinance' ), $min_finance_value );
			}
		}
	}

	/**
	 * Return the Min/Max Deposit Perecentages and Min/Max Deposit Amounts based on the Order Total
	 *
	 * @since    1.0.0
	 */
	private function get_min_max_deposit($order_total = 0) {
		global $wpdb;

		// remove the min depsoit amount (from the total) - we can make sure this is the min value they will borrow
		$min_deposit_percentage = $this->get_option( 'min_desposit_percentage' );
        $max_deposit_percentage = 0;
		$min_deposit_amount = 0;
		if ( ! empty($min_deposit_percentage) && $min_deposit_percentage > 0) {
			$min_deposit_amount = ($min_deposit_percentage / 100) * $order_total;
		}

		$max_deposit_amount = $order_total;

		$min_financeable = self::MIN_FINANCEABLE;

		if ( ! empty($min_financeable) && $min_financeable > 0) {
			$max_deposit_amount = $order_total - $min_financeable;
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
		if ( $order_total > $max_finance_value ) {
			$finance_difference = $order_total - $max_finance_value;
			$min_deposit_amount += $finance_difference;
		}


		return array($min_deposit_percentage, $max_deposit_percentage, $min_deposit_amount, $max_deposit_amount);
	}

	/**
	 * Work out if any items on the order have been marked as on sale, therefore return the amount of discount selected
	 *
	 * @since    1.0.0
	 */
	private function calculate_discount() {
		global $woocommerce;
		$max_discount = 0;
		$items = WC()->cart->cart_contents;

		if ( ! empty( $items ) ) {
			foreach( $items as $item ) {
				$item_details = new WC_Product($item['product_id']);
				if ( $item_details->is_on_sale() ) {
					// work out the amount its discount by
					$discount_amount = $item_details->get_regular_price() - $item_details->get_sale_price();
					$discount_percent = ($discount_amount / $item_details->get_regular_price()) * 100;
					if ( $discount_percent > $max_discount) {
						$max_discount = $discount_percent;
					}
				}
				break;
			}
		}
		return $max_discount;
	}

	/**
	 * Get the details of the finance product chosen by the customer
	 *
	 * @since    1.0.0
	 */
	private function get_finance_product_details($product_id, $borrow_amount) {
		global $wpdb;

		// check for any discounts on products, this will determin what finance options are available to use
		$max_discount = $this->calculate_discount();

		$product_table = $wpdb->prefix . BFI_WC_V12_TABLE;
		$db_finance_prod = $wpdb->get_row( $wpdb->prepare( "
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
				AND product_id = %d
				AND wc_min_loan <= %f
				AND wc_min_discount <= %f
				AND wc_max_discount >= %f
		",  $product_id, $borrow_amount, $max_discount, $max_discount ) );

		if ( ! empty( $db_finance_prod ) ) {
			return $db_finance_prod;
		}
		else {
			return false;
		}
	}

	/**
	 * Show error about checking the settings
	 *
	 * @since    1.0.2
	 */
	public function v12retailfinance_check_config() {
		if (
			trim($this->settings['authentication_key']) == ''
			|| trim($this->settings['retailer_guid']) == ''
			|| trim($this->settings['retailer_id']) == ''
			|| trim($this->settings['description']) == ''
		) {
		     	echo '<div class="error"><p>'.__('Please configure your V12 Retail Finance to enable finance payments on the website.', 'woocommerce_v12retailfinance').'</p></div>';
		}
	}
}
