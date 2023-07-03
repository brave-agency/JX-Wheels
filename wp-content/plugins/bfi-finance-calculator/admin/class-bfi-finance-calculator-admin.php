<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://www.wearebfi.co.uk
 * @since      1.0.0
 *
 * @package    BFI_Finance_Calculator
 * @subpackage BFI_Finance_Calculator/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    BFI_Finance_Calculator
 * @subpackage BFI_Finance_Calculator/admin
 * @author     BFI <info@wearebfi.co.uk>
 */
 
class BFI_Finance_Calculator_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $BFI_Finance_Calculator    The ID of this plugin.
	 */
	private $BFI_Finance_Calculator;

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
	 * @param      string    $BFI_Finance_Calculator       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
		public function __construct( $BFI_Finance_Calculator, $version ) {
			$this->BFI_Finance_Calculator = $BFI_Finance_Calculator;
			$this->version = $version;
			add_filter('bfi_v12_gateway_fields', array($this, 'add_finance_calculator_settings' ));
			add_filter('bfi_v12_gateway_fields', array($this, 'add_minimum_monthly_payment_settings' ));
		}
		
		public function add_minimum_monthly_payment_settings( $settings ) {
			$newarray = array ('enable_monthly_minimum_payments' => array(
				'title' => __( 'Show Minimum Monthly Payments', 'woocommerce' ),
				'type' => 'checkbox',
				'label' => __( 'Shows Minimum Monthly Payments on Product List', 'woocommerce' ),
				'default' => 'yes'
				)
			);

			$settings = array_merge(
			array_slice($settings, 0, $pos=array_search('enable_finance_calculator', array_keys($settings), true)+1, true),
			$newarray,
			array_slice($settings, $pos, NULL, true)
			);
			return $settings;
		}	
			
		public function add_finance_calculator_settings( $settings ) {
			$newarray = array ('enable_finance_calculator' => array(
				'title' => __( 'Enable Calculator', 'woocommerce' ),
				'type' => 'checkbox',
				'label' => __( 'Enable V12 Retail Finance Calculator', 'woocommerce' ),
				'default' => 'yes'
				)
			);

			$settings = array_merge(
			array_slice($settings, 0, $pos=array_search('enabled', array_keys($settings), true)+1, true),
			$newarray,
			array_slice($settings, $pos, NULL, true)
			);
			return $settings;
		}			
				
		/**
		 * Register the stylesheets for the admin area.
		 *
		 * @since    1.0.0
		 */
		public function enqueue_styles() {

			/**
			 * This function is provided for demonstration purposes only.
			 *
			 * An instance of this class should be passed to the run() function
			 * defined in BFI_Finance_Calculator_Loader as all of the hooks are defined
			 * in that particular class.
			 *
			 * The BFI_Finance_Calculator_Loader will then create the relationship
			 * between the defined hooks and the functions defined in this
			 * class.
			 */

			// Make sure you update this specific to your admin pages

		}

		/**
		 * Register the JavaScript for the admin area.
		 *
		 * @since    1.0.0
		 */
		public function enqueue_scripts() {

			/**
			 * This function is provided for demonstration purposes only.
			 *
			 * An instance of this class should be passed to the run() function
			 * defined in BFI_Finance_Calculator_Loader as all of the hooks are defined
			 * in that particular class.
			 *
			 * The BFI_Finance_Calculator_Loader will then create the relationship
			 * between the defined hooks and the functions defined in this
			 * class.
			 */

			// Make sure you update this specific to your admin pages
		
		}
	}
