<?php

/**
 * V12 Finance API Class
 *
 * @link       http://www.wearebfi.co.uk
 * @since      1.0.0
 *
 * @package    BFI_Woocommerce_V12_Finance
 * @subpackage BFI_Woocommerce_V12_Finance/includes
 */

/**
 * This central class handles all the API calls to / from V12 Finance
 *
 * @since      1.0.0
 * @package    BFI_Woocommerce_V12_Finance
 * @subpackage BFI_Woocommerce_V12_Finance/includes
 * @author     BFI <info@wearebfi.co.uk>
 */
class BFI_WC_V12_API {
	/**
	 * V12 API URL.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $api_url    API URL.
	 */
	private $api_url;

	/**
	 * V12 Options.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      array    $options    Currently set options.
	 */
	private $options;

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $BFI_Woocommerce_Iris_Plugin    The ID of this plugin.
	 */
	protected $BFI_Woocommerce_Iris_Plugin;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	protected $version;

	/**
	 * Allow Update Statuses
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      array    $allowed_statuses    Allowed Status Names for V12.
	 */
	protected $allowed_statuses = array(
		'Cancel' => 100,
		'RequestPayment' => 40,
		'PartialRefund' => 200,
		'AmendSalesReference' => 250
	);

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $BFI_Woocommerce_Iris_Plugin       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $BFI_Woocommerce_Iris_Plugin, $version ) {
		$this->BFI_Woocommerce_Iris_Plugin = $BFI_Woocommerce_Iris_Plugin;
		$this->version = $version;

		// set V12 Specific details
		$this->options = get_option( 'woocommerce_v12retailfinance_settings', null );
		$this->api_url = BFI_WC_V12_API_URL;
	}

	/**
	 * API Call Function.
	 *
	 * @since    1.0.0
	 */
	public function do_api_post($function, $action, $returnname, $api_fields = array()) {
		// make the soap request
		$client = new V12_SoapClient;
        $response = $client->soapCall($function, $action, $api_fields);
		return $response->$returnname;
	}

	/**
	 * Import Products from V12.
	 *
	 * @since    1.0.0
	 */
	public function import_products() {
		global $wpdb;

		if ( $this->check_v12_enabled() !== true) {
			return;
		}

		// build the request for V12 to get the products
		$api_request = array(
			'Retailer' => array(
				'AuthenticationKey' => $this->options['authentication_key'],
				'RetailerGuid' => $this->options['retailer_guid'],
				'RetailerId' => $this->options['retailer_id'],
				'UserId' => null
			)
		);

		// run the API request to go get the product details
		$result = $this->do_api_post('GetRetailerFinanceProducts', 'financeProductListRequest', 'GetRetailerFinanceProductsResult', $api_request);

		if ( isset( $result->FinanceProducts ) && is_object( $result->FinanceProducts ) ) {
			if ( isset( $result->FinanceProducts->FinanceProduct ) && is_array( $result->FinanceProducts->FinanceProduct ) ) {
				$product_table = $wpdb->prefix . BFI_WC_V12_TABLE;

				// make all existing items inactive
				$wpdb->query( "UPDATE {$product_table} SET state = 0" );

				// now loop through and add everything to the DB
				foreach ( $result->FinanceProducts->FinanceProduct as $finance_product ) {
					$sql = "INSERT INTO {$product_table} (
							apr, calculation_factor, deferred_period, description,
							document_fee, document_fee_collection_month, document_fee_maximum, document_fee_minimum,
							document_fee_percentage, min_loan, max_loan, monthly_rate,
							months, name, option_period, product_guid,
							product_id, service_fee, settlement_fee, tag,
							alt_tag, state, wc_min_loan, wc_max_loan,
							wc_min_discount, wc_max_discount, is_enabled
						)
						VALUES (
							%f, %f, %d, %s,
							%f, %d, %d, %d,
							%f, %f, %f, %f,
							%d, %s, %d, %s,
							%d, %f, %f, %s,
							%s, 1, %f, %f,
							0, 0, 0
						)
						ON DUPLICATE KEY UPDATE
							apr = VALUES(apr),
							calculation_factor = VALUES(calculation_factor),
							deferred_period = VALUES(deferred_period),
							description = VALUES(description),
							document_fee = VALUES(document_fee),
							document_fee_collection_month = VALUES(document_fee_collection_month),
							document_fee_maximum = VALUES(document_fee_maximum),
							document_fee_minimum = VALUES(document_fee_minimum),
							document_fee_percentage = VALUES(document_fee_percentage),
							min_loan = VALUES(min_loan),
							max_loan = VALUES(max_loan),
							monthly_rate = VALUES(monthly_rate),
							months = VALUES(months),
							name = VALUES(name),
							option_period = VALUES(option_period),
							product_guid = VALUES(product_guid),
							service_fee = VALUES(service_fee),
							settlement_fee = VALUES(settlement_fee),
							tag = VALUES(tag),
							alt_tag = VALUES(alt_tag),
							state = 1
					";

					// add all the values to the prepared statement
					$sql = $wpdb->prepare(
						$sql,
						$finance_product->APR,
						$finance_product->CalculationFactor,
						$finance_product->DeferredPeriod,
						$finance_product->Description,
						$finance_product->DocumentFee,
						$finance_product->DocumentFeeCollectionMonth,
						$finance_product->DocumentFeeMaximum,
						$finance_product->DocumentFeeMinimum,
						$finance_product->DocumentFeePercentage,
						$finance_product->MinLoan,
						$finance_product->MaxLoan,
						$finance_product->MonthlyRate,
						$finance_product->Months,
						$finance_product->Name,
						$finance_product->OptionPeriod,
						$finance_product->ProductGuid,
						$finance_product->ProductId,
						$finance_product->ServiceFee,
						$finance_product->SettlementFee,
						$finance_product->Tag,
						preg_replace('/[^A-Z]/', '', strtoupper($finance_product->Tag)),
						$finance_product->MinLoan,
						$finance_product->MaxLoan
					);
					$wpdb->query($sql);
				}
			}
		}
	}

	/**
	 * Check V12 Enabled and set-up.
	 *
	 * @since    1.0.0
	 */
	protected function check_v12_enabled() {
		// check that the options have been set for the payment gateway
		if ( empty($this->options) ) {
			return false;
		}

		// check that we have option values for the auth details
		if ( empty($this->options['enabled']) || empty($this->options['authentication_key']) || empty($this->options['retailer_guid']) || empty($this->options['retailer_id']) ) {
			return false;
		}

		// now check that V12 is enabled
		if ( $this->options['enabled'] != 'yes' ) {
			return false;
		}

		// all ok
		return true;
	}

	/**
	 * Get Application Status from V12.
	 *
	 * @since    1.0.0
	 */
	public function check_application_status( $order ) {
		// get the details required to check the order status
		$application_id = $order->v12_application_id;

		// build the request for V12 to get the products
		$api_request = (object) array(
			'ApplicationId' => $application_id,
			'IncludeExtraDetails' => false,
			'IncludeFinancials' => false,
			'Retailer' => (object) array(
				'AuthenticationKey' => $this->options['authentication_key'],
				'RetailerGuid' => $this->options['retailer_guid'],
				'RetailerId' => $this->options['retailer_id']
			)
		);

		// run the API request to go get the product details
		$v12_result = $this->do_api_post('CheckApplicationStatus', 'applicationStatusRequest', 'CheckApplicationStatusResult', $api_request);

		if ( ! empty($v12_result->Status) ) {
			$order_id = $order->id;
			$v12_status = $v12_result->Status;
			update_post_meta($order_id, '_v12_status', $v12_status);
			return $v12_status;
		}
	}

	/**
	 * Update Application Status via V12.
	 *
	 * @since    1.0.0
	 */
	public function update_application_status( $order, $status, $refund = null ) {
		// get the details required to check the order status
		$application_id = $order->v12_application_id;

		// build the request for V12 to get the products
		$api_request = (object) array(
			'ApplicationId' => $application_id,
			'Update' => $status,
			'Retailer' => (object) array(
				'AuthenticationKey' => $this->options['authentication_key'],
				'RetailerGuid' => $this->options['retailer_guid'],
				'RetailerId' => $this->options['retailer_id']
			)
		);

		// set refund amount
		if ( ! is_null($refund) ) {
			$api_request->RefundAmount = $refund;
		}

		// run the API request to change the status of the order
		$v12_result = $this->do_api_post('UpdateApplication', 'applicationUpdateRequest', 'UpdateApplicationResult', $api_request);
		if ( $v12_result->status == 'ErrorProcessing' ) {
			return false;
		}
		else {
			return true;
		}
	}

	/**
	 * Cancel Finance with V12.
	 *
	 * @since    1.0.0
	 */
	public function cancel_order( $order_id ) {
		$order = new WC_Order( $order_id );
		$result = $this->update_application_status( $order, 'Cancel' );
		if ( $result == true ) {
			$order->add_order_note( __( 'Updated Finance Status to Cancelled.', 'woocommerce_v12retailfinance' ) );
		}
	}

	/**
	 * Mark V12 Finance as request payment (order completed, ie: shipped).
	 *
	 * @since    1.0.0
	 */
	public function complete_order( $order_id ) {
		$order = new WC_Order( $order_id );
		$result = $this->update_application_status( $order, 'RequestPayment' );
		if ( $result == true ) {
			$order->add_order_note( __( 'Updated Finance Status to Payment Requested.', 'woocommerce_v12retailfinance' ) );
		}
	}

	/**
	 * Mark V12 Finance as request payment (order completed, ie: shipped).
	 *
	 * @since    1.0.0
	 */
	public function do_refund( $order_id, $refund_amount ) {
		$order = new WC_Order( $order_id );
		$result = $this->update_application_status( $order, 'PartialRefund', $refund_amount );
		if ( $result == true ) {
			$order->add_order_note( __( 'Requested Partial Refund with V12 Finance.', 'woocommerce_v12retailfinance' ) );
		}
	}

	/**
	 * Check the V12 Status on orders that haven't been completed/cancelled/etc yet.
	 *
	 * @since    1.0.0
	 */
	 public function cron_check_v12_status() {
		 global $wpdb;

		$v12_order_email = get_option( 'bfi-woocommerce-v12-order-email' );
		$v12_licence_key = get_option( 'bfi-woocommerce-v12-key' );

		if ( ! empty($v12_licence_key) ) {
			// build the request
			$args = array(
				'request'     => 'check',
				'email'       => $v12_order_email,
				'license_key' => $v12_licence_key,
				'product_id'  => BFI_WC_V12_PRODID,
				'instance' 	  => site_url()
			);

			$target_url = BFI_WC_V12_APIURL . http_build_query( $args );
			$data = wp_remote_get( $target_url );
			if ( isset($data['response']['code']) && $data['response']['code'] == 200 ) {
				// ok we've got a response, get the details
				$api_status = json_decode($data['body']);
				if ( isset($api_status->success) && $api_status->success == 1 ) {
					if ( isset($api_status->timestamp) ) {
						update_option( 'bfi-woocommerce-v12-activation-check', $api_status->timestamp );
					}
				}
			}
		}

		// get all the orders from the DB that are V12 and the order hasn't been completed yet
		$v12_order_ids = $wpdb->get_results("
			SELECT
				ID
			FROM
				$wpdb->posts P
			INNER JOIN
				$wpdb->postmeta PM
				ON PM.post_id = P.ID AND PM.meta_key = '_v12_status'
			WHERE
				P.post_type = 'shop_order'
				AND PM.meta_value NOT IN ('PaymentProcessed', 'Cancelled', 'Unknown', 'ErrorProcessing')
				AND post_date > DATE_SUB(NOW(), INTERVAL 1 MONTH)
			ORDER BY
				post_date DESC
		", ARRAY_A);

		foreach ($v12_order_ids as $order_id) {
			$order = new WC_Order( $order_id );
			$this->check_application_status( $order );
		}
	 }
}

/**
 * Extended V12 SOAP client with URL structures
 *
 * @since      1.0.0
 * @package    BFI_Woocommerce_V12_Finance
 * @subpackage BFI_Woocommerce_V12_Finance/includes
 * @author     BFI <info@wearebfi.co.uk>
 */
class V12_SoapClient extends SoapClient {

    protected $_wsdl; // WSDL of SOAP web service
    protected $_location; // URI of web service
    protected $_gateway; // Gateway for function calls

    public function __construct() {
        // Set-up SOAP WSDL
        $this->_wsdl = 'https://apply.v12finance.com/Services/ApplicationGatewayWebService.svc?wsdl';
        $this->_location = 'https://apply.v12finance.com/Services/ApplicationGatewayWebService.svc';
        $this->_gateway = 'http://v12finance.com/Services/ApplicationGateway/1.1/IApplicationGatewayWebService/';

        // Define options for SOAP client
        $options = array('trace' => 1, 'soap_version' => SOAP_1_2);

        return parent::__construct($this->_wsdl, $options);
    }

    /**
     * @param $function
     * @param $action
     * @param $dataObj
     * @return mixed
     */
    public function soapCall($function, $action, $dataObj) {
        // Set 'To' and 'Action' headers
        $headers = array(
            new SoapHeader("http://www.w3.org/2005/08/addressing", "Action", $this->_gateway . $function, true),
            new SoapHeader("http://www.w3.org/2005/08/addressing", "To", $this->_location, true)
        );
        $this->__setSoapHeaders($headers);

        // Create wrapper object for the request
        $wrapperObj = new stdClass();
        $wrapperObj->$action = $dataObj;

        return parent::__soapCall($function, array($wrapperObj));
    }
}
