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
 * @package           Bave extends BFI_Finance_Calculator
 *
 * @wordpress-plugin
 * Plugin Name:       Brave Agency -- BFI Finance Calculator
 * Plugin URI:        http://www.wearebfi.co.uk/
 * Description:       The finance calculator is displayed on selected products under the tab 'Finance Options'; configuration is done within the Close Brothers area.
 * Version:           1.2.2
 * Requires	     V12
 * Author:           Brave

 */
// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

require_once ABSPATH . 'wp-includes/rewrite.php';
require_once ABSPATH.  'wp-includes/query.php';


define('BRAVE_APP_NAME', 'Brave Close Brothers');
define('brave_path_bfi_finance_calculator', ABSPATH . 'wp-content/plugins/bfi-finance-calculator/');
define('brave_path_bfi_finance', ABSPATH . 'wp-content/plugins/bfi-woocommerce-v12-finance/');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-bfi-finance-calculator-activator.php
 */
function activate_Brave_BFI_Finance_Calculator() {
    require_once brave_path_bfi_finance_calculator . 'includes/class-bfi-finance-calculator-activator.php';
    BFI_Finance_Calculator_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-bfi-finance-calculator-deactivator.php
 */
function deactivate_BFI_Finance_Calculator() {
    require_once brave_path_bfi_finance_calculator . 'includes/class-bfi-finance-calculator-deactivator.php';
    BFI_Finance_Calculator_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_BFI_Finance_Calculator');
register_deactivation_hook(__FILE__, 'deactivate_BFI_Finance_Calculator');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require brave_path_bfi_finance_calculator . 'includes/class-bfi-finance-calculator.php';
require brave_path_bfi_finance_calculator . 'public/class-bfi-finance-calculator-public.php';
require __DIR__ . DIRECTORY_SEPARATOR . 'src/Brave_Finance_Calculator_Public.php';
/**
 *
 */
require __DIR__ . DIRECTORY_SEPARATOR . 'src/Brave_Finance_Calculator.php';

function brave_run_calculator() {
    $plugin = new Brave_Finance_Calculator();
    $plugin->run();
}

brave_run_calculator();

/** checking if local host * */
function is_local() {
     
    $url = get_site_url();
    if (preg_match('/local/', $url)) {
        return true;
    }
    return false;
}

#############################
### Set Financial extesion 
############################
// set a constant for the plugin table name 

define('BFI_WC_V12_TABLE', 'v12_finance_products');

if (is_local()) {
    define('BRAVE_WC_V12_API_URL_NO_PORT', 'https://test.dekopay.com');
    define('BRAVE_WC_V12_API_URL', 'https://test.dekopay.com:3343/');
    define('BRAVE_WC_V12_API_KEY', 'de7b7b35bac74f5c73c1e686fab1321a');
    define('BRAVE_WC_V12_API_KEY_ID_INST', '13742');
    define('BRAVE_WC_V12_API_REDIRECTURL', 'https://test.pay4later.com/credit-application/form/');
} else {
    define('BRAVE_WC_V12_API_URL_NO_PORT', 'https://secure.dekopay.com');
    define('BRAVE_WC_V12_API_URL', 'https://secure.dekopay.com:6686/');
    define('BRAVE_WC_V12_API_KEY', 'ef62ca6979b4e046cecaed3474d66669');
    define('BRAVE_WC_V12_API_KEY_ID_INST', '25250');
    define('BRAVE_WC_V12_API_REDIRECTURL', 'https://secure.pay4later.com/credit-application/form/');
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-bfi-woocommerce-v12-finance-activator.php
 */
function activate_BFI_Woocommerce_V12_Finance() {
    require_once brave_path_bfi_finance . 'includes/class-bfi-woocommerce-v12-finance-activator.php';
    BFI_Woocommerce_V12_Finance_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-bfi-woocommerce-v12-finance-deactivator.php
 */
function deactivate_BFI_Woocommerce_V12_Finance() {
    require_once brave_path_bfi_finance . 'includes/class-bfi-woocommerce-v12-finance-deactivator.php';
    BFI_Woocommerce_V12_Finance_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_BFI_Woocommerce_V12_Finance');
register_deactivation_hook(__FILE__, 'deactivate_BFI_Woocommerce_V12_Finance');


/** include parent files */
require_once brave_path_bfi_finance . 'includes/class-bfi-woocommerce-v12-finance.php';
require_once brave_path_bfi_finance . 'includes/class-bfi-woocommerce-v12-finance-api.php';
/** include child overrides * */
require_once __DIR__ . DIRECTORY_SEPARATOR . 'src/Brave_Woocommerce_V12_Finance.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'src/Brave_Finance_Status.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'src/custom/Brave_WC_V12_API.php';


function run_Brave_Intergration_Woocommerce_V12_Finance() {
    $plugin = new Brave_Woocommerce_V12_Finance();
    $plugin->run();
}

function run_Brave_Intergration_Woocommerce_V12_Finance_url() {
    $plugin = new Brave_Finance_Status();
    $plugin->init();
}
 

if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    run_Brave_Intergration_Woocommerce_V12_Finance();
    add_action('init' , 'run_Brave_Intergration_Woocommerce_V12_Finance_url', 10 , 0);
}
