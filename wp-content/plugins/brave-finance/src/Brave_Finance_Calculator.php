<?php

/**
 * Description of Brave_Finance_Calculator
 *
 * @author developer
 */
class Brave_Finance_Calculator extends BFI_Finance_Calculator {

    //put your code here

    public function __construct() {
        parent::__construct();
        $this->define_public_hooks();
        $this->load_dependencies();
    }

    /**
     * 
     */
    protected function load_dependencies() {

        require_once brave_path_bfi_finance_calculator . 'includes/class-bfi-finance-calculator-loader.php';
        require_once brave_path_bfi_finance_calculator . 'includes/class-bfi-finance-calculator-i18n.php';
        require_once brave_path_bfi_finance_calculator . 'admin/class-bfi-finance-calculator-admin.php';
        require_once __DIR__ . DIRECTORY_SEPARATOR . 'Brave_Finance_Calculator_Public.php';

        $this->loader = new BFI_Finance_Calculator_Loader();
    }

    private function define_public_hooks() {
        $plugin_public = new Brave_Finance_Calculator_Public($this->get_BFI_Finance_Calculator(), $this->get_version());
        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');
    }

}
