<?php

/**
 * V12 Finance - Woocommerce Plugin
 *
 * @link              http://www.wearebfi.co.uk
 * @since             1.0.0
 * @package           BFI_Woocommerce_V12_Finance
 *
 * @wordpress-plugin
 * Plugin Name:       BFI Woocommerce V12 Finance
 * Plugin URI:        http://www.wearebfi.co.uk/
 * Description:       This plugin handles the integration of V12 Finance with Woocommerce
 * Version:           1.3.0
 * Author:            BFI
 * Author URI:        http://www.wearebfi.co.uk/
 * License URI:       http://www.wearebfi.co.uk/terms/
 * Text Domain:       bfi-woocommerce-v12-finance
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Load in the Auto-Updater part of the plugin
 */
require 'plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
    'http://wp-install.bfinternet.co.uk/?action=get_metadata&slug=bfi-woocommerce-v12-finance',
    __FILE__,
    'bfi-woocommerce-v12-finance'
);

// set a constant for the plugin table name
define('BFI_WC_V12_TABLE', 'v12_finance_products');
define('BFI_WC_V12_API_URL', 'https://apply.v12finance.com/latest/retailerapi/');
define('BFI_WC_V12_PRODID', 'V12RFWCPLUGIN');
define('BFI_WC_V12_APIKEY', 'w8wjEpij0pXcAfmx9qGvrqd6OHQz2uKw');
define('BFI_WC_V12_APIURL', 'https://www.wearebfi.co.uk/?wc-api=software-api&');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-bfi-woocommerce-v12-finance-activator.php
 */
function activate_BFI_Woocommerce_V12_Finance() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-bfi-woocommerce-v12-finance-activator.php';
	BFI_Woocommerce_V12_Finance_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-bfi-woocommerce-v12-finance-deactivator.php
 */
function deactivate_BFI_Woocommerce_V12_Finance() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-bfi-woocommerce-v12-finance-deactivator.php';
	BFI_Woocommerce_V12_Finance_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_BFI_Woocommerce_V12_Finance' );
register_deactivation_hook( __FILE__, 'deactivate_BFI_Woocommerce_V12_Finance' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-bfi-woocommerce-v12-finance.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_BFI_Woocommerce_V12_Finance() {
	$plugin = new BFI_Woocommerce_V12_Finance();
	$plugin->run();
}

/**
 * Check if WooCommerce is active before we do anything else
 **/
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	run_BFI_Woocommerce_V12_Finance();
}
