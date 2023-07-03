<?php

/**
 * Fired during plugin deactivation
 *
 * @link       http://www.wearebfi.co.uk
 * @since      1.0.0
 *
 * @package    BFI_Woocommerce_V12_Finance
 * @subpackage BFI_Woocommerce_V12_Finance/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    BFI_Woocommerce_V12_Finance
 * @subpackage BFI_Woocommerce_V12_Finance/includes
 * @author     BFI <info@wearebfi.co.uk>
 */
class BFI_Woocommerce_V12_Finance_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		wp_clear_scheduled_hook( 'bfi_v12_import_products' );
		wp_clear_scheduled_hook( 'bfi_v12_check_status' );
	}

}
