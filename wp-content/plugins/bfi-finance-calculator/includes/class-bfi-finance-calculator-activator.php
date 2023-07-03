<?php

/**
 * Fired during plugin activation
 *
 * @link       http://www.wearebfi.co.uk
 * @since      1.0.0
 *
 * @package    BFI_Finance_Calculator
 * @subpackage BFI_Finance_Calculator/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    BFI_Finance_Calculator
 * @subpackage BFI_Finance_Calculator/includes
 * @author     BFI <info@wearebfi.co.uk>
 */
class BFI_Finance_Calculator_Activator {

	/**
	 * Function is run on activation checks for the V12 plugin and dies if it does not exist
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	
	public static function activate() {
		$category_ext = 'bfi-woocommerce-v12-finance/bfi-woocommerce-v12-finance.php';
		$version_to_check = '1.0.4';
		$category_error = false; 
		
		if(file_exists(WP_PLUGIN_DIR.'/'.$category_ext)){
			$category_ext_data = get_plugin_data( WP_PLUGIN_DIR.'/'.$category_ext);
			
			if ($category_error = !version_compare ( $category_ext_data['Version'], $version_to_check, '>=')) { 
				$category_error = true; 
			}
			else {			
				$category_error = false;
			}
		}   
		
		if ( $category_error ) {
        echo '<p>'.__('Please update the V12 Finance plugin before installing this plugin.', 'ap').'</p>';
  
        @trigger_error(__('Please update the V12 Finance plugin before installing this plugin.', 'ap'), E_USER_ERROR);
		}
	}
}
