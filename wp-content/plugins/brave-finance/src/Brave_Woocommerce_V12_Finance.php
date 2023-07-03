<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Brave_Woocommerce_V12_Finance
 *
 * @author developer
 */
class Brave_Woocommerce_V12_Finance extends BFI_Woocommerce_V12_Finance {
    //put your code here

    /**
     *
     * @var Brave_WC_V12_API 
     */
    var $bfi_v12_api;

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
        parent::__construct();
        $this->bfi_v12_api = new Brave_WC_V12_API($this->get_BFI_Woocommerce_V12_Finance(), $this->get_version());
        remove_action( 'woocommerce_email_before_order_table', array(&$this, 'add_email_details') );
    }

    /**
     * Initialise the V12 Payment Gateway.
     *
     * @since     1.0.0
     */
    public function init_v12_gateway() {
        if (!class_exists('WC_Payment_Gateway')) {
            return;
        }

        require_once brave_path_bfi_finance . 'includes/class-bfi-woocommerce-v12-finance-gateway.php';
        require_once __DIR__ . DIRECTORY_SEPARATOR . 'custom/Brave_WC_Gateway_V12_Finance_Gateway.php';

        function add_brave_finance_gateway($methods) {
            $methods[] = 'Brave_WC_Gateway_V12_Finance_Gateway';
            return $methods;
        }

        add_filter('woocommerce_payment_gateways', 'add_brave_finance_gateway');
    }

    // remove the notification from V12
    public function check_status() {
        
    }

    

}
