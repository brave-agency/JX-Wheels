<?php

/**
 * V12 Finance Integration Main Class
 *
 * @link       http://www.wearebfi.co.uk
 * @since      1.0.0
 *
 * @package    BFI_Woocommerce_V12_Finance
 * @subpackage BFI_Woocommerce_V12_Finance/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    BFI_Woocommerce_V12_Finance
 * @subpackage BFI_Woocommerce_V12_Finance/includes
 * @author     BFI <info@wearebfi.co.uk>
 */
class BFI_Woocommerce_V12_Finance {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      BFI_Woocommerce_V12_Finance_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $BFI_Woocommerce_V12_Finance    The string used to uniquely identify this plugin.
	 */
	protected $BFI_Woocommerce_V12_Finance;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * API Calls
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      object    $bfi_v12_api    API Object.
	 */
	public $bfi_v12_api;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->BFI_Woocommerce_V12_Finance = 'bfi-woocommerce-v12-finance';
		$this->version = '1.3.0';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

		// add the gateway hook
		$this->loader->add_action( 'admin_notices', $this, 'check_status', 10 );
		$this->loader->add_action( 'plugins_loaded', $this, 'init_v12_gateway', 0 );

		// Set the hooks for V12
		$this->bfi_v12_api = new BFI_WC_V12_API( $this->get_BFI_Woocommerce_V12_Finance(), $this->get_version() );
		$this->loader->add_action( 'bfi_v12_import_products', $this->bfi_v12_api, 'import_products' );
		$this->loader->add_action( 'bfi_v12_check_status', $this->bfi_v12_api, 'cron_check_v12_status' );
		$this->loader->add_action( 'woocommerce_order_status_cancelled', $this->bfi_v12_api, 'cancel_order' );
		$this->loader->add_action( 'woocommerce_order_status_completed', $this->bfi_v12_api, 'complete_order' );

		// add e-mail details to order e-mails
		$this->loader->add_action( 'woocommerce_email_before_order_table', $this, 'add_email_details', 10, 4 );
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - BFI_Woocommerce_V12_Finance_Loader. Orchestrates the hooks of the plugin.
	 * - BFI_Woocommerce_V12_Finance_i18n. Defines internationalization functionality.
	 * - BFI_Woocommerce_V12_Finance_Admin. Defines all hooks for the admin area.
	 * - BFI_Woocommerce_V12_Finance_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-bfi-woocommerce-v12-finance-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-bfi-woocommerce-v12-finance-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-bfi-woocommerce-v12-finance-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-bfi-woocommerce-v12-finance-public.php';

		/**
		 * The class responsible for the V12 API
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-bfi-woocommerce-v12-finance-api.php';

		$this->loader = new BFI_Woocommerce_V12_Finance_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the BFI_Woocommerce_V12_Finance_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new BFI_Woocommerce_V12_Finance_i18n();
		$plugin_i18n->set_domain( $this->get_BFI_Woocommerce_V12_Finance() );

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new BFI_Woocommerce_V12_Finance_Admin( $this->get_BFI_Woocommerce_V12_Finance(), $this->get_version() );

		// Add V12 Details to order display
		$this->loader->add_filter( 'woocommerce_admin_order_data_after_order_details', $plugin_admin, 'v12_order_details_status' );

		// Add V12 Columns to Orders Screen
		$this->loader->add_filter( 'manage_edit-shop_order_columns', $plugin_admin, 'add_v12_column', 11 );
		$this->loader->add_action( 'manage_shop_order_posts_custom_column', $plugin_admin, 'add_v12_column_values', 2 );
		$this->loader->add_filter( 'manage_edit-shop_order_sortable_columns', $plugin_admin, 'add_v12_column_sort' );

		// Add a new button to the action buttons with action
		$this->loader->add_filter( 'woocommerce_admin_order_actions', $plugin_admin, 'add_v12_action_button', 10, 2 );
		$this->loader->add_action( 'wp_ajax_order_list_v12_status_update', $plugin_admin, 'ajax_v12_status_update' );

		// update finance products
		$this->loader->add_action( 'wp_ajax_update_v12_products', $plugin_admin, 'ajax_update_v12_products' );

		// add js/css to admin
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );

		// add key management
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'create_admin_pages' );
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {
		$plugin_public = new BFI_Woocommerce_V12_Finance_Public( $this->get_BFI_Woocommerce_V12_Finance(), $this->get_version() );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

		// add filter to disable V12 on the front end if not set-up correctly
		$this->loader->add_filter( 'woocommerce_available_payment_gateways', $plugin_public, 'check_v12_setup', 10, 1 );
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * Check V12 Status.
	 *
	 * @since    1.0.0
	 */
	public function check_status() {
		$key = get_option( 'bfi-woocommerce-v12-key' );
		$last_check = get_option( 'bfi-woocommerce-v12-activation-check' );
		if ( empty($key) ) {
			$class = 'notice notice-error';
			$message = __( 'Please click here to activate your V12 Plugin Licence Key.', 'woocommerce_v12retailfinance' );
			printf( '<div class="%1$s"><p><a href="/wp-admin/admin.php?page=bfi_wc_v12_key">%2$s</a></p></div>', $class, $message );
		}
		else if ( ! isset($last_check) || $last_check < (time() - 432000) ) {
			$class = 'notice notice-error';
			$message = __( 'Please click here to check activation on your V12 Plugin Licence Key.', 'woocommerce_v12retailfinance' );
			printf( '<div class="%1$s"><p><a href="/wp-admin/admin.php?page=bfi_wc_v12_key">%2$s</a></p></div>', $class, $message );
		}
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_BFI_Woocommerce_V12_Finance() {
		return $this->BFI_Woocommerce_V12_Finance;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    BFI_Woocommerce_V12_Finance_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

	/**
	 * Initialise the V12 Payment Gateway.
	 *
	 * @since     1.0.0
	 */
	public function init_v12_gateway() {
		if ( ! class_exists( 'WC_Payment_Gateway' ) ) {
			return;
		}

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-bfi-woocommerce-v12-finance-gateway.php';
		function add_v12finance_gateway($methods) {
			$methods[] = 'BFI_WC_Gateway_V12_Finance_Gateway';
			return $methods;
		}
		add_filter( 'woocommerce_payment_gateways', 'add_v12finance_gateway' );
	}

	/**
	 * Get the details of the finance product chosen by the customer
	 *
	 * @since    1.0.0
	 */
	public function get_finance_product_details($product_id) {
		global $wpdb;

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
		",  $product_id ) );

		if ( ! empty( $db_finance_prod ) ) {
			return $db_finance_prod;
		}
		else {
			return false;
		}
	}

	/**
	 * Add details of V12 to the shop & customer e-mails.
	 *
	 * @since    1.0.9
	 */
	public function add_email_details ( $order, $sent_to_admin, $plain_text, $email ) {
		// check this is a finance order
		$payment_method = get_post_meta( $order->id, '_payment_method', true );
		if ( $payment_method == 'v12retailfinance' ) {
			// handle the e-mail being sent to admin or to the customer
			if ( $sent_to_admin === true) {
				// admin e-mail
				echo '<div style="text-align:left; font-family: \'Helvetica Neue\', Helvetica, Roboto, Arial, sans-serif;  border: 1px solid #e4e4e4; padding: 12px;"><h3>V12 Retail Finance</h3><p><strong>Please wait for finance approval from V12 Retail Finance before shipping, you can check this by logging into your V12 account.</strong></p></div>';
			}
			else {
				// customer e-mail, get the v12 status, so we can show the appropriate message
				$v12_status = get_post_meta( $order->id, '_v12_status', true );
				$pending_status = array('Acknowledged', 'Referred', 'Accepted', 'AwaitingFulfilment');
				$completed_status = array('PaymentRequested', 'PaymentProcessed');

				// get V12 gateway settings
				$v12_gateway = new BFI_WC_Gateway_V12_Finance_Gateway();

				if ( in_array( $v12_status, $pending_status ) ) {
					$email_pending_status = '';
					if ( ! empty($v12_gateway->settings['email_pending_status']) ) {
						$email_pending_status = $v12_gateway->settings['email_pending_status'];
					}
					echo '<div style="text-align:left; font-family: \'Helvetica Neue\', Helvetica, Roboto, Arial, sans-serif;  border: 1px solid #e4e4e4; padding: 12px;"><h3>V12 Retail Finance</h3><p>' . $email_pending_status . '</p></div>';
				}
				elseif ( in_array( $v12_status, $completed_status ) ) {
					$email_completed_status = '';
					if ( ! empty($v12_gateway->settings['email_completed_status']) ) {
						$email_completed_status = $v12_gateway->settings['email_completed_status'];
					}
					echo '<div style="text-align:left; font-family: \'Helvetica Neue\', Helvetica, Roboto, Arial, sans-serif;  border: 1px solid #e4e4e4; padding: 12px;"><h3>V12 Retail Finance</h3><p>' . $email_completed_status . '</p></div>';
				}
			}
		}
	}
}
