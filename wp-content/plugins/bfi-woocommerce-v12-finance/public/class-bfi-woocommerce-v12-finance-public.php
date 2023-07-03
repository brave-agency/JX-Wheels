<?php
/**
 * Handle Public function for V12 Payment System
 *
 * @link       http://www.wearebfi.co.uk
 * @since      1.0.0
 *
 * @package    BFI_Woocommerce_V12_Finance
 * @subpackage BFI_Woocommerce_V12_Finance/public
 */

/**
 * Registers CSS/JS for use in the checkout
 *
 * @package    BFI_Woocommerce_V12_Finance
 * @subpackage BFI_Woocommerce_V12_Finance/public
 * @author     BFI <info@wearebfi.co.uk>
 */
class BFI_Woocommerce_V12_Finance_Public {

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
	 * @param      string    $BFI_Woocommerce_V12_Finance       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $BFI_Woocommerce_V12_Finance, $version ) {

		$this->BFI_Woocommerce_V12_Finance = $BFI_Woocommerce_V12_Finance;
		$this->version = $version;

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
	 * Register the scripts for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		wp_register_script('v12_payment', plugin_dir_url( __FILE__ ) . 'js/bfi-woocommerce-v12-finance-public.js', array( 'jquery' ), false, true);
	}

	/**
	 * Check that V12 is set-up correctly when payment gateways are displayed
	 *
	 * @since    1.0.2
	 */
	public function check_v12_setup( $gateways ) {
		global $wpdb;

		// check to see if this has V12 already
		if ( array_key_exists('v12retailfinance', $gateways) ) {
			// check the essential details for V12
			if (
				trim($gateways['v12retailfinance']->settings['authentication_key']) == ''
				|| trim($gateways['v12retailfinance']->settings['retailer_guid']) == ''
				|| trim($gateways['v12retailfinance']->settings['retailer_id']) == ''
				|| trim($gateways['v12retailfinance']->settings['description']) == ''
			) {
				unset($gateways['v12retailfinance']);
			}

			// now check there is at least one finance product enabled
			$active_products = $wpdb->get_var('SELECT COUNT(*) FROM ' . $wpdb->prefix . BFI_WC_V12_TABLE . ' WHERE state = 1 AND is_enabled = 1');
			if ( $active_products < 1 ) {
				unset($gateways['v12retailfinance']);
			}
		}

		return $gateways;
	}
}
