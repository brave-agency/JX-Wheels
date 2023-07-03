<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.wearebfi.co.uk
 * @since             1.0.0
 * @package           BFI_Finance_Calculator
 *
 * @wordpress-plugin
 * Plugin Name:       BFI Finance Calculator
 * Plugin URI:        http://www.wearebfi.co.uk/
 * Description:       The finance calculator is displayed on selected products under the tab 'Finance Options'; configuration is done within the V12 admin area.
 * Version:           1.2.2
 * Requires			  V12
 * Author:            BFI
 * Author URI:        http://www.wearebfi.co.uk/
 * License URI:       http://www.wearebfi.co.uk/terms/
 * Text Domain:       bfi-finance-calculator
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
    'http://wp-install.bfinternet.co.uk/?action=get_metadata&slug=bfi-finance-calculator',
    __FILE__,
	'bfi-finance-calculator'
);

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-bfi-finance-calculator-activator.php
 */
function activate_BFI_Finance_Calculator() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-bfi-finance-calculator-activator.php';
	BFI_Finance_Calculator_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-bfi-finance-calculator-deactivator.php
 */
function deactivate_BFI_Finance_Calculator() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-bfi-finance-calculator-deactivator.php';
	BFI_Finance_Calculator_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_BFI_Finance_Calculator' );
register_deactivation_hook( __FILE__, 'deactivate_BFI_Finance_Calculator' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-bfi-finance-calculator.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_BFI_Finance_Calculator() {

	$plugin = new BFI_Finance_Calculator();
	$plugin->run();

}
run_BFI_Finance_Calculator();
