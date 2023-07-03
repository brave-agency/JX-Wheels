<?php

/**
 * V12 Finance Admin Functions
 *
 * @link       http://www.wearebfi.co.uk
 * @since      1.0.0
 *
 * @package    BFI_Woocommerce_V12_Finance
 * @subpackage BFI_Woocommerce_V12_Finance/admin
 */

/**
 * This Class handles all the admin specific V12 Finance Functions
 *
 * @package    BFI_Woocommerce_V12_Finance
 * @subpackage BFI_Woocommerce_V12_Finance/admin
 * @author     BFI <info@wearebfi.co.uk>
 */
class BFI_Woocommerce_V12_Finance_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $BFI_Woocommerce_V12_Finance    The ID of this plugin.
	 */
	private $BFI_Woocommerce_V12_Finance;

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
	 *
	 * @since    1.0.0
	 * @param      string    $BFI_Woocommerce_V12_Finance       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $BFI_Woocommerce_V12_Finance, $version ) {
		$this->BFI_Woocommerce_V12_Finance = $BFI_Woocommerce_V12_Finance;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		// V12 Admin CSS
		wp_enqueue_style( $this->BFI_Woocommerce_V12_Finance, plugin_dir_url( __FILE__ ) . 'css/bfi-woocommerce-v12-finance-admin.css', array(), $this->version, 'all' );
		wp_enqueue_script( $this->BFI_Woocommerce_V12_Finance, plugin_dir_url( __FILE__ ) . 'js/bfi-woocommerce-v12-finance-admin.js', array(), $this->version, 'all'  );
	}

	/**
	 * Display the Status of a V12 order in the edit order screen
	 *
	 * @since    1.0.0
	 */
	public function v12_order_details_status( $order ) {
		if ( $this->is_v12_order($order) ) {
			// need to get the following details for display
			$order_id = $order->id;

			$v12_status = 'Unknown';
			if ( ! empty($order->v12_status) ) {
				$v12_status = $order->v12_status;
			}

			// get the v12 product details
			$product = BFI_Woocommerce_V12_Finance::get_finance_product_details($order->v12_product);

			// only check the status when its not completed
			if ( ! in_array($v12_status, array('PaymentProcessed', 'Cancelled') ) ) {
				$api_request = new BFI_WC_V12_API($this->BFI_Woocommerce_V12_Finance, $this->version);
				$new_status = $api_request->check_application_status($order);
				if ( ! empty($new_status) ) {
					$v12_status = $new_status;
				}
			}
			include(plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/bfi-woocommerce-v12-finance-order-info.php');
		}
	}

	/**
	 * Check if an order is a V12 order
	 *
	 * @since    1.0.0
	 */
	private function is_v12_order( $order ) {
		// check this is a V12 Payment
		$payment_method = ! empty( $order->payment_method ) ? $order->payment_method : '';

		if ( $payment_method == 'v12retailfinance' ) {
			return true;
		}
		else {
			return false;
		}
	}

	/**
	 * Add V12 Finance Status Column Header
	 *
	 * @since    1.0.0
	 */
	public function add_v12_column($columns) {
		$new_columns = (is_array($columns)) ? $columns : array();
		unset( $new_columns['order_actions'] );
		$new_columns['v12_finance_status'] = 'V12 Status';
		$new_columns['order_actions'] = $columns['order_actions'];
		return $new_columns;
	}


	/**
	 * Add V12 Finance Status Column Values
	 *
	 * @since    1.0.0
	 */
	public function add_v12_column_values($column) {
		global $post;

		if ( $column == 'v12_finance_status' ) {
			// only check for data if this is a V12 order
			$order = new WC_Order( $post->ID );
			if ( $this->is_v12_order( $order ) ) {
				$v12_status = 'Unknown';
				if ( ! empty($order->v12_status) ) {
					$v12_status = $order->v12_status;
				}
				echo $v12_status;
			}
		}
	}

	/**
	 * Add V12 Finance Status Column Sorting
	 *
	 * @since    1.0.0
	 */
	public function add_v12_column_sort($columns) {
		$custom = array(
			'v12_finance_status' => '_v12_status'
		);
		return wp_parse_args( $custom, $columns );
	}

	/**
	 * Add V12 Finance Status button to check the current status with V12
	 *
	 * @since    1.0.0
	 */
	public function add_v12_action_button( $actions, $the_order ) {
		// check this a V12 order first
		if ( $this->is_v12_order( $the_order ) ) {
			// now check the current status - if the order is completed then we don't want to
			// let the user keep checking
			$v12_status = 'Unknown';
			if ( ! empty($the_order->v12_status) ) {
				$v12_status = $the_order->v12_status;
			}
			if ( ! in_array($v12_status, array('PaymentProcessed', 'Cancelled') ) ) {
				$actions['v12_status'] = array(
					'url'       => wp_nonce_url( admin_url( 'admin-ajax.php?action=order_list_v12_status_update&order_id=' . $the_order->id ), 'order-list-v12-status-update' ),
					'name'      => __( 'Check V12 Finance Status', 'woocommerce_v12retailfinance' ),
					'action'    => "v12_status"
				);
			}
		}

		return $actions;
	}

	/**
	 * Update the V12 status from the order list via AJAX
	 *
	 * @since    1.0.0
	 */
	public static function ajax_v12_status_update() {
		if ( current_user_can( 'edit_shop_orders' ) && check_admin_referer( 'order-list-v12-status-update' ) ) {
			$status   = sanitize_text_field( $_GET['status'] );
			$order_id = absint( $_GET['order_id'] );

			$order = new WC_Order( $order_id );
			$payment_method = ! empty( $order->payment_method ) ? $order->payment_method : '';
			if ( $payment_method == 'v12retailfinance' ) {
				$v12_status = 'Unknown';
				if ( ! empty($order->v12_status) ) {
					$v12_status = $order->v12_status;
				}

				// only check the status when its not completed
				if ( ! in_array($v12_status, array('PaymentProcessed', 'Cancelled') ) ) {
					$api_request = new BFI_WC_V12_API('', '');
					$new_status = $api_request->check_application_status($order);
					if ( ! empty($new_status) ) {
						$v12_status = $new_status;
					}
				}
			}
		}

		wp_safe_redirect( wp_get_referer() ? wp_get_referer() : admin_url( 'edit.php?post_type=shop_order' ) );
		die();
	}

	/**
	 * Grab the V12 products via the API requests from the admin area
	 *
	 * @since    1.0.1
	 */
	public function ajax_update_v12_products() {
		$api_request = new BFI_WC_V12_API('', '');
		$new_status = $api_request->import_products();
		wp_safe_redirect( wp_get_referer() ? wp_get_referer() : admin_url( 'admin.php?page=wc-settings&tab=checkout&section=bfi_wc_gateway_v12_finance_gateway' ) );
		die();
	}

	/**
	 * V12 Licence Options.
	 *
	 * @since    1.0.6
	 * @access   public
	 */
	public function create_admin_pages() {
		//add the pages
		add_submenu_page(null, 'V12 Retail Finance', 'V12 Retail Finance', 'manage_woocommerce', 'bfi_wc_v12_key', array( $this, 'v12_key' ));
	}

	/**
	 * Display Iris Info, check _POST and call GTIN query functions with _POST as a param
	 *
	 * @since    1.0.6
	 * @access   public
	 */
	public function v12_key() {
		$message = '';
		$error = '';
		$is_activated = false;

		if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
			if ( isset($_POST['submit']) && $_POST['submit'] == 'Deactivate Licence' ) {
				// build the request
				$v12_order_email = get_option( 'bfi-woocommerce-v12-order-email' );
				$v12_licence_key = get_option( 'bfi-woocommerce-v12-key' );
				$args = array(
					'request'     => 'deactivation',
					'email'       => $v12_order_email,
					'license_key' => $v12_licence_key,
					'product_id'  => BFI_WC_V12_PRODID,
					'instance' 	  => site_url()
				);

				$target_url = BFI_WC_V12_APIURL . http_build_query( $args );
				$data = wp_remote_get( $target_url );
				update_option( 'bfi-woocommerce-v12-order-email', '' );
				update_option( 'bfi-woocommerce-v12-key', '' );
				update_option( 'bfi-woocommerce-v12-activation', 0 );
				update_option( 'bfi-woocommerce-v12-activation-check', 0 );
				$message = 'Deactivated';
				$is_activated = false;
			}
			// now try and activate the key
			else if ( ! empty($_POST['v12_licence_key']) && ! empty($_POST['v12_order_email']) ) {
				// get the details form the form
				$v12_licence_key = $_POST['v12_licence_key'];
				$v12_order_email = $_POST['v12_order_email'];

				// build the request
				$args = array(
					'request'     => 'activation',
					'email'       => $v12_order_email,
					'license_key' => $v12_licence_key,
					'product_id'  => BFI_WC_V12_PRODID,
					'secret_key'  => BFI_WC_V12_APIKEY,
					'instance' 	  => site_url()
				);

				$target_url = BFI_WC_V12_APIURL . http_build_query( $args );
				$data = wp_remote_get( $target_url );
				if ( isset($data['response']['code']) && $data['response']['code'] == 200 ) {
					// ok we've got a response, get the details
					$api_status = json_decode($data['body']);

					if ( isset($api_status->activated) && $api_status->activated == 1 ) {
						// complete activation
						update_option( 'bfi-woocommerce-v12-order-email', $v12_order_email );
						update_option( 'bfi-woocommerce-v12-key', $v12_licence_key );
						update_option( 'bfi-woocommerce-v12-activation', $api_status->timestamp );
						update_option( 'bfi-woocommerce-v12-activation-check', $api_status->timestamp );
						$message = 'Activated';
						$is_activated = true;
					}
					else {
						update_option( 'bfi-woocommerce-v12-order-email', '' );
						update_option( 'bfi-woocommerce-v12-key', '' );
						update_option( 'bfi-woocommerce-v12-activation', 0 );
						update_option( 'bfi-woocommerce-v12-activation-check', 0 );
						if ( ! empty($api_status->error)) {
							$error = $api_status->error;
						}
						else {
							$error = __('Sorry, there was a problem trying to activate your licence, please try again.', 'woocommerce_v12retailfinance');
						}
					}
				}
				else {
					$error = __('Sorry, there was a problem trying to activate your licence, please try again.', 'woocommerce_v12retailfinance');
				}
			}
			else {
				$error = __('Please enter your e-mail address and licence key.', 'woocommerce_v12retailfinance');
			}
		}

		// get details
		$v12_order_email = get_option( 'bfi-woocommerce-v12-order-email' );
		$v12_licence_key = get_option( 'bfi-woocommerce-v12-key' );
		$v12_licence_activation = get_option( 'bfi-woocommerce-v12-activation' );
		$last_check = get_option( 'bfi-woocommerce-v12-activation-check' );
		if ( ! empty($v12_licence_key) ) {
			$is_activated = true;
		}
		include( 'partials/bfi-woocommerce-v12-finance-licence-key.php' );
	}
}
