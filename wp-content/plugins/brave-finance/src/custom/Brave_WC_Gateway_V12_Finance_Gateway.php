<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Brave_WC_Gateway_V12_Finance_Gateway
 *
 * @author developer
 */
class Brave_WC_Gateway_V12_Finance_Gateway extends BFI_WC_Gateway_V12_Finance_Gateway {

    //put your code here

    public function __construct() {
        parent::__construct();

        $this->icon = plugin_dir_url(__FILE__) . '../public/images/192x74.jpg';
        $this->method_title = __('Close Brothers Retail Finance', 'woocommerce_v12retailfinance');
    }

    /**
     * Show Module Description
     *
     * @since    1.0.0
     */
    private function v12_description() {
        // set the description here
        return __('Close Brothers Retail Finance', 'woocommerce_v12retailfinance');
    }

    private function _get_order_total() {
        $reflector = new ReflectionObject($this);
        $method = $reflector->getMethod('get_order_total');
        $method->setAccessible(true);
        return $method->invoke($this);
    }

    /**
     * Get the details of the finance product chosen by the customer
     *
     * @since    1.0.0
     */
    private function get_finance_product_details($product_id, $borrow_amount) {
        global $wpdb;

        // check for any discounts on products, this will determin what finance options are available to use
        $max_discount = $this->_calculate_discount();

        $product_table = $wpdb->prefix . BFI_WC_V12_TABLE;
        $db_finance_prod = $wpdb->get_row($wpdb->prepare("
			SELECT
				id,
				apr,
				deferred_period,
				description,
				months,
				monthly_rate,
				calculation_factor,
				service_fee,
				settlement_fee,
				name,
				product_guid,
				product_id,
                                tag,
				wc_min_loan,
				wc_max_loan,
				wc_min_discount,
				wc_max_discount
			FROM
				{$product_table}
			WHERE
				state = 1
				AND is_enabled = 1
				AND id = %d
				AND wc_min_loan <= %f
				AND wc_min_discount <= %f
				AND wc_max_discount >= %f
		", $product_id, $borrow_amount, $max_discount, $max_discount));

        if (!empty($db_finance_prod)) {
            return $db_finance_prod;
        } else {
            return false;
        }
    }

    /**
     * 
     * @return type
     */
    private function _calculate_discount() {

        $reflector = new ReflectionObject($this);
        $method = $reflector->getMethod('calculate_discount');
        $method->setAccessible(true);
        return $method->invoke($this);
    }

    function process_payment($order_id) {
        global $woocommerce;

       
        
        $order = new WC_Order($order_id);

        // get the values from the form
        $finance_option = isset($_POST['v12_finance_option']) ? woocommerce_clean($_POST['v12_finance_option']) : '';
        $deposit_amount = isset($_POST['v12_deposit_amount']) ? woocommerce_clean($_POST['v12_deposit_amount']) : '';

        // get the finance product details from the DB
        $borrow_amount = $this->get_order_total() - $deposit_amount;
        $finance_product = $this->get_finance_product_details($finance_option, $borrow_amount);

           
        if (empty($finance_option) || empty($finance_product)) {
            throw new Exception(__('Please choose a valid finance option from the drop down', 'woocommerce_v12retailfinance'));
        }
 
        
        $order_total = $this->get_order_total();
        $min_deposit_amount = $order_total - $finance_product->wc_max_loan;
        if ($min_deposit_amount < 0) {
            $min_deposit_amount = $finance_product->wc_min_loan;
        }
        $max_deposit_amount = $order_total - $finance_product->wc_min_loan;
        if ($max_deposit_amount < 0) {
            $max_deposit_amount = $finance_product->wc_max_loan;
        }

        if (empty($deposit_amount) || $deposit_amount < $min_deposit_amount || $deposit_amount > $max_deposit_amount) {
            throw new Exception(sprintf(__('Please enter a deposit amount between %.2f and %.2f', 'woocommerce_v12retailfinance'), number_format($min_deposit_amount, 2, '.', ''), number_format($max_deposit_amount, 2, '.', '')));
        }

        // save the details to the order
        update_post_meta($order_id, '_v12_product', $finance_option);
        update_post_meta($order_id, '_v12_deposit', $deposit_amount);

        // Mark as on-hold (we're awaiting the finance decision)
        $order->update_status('wc-pending', __('Awaiting finance results.', 'woocommerce_v12retailfinance'));

        // Reduce stock levels
        $order->reduce_order_stock();

        // Remove cart
        $woocommerce->cart->empty_cart();

        // Return redirect page
        return array(
            'result' => 'success',
            'redirect' => $order->get_checkout_payment_url(true)
        );
    }

    /**
     * Show Receipt page
     *
     * @since    1.0.0
     */
    function receipt_page($order_id) {
        global $wpdb;
        global $woocommerce;

        $order = new WC_Order($order_id);

        // get the values from the form
        $finance_option = get_post_meta($order_id, '_v12_product', true);
        $deposit_amount = get_post_meta($order_id, '_v12_deposit', true);

        // get the finance product details from the DB
        $borrow_amount = $this->_get_order_total() - $deposit_amount;
        $finance_product = $this->get_finance_product_details($finance_option, $borrow_amount);

        //$product_code = $this->getRates($finance_product->taf . "_" . $finance_product->apr);


        // build an array of order lines to add to the order
        $order_lines = '';
        $items = $order->get_items();
        if (!empty($items)) {
            foreach ($items as $item) {
                $item_details = new WC_Product($item['product_id']);
                $item_price = number_format($item['line_total'] / $item['qty'], 2, '.', '');
                $order_lines .= sprintf(" Item: %s, Price: %s, Qty: s% , Desc: s%" . PHP_EOL, $item['name'], number_format($item_price, 2, '.', ''), $item['qty'], $item_details->get_sku(), $item_details);
            }
        }

        $v12_request = [];

        /* required */
        $v12_request['action'] = 'credit_application_link';
        $v12_request['Identification[api_key]'] = BRAVE_WC_V12_API_KEY;
        $v12_request['Identification[RetailerUniqueRef]'] = $order_id;
        $v12_request['Identification[InstallationID]'] = BRAVE_WC_V12_API_KEY_ID_INST;
        $v12_request['Finance[Deposit]'] = $deposit_amount * 100;
        $v12_request['Finance[Code]'] = $finance_product->product_id;
        $v12_request['Goods[Description]'] = $order_lines;
        $v12_request['Goods[Price]'] = $this->_get_order_total() * 100;

        /* not required */
        $v12_request['Consumer[Surname]'] = $order->billing_first_name;
        $v12_request['Consumer[Forename]'] = $order->billing_last_name;
        $v12_request['Consumer[MobileNumber]'] = $order->billing_phone;
        $v12_request['Consumer[EmailAddress]'] = $order->billing_email;


        // Make the V12 API Request
        $v12_plugin = new Brave_Woocommerce_V12_Finance();
        $v12_result = $v12_plugin->bfi_v12_api->call($v12_request);


        $v12_status = 0;
        if ($v12_result->Status) {
            $v12_status = 1;
            update_post_meta($order_id, '_v12_status', 'Processing');
        } else {
            update_post_meta($order_id, '_v12_status', 'Error');
        }


        if (!empty($v12_result) && $v12_result->status !== false) {
            update_post_meta($order_id, '_v12_status', 'Pushed to Financed');
            // save the application details against the order
            update_post_meta($order_id, '_v12_status', $v12_result->Status);
            update_post_meta($order_id, '_v12_application_guid', $v12_result->ApplicationGuid);
            update_post_meta($order_id, '_v12_application_id', $v12_result->ApplicationId);

            // Mark as on-hold (we're awaiting the finaince decision)
            $order->update_status('wc-processing', __('Awaiting finance results', 'woocommerce_v12retailfinance'));

            echo '<p><a href="' . $v12_result . '">';
            echo __('Continue to Close Brothers Finance Form', 'woocommerce_v12retailfinance');
            echo '</a></p>';

            wc_enqueue_js('
                jQuery("body").block({
                    message: "<img src=\"' . esc_url(apply_filters('woocommerce_ajax_loader_url', $woocommerce->plugin_url() . '/assets/images/select2-spinner.gif')) . '\" alt=\"Redirecting&hellip;\" style=\"float:left; margin-right: 10px;\" />' . __('Thank you for your order. We are now redirecting you to Close Brothers to arrange your finance.', 'woocommerce_v12retailfinance') . '",
                    overlayCSS:
                    {
                        background: "#fff",
                        opacity: 0.6
                    },
                    css: {
                        padding:        20,
                        textAlign:      "center",
                        color:          "#555",
                        border:         "3px solid #aaa",
                        backgroundColor:"#fff",
                        cursor:         "wait",
                        lineHeight:		"32px"
                    }
                });
                jQuery(location).attr(\'href\', \'' . $v12_result . '\')
            ');
        } else {
            // an error occured, so show contact info
            if (!empty($v12_result->Errors)) {
                update_post_meta($order_id, '_v12_errors', $v12_result->Errors);
            }
            echo __('An error occured when trying to process your finance application, please contact us to complete your order.', 'woocommerce_v12retailfinance');
        }
    }

    public function getRates($id = null) {

        $apr = array(
            #0.0%
            "ONIF6" => ["Product_Code" => "ONIF6", "Product_Type" => "Interest Free Credit (0% APR)", "apr" => 0, "Term" => 6],
            "ONIF9" => ["Product_Code" => "ONIF9", "Product_Type" => "Interest Free Credit (0% APR)", "apr" => 0, "Term" => 9],
            "ONIF10" => ["Product_Code" => "ONIF10", "Product_Type" => "Interest Free Credit (0% APR)", "apr" => 0, "Term" => 10],
            "ONIF12" => ["Product_Code" => "ONIF18", "Product_Type" => "Interest Free Credit (0% APR)", "apr" => 0, "Term" => 12],
            "ONIF18" => ["Product_Code" => "ONIF18", "Product_Type" => "Interest Free Credit (0% APR)", "apr" => 0, "Term" => 18],
            "ONIF24" => ["Product_Code" => "ONIF24", "Product_Type" => "Interest Free Credit (0% APR)", "apr" => 0, "Term" => 24],
            "ONIF36" => ["Product_Code" => "ONIF36", "Product_Type" => "Interest Free Credit (0% APR)", "apr" => 0, "Term" => 36],
            "ONIF48" => ["Product_Code" => "ONIF48", "Product_Type" => "Interest Free Credit (0% APR)", "apr" => 0, "Term" => 48],
            #4.9%
            "ONIB12-4.9" => ["Product_Code" => "ONIB12-4.9", "Product_Type" => "Low Rate Credit (4.9% APR)", "apr" => 4.9, "Term" => 12],
            "ONIB24-4.9" => ["Product_Code" => "ONIB24-4.9", "Product_Type" => "Low Rate Credit (4.9% APR)", "apr" => 4.9, "Term" => 24],
            "ONIB36-4.9" => ["Product_Code" => "ONIB36-4.9", "Product_Type" => "Low Rate Credit (4.9% APR)", "apr" => 4.9, "Term" => 36],
            "ONIB48-4.9" => ["Product_Code" => "ONIB48-4.9", "Product_Type" => "Low Rate Credit (4.9% APR)", "apr" => 4.9, "Term" => 48],
            #9.9%
            "ONIB12-9.9" => ["Product_Code" => "ONIB12-9.9", "Product_Type" => "Low Rate Credit (9.9% APR)", "apr" => 9.9, "Term" => 12],
            "ONIB24-9.9" => ["Product_Code" => "ONIB24-9.9", "Product_Type" => "Low Rate Credit (9.9% APR)", "apr" => 9.9, "Term" => 24],
            "ONIB36-9.9" => ["Product_Code" => "ONIB36-9.9", "Product_Type" => "Low Rate Credit (9.9% APR)", "apr" => 9.9, "Term" => 36],
            "ONIB48-9.9" => ["Product_Code" => "ONIB48-9.9", "Product_Type" => "Low Rate Credit (9.9% APR)", "apr" => 9.9, "Term" => 48],
            #14.9%    
            "ONIB12-14.9" => ["Product_Code" => "ONIB12-14.9", "Product_Type" => "Low Rate Credit (14.9% APR)", "apr" => 14.9, "Term" => 12],
            "ONIB24-14.9" => ["Product_Code" => "ONIB24-14.9", "Product_Type" => "Low Rate Credit (14.9% APR)", "apr" => 14.9, "Term" => 24],
            "ONIB36-14.9" => ["Product_Code" => "ONIB36-14.9", "Product_Type" => "Low Rate Credit (14.9% APR)", "apr" => 14.9, "Term" => 36],
            "ONIB48-14.9" => ["Product_Code" => "ONIB48-14.9", "Product_Type" => "Low Rate Credit (14.9% APR)", "apr" => 14.9, "Term" => 48],
            #19.5%    
            "ONIB12-19.5" => ["Product_Code" => "ONIB12-19.5", "Product_Type" => "Low Rate Credit (19.5% APR)", "apr" => 19.5, "Term" => 12],
            "ONIB24-19.5" => ["Product_Code" => "ONIB24-19.5", "Product_Type" => "Low Rate Credit (19.5% APR)", "apr" => 19.5, "Term" => 24],
            "ONIB36-19.5" => ["Product_Code" => "ONIB36-19.5", "Product_Type" => "Low Rate Credit (19.5% APR)", "apr" => 19.5, "Term" => 36],
            "ONIB48-19.5" => ["Product_Code" => "ONIB48-19.5", "Product_Type" => "Low Rate Credit (19.5% APR)", "apr" => 19.5, "Term" => 48],
        );

        /* update products on v12 */
        foreach ($apr as $value) {
            $this->updateProducts($value);
        }


        if ($id) {
            $id = str_replace(".", "", $id);
            return isset($apr[$id]) ? $apr[$id] : null;
        }

        return $apr;
    }

    private function updateProducts($value) {

        global $wpdb;

        $filename = __DIR__ . DIRECTORY_SEPARATOR . "lookmeonce.dot";

        if (!file_exists($filename)) {
            $alter = "ALTER TABLE " . $wpdb->prefix . BFI_WC_V12_TABLE . " CHANGE COLUMN `product_id` `product_id` VARCHAR(65) NOT NULL COMMENT 'Product Id' ;";
            $wpdb->query($alter);
            $truncate = "truncate " . $wpdb->prefix . BFI_WC_V12_TABLE . " ;";
            $wpdb->query($truncate);

            $handle = fopen($filename, "w");
            fclose($handle);
        }

        $table = $wpdb->prefix . BFI_WC_V12_TABLE;
        $data = array(
            'name' => $value['Product_Type'] . "( Month(s){$value['Term']})",
            'product_id' => $value['Product_Code'],
            'months' => $value['Term'],
            'apr' => $value['apr'],
            'tag' => $value['Product_Code'],
        );
        $data_format = array('%s', '%s', '%s', '%s', '%s');
        $where = array('product_id' => $value['product_id']);

        $sql = 'SELECT count(*) as total FROM ' . $wpdb->prefix . BFI_WC_V12_TABLE . " WHERE product_id = \"{$value['Product_Code']}\";";

        //check if existis
        $results = $wpdb->get_results($sql);
        //start checks 
        if ($results[0]->total == 1) {
            //update 
            $wpdb->update($table, $data, $where, $data_format);
        } else {

            //create 
            try {
                $wpdb->insert($table, $data, $data_format);
            } catch (\Exception $e) {
                var_dump($e->getMessage());
            }
        }
    }

    /**
     * Extend the V12 Admin Options to include a table of the products
     *
     * @since    1.0.0
     */
    function admin_options() {
        global $wpdb;

        //call new rates
        $this->getRates();

        // build the admin options screen
        echo '<h2>' . $this->method_title . '</h2>';

        //echo '<p><a href="/wp-admin/admin.php?page=bfi_wc_v12_key">Click here to check Licence Key and Activate.</a></p>';

        echo '<table class="form-table">';
        echo $this->generate_settings_html();
        echo '</table>';

        // add the table of available options
        echo '<h3>' . __(BRAVE_APP_NAME . ' Available Finance Options', 'woocommerce_v12retailfinance') . '</h3>';
        echo '<p><strong>' . __('Please Note:', 'woocommerce_v12retailfinance') . '</strong> ';
        echo sprintf(__('If no minimum or maximum values are entered and saved, then it will default to the minimum value of %d and a maximum value of %d.', 'woocommerce_v12retailfinance'), self::MIN_LOAN, self::MAX_LOAN);
        echo '</p><p>';
        echo __('When setting the min/max Discount values, to exclude any discounted products make sure both min and max are set to 0.', 'woocommerce_v12retailfinance');
        echo '</p>';

        // grab all the options from the DB
        $results = $wpdb->get_results('
			SELECT
				id,
                name,
                custom_label,
				is_enabled,
				wc_min_loan,
				wc_max_loan,
				wc_min_discount,
				wc_max_discount,
                                apr
			FROM
				' . $wpdb->prefix . BFI_WC_V12_TABLE . '
			WHERE
				state = 1
			ORDER BY
				alt_tag ASC,
				monthly_rate ASC,
				months ASC
		');

        if (count($results)) {

            echo '<table>';

            echo '<th>' . __('Product', 'woocommerce_v12retailfinance') . '</th>';
            echo '<th>' . __('Custom Label', 'woocommerce_v12retailfinance') . '</th>';
            echo '<th>' . __('Enabled', 'woocommerce_v12retailfinance') . '</th>';
            echo '<th>' . __('APR%', 'woocommerce_v12retailfinance') . '</th>';
            echo '<th>' . __('Minimum Value', 'woocommerce_v12retailfinance') . '</th>';
            echo '<th>' . __('Maximum Value', 'woocommerce_v12retailfinance') . '</th>';
            echo '<th>' . __('Minimum Discount', 'woocommerce_v12retailfinance') . '</th>';
            echo '<th>' . __('Maximum Discount', 'woocommerce_v12retailfinance') . '</th>';
            echo '</tr>';




            foreach ($results as $row) {

                echo '<tr>';
                echo '<td>' . $row->name . '</td>';
                echo '<td><input type="text" name="v12prod[' . $row->id . '][custom_label]" value="' . $row->custom_label . '"></td>';
                echo '<td><input type="checkbox" name="v12prod[' . $row->id . '][enabled]" value="1"' . ($row->is_enabled == "1" ? ' checked' : '') . '></td>';

                echo '<td><input type="hidden" name="v12prod[' . $row->id . '][apr]" value="' . $row->apr . '"_"' . $row->product_id . ' >' . $row->apr . '</td>';

                echo '<td><input type="text" class="bfi_min_value" name="v12prod[' . $row->id . '][min_val]" value="' . $row->wc_min_loan . '"></td>';
                echo '<td><input type="text" name="v12prod[' . $row->id . '][max_val]" value="' . $row->wc_max_loan . '"></td>';
                echo '<td><input type="text" name="v12prod[' . $row->id . '][min_disc]" value="' . $row->wc_min_discount . '"></td>';
                echo '<td><input type="text" name="v12prod[' . $row->id . '][max_disc]" value="' . $row->wc_max_discount . '"></td>';
                echo '</tr>';
            }

            echo '</table>';
        } else {

            // no options
            echo '<p><strong>' . __('Sorry, no finance products to display.', 'woocommerce_v12retailfinance') . '</strong></p>';
        }

        // build array of statuses (using filter, so can be changed by other plugins)
        $finance_status = apply_filters('bfi_v12_finance_status', array(
            'Acknowledged' => array(
                'v12' => 'Acknowledged',
                'wc' => 'Processing',
                'stage' => '1'
            ),
            'Referred' => array(
                'v12' => 'Referred',
                'wc' => 'On Hold',
                'stage' => '2'
            ),
            'Accepted' => array(
                'v12' => 'Accepted',
                'wc' => 'Processing',
                'stage' => '3'
            ),
            'AwaitingFulfilment' => array(
                'v12' => 'Awaiting Fulfilment',
                'wc' => 'Processing',
                'stage' => '4'
            ),
            'PaymentRequested' => array(
                'v12' => 'Payment Requested',
                'wc' => 'Completed',
                'stage' => '5'
            ),
            'PaymentProcessed' => array(
                'v12' => 'Payment Processed',
                'wc' => 'Completed',
                'stage' => '6'
            ),
            'Cancelled' => array(
                'v12' => 'Cancelled',
                'wc' => 'Cancelled',
                'stage' => ''
            ),
            'Error' => array(
                'v12' => 'Error',
                'wc' => 'Cancelled',
                'stage' => ''
            ),
            'Declined' => array(
                'v12' => 'Declined',
                'wc' => 'Cancelled',
                'stage' => ''
            )
        ));

        echo '<p><a href="' . wp_nonce_url(admin_url('admin-ajax.php?action=update_v12_products'), 'update-v12-products') . '">' . __('Update Finance Products from V12.', 'woocommerce_v12retailfinance') . '</a></p>';

        echo '<h3>' . __(BRAVE_APP_NAME . ' Status Map', 'woocommerce_v12retailfinance') . '</h3>';

        echo '<p>' . __('Applications status is shown in the WooCommerce `Orders` section, WooCommerce status types are mapped with status types below:', 'woocommerce_v12retailfinance') . '</p>';

        echo '<table class="widefat fixed" cellspacing="0">';
        echo '<tr>';
        echo '<th class="manage-column column-columnname" scope="col">' . __('Status', 'woocommerce_v12retailfinance') . '</th>';
        echo '<th class="manage-column column-columnname" scope="col">' . __('WooCommerce Status', 'woocommerce_v12retailfinance') . '</th>';
        echo '<th class="manage-column column-columnname" scope="col">' . __('Stage', 'woocommerce_v12retailfinance') . '</th>';
        echo '</tr>';

        $row_count = 0;
        foreach ($finance_status as $fs_key => $fs_details) {
            $row_class = '';
            if ($row_count == 0) {
                $row_class = ' class="alternate"';
            }
            echo '<tr' . $row_class . '>';
            echo '<td> ' . $fs_details['v12'] . ' </td>';
            echo '<td> ' . $fs_details['wc'] . ' </td>';
            echo '<td> ' . $fs_details['stage'] . ' </td>';
            echo '</tr>';
            $row_count++;
            $row_count %= 2;
        }
        echo '</table>';
    }

    /**
     * Process changes tot he admin options
     *
     * @since    1.0.0
     */
    function process_admin_options() {
        global $wpdb;

        // use the parent function to save the main options
        $updated = parent::process_admin_options();

        // now handle updating the V12 products
        if (isset($_POST['v12prod']) && is_array($_POST['v12prod'])) {
            foreach ($_POST['v12prod'] as $prod_id => $prod_options) {
                $enabled = (!empty($_POST['v12prod'][$prod_id]['enabled']) ? 1 : 0);

                // check the values entered
                $apr_val = $_POST['v12prod'][$prod_id]['apr'];
                $explode = explode("_", $apr_val);

                $apr_val = $explode[0];
                $tag = $explode[1];

                if (($apr_val < 0 || $apr_val > 100) && is_null($apr_val)) {
                    $apr_val = 0;
                }
                $monthly_rate = ($apr_val / 100) / 12;
                // check the values entered
                $min_val = $_POST['v12prod'][$prod_id]['min_val'];
                if ($min_val < self::MIN_LOAN || $min_val > self::MAX_LOAN) {
                    $min_val = self::MIN_LOAN;
                }

                $max_val = $_POST['v12prod'][$prod_id]['max_val'];
                if ($max_val < self::MIN_LOAN || $max_val > self::MAX_LOAN) {
                    $max_val = self::MAX_LOAN;
                }

                // only allow discount values between 0 and 100
                $min_disc = $_POST['v12prod'][$prod_id]['min_disc'];
                if ($min_disc < 0 || $min_disc > 100) {
                    $min_disc = 0;
                }

                $max_disc = $_POST['v12prod'][$prod_id]['max_disc'];
                if ($max_disc < 0 || $max_disc > 100) {
                    $max_disc = 100;
                }

                $custom_label = $_POST['v12prod'][$prod_id]['custom_label'];

                $wpdb->update(
                        $wpdb->prefix . BFI_WC_V12_TABLE, array(
                    'custom_label' => $custom_label, // string
                    'is_enabled' => $enabled, // string
                    'wc_min_loan' => $min_val, // string
                    'wc_max_loan' => $max_val, // string
                    'wc_min_discount' => $min_disc, // string
                    'wc_max_discount' => $max_disc, // string
                    'apr' => $apr_val, // string
                    'monthly_rate' => $monthly_rate, // string
                    'calculation_factor' => '0.10000', // string
                    'tag' => $tag, // string
                        ), array('id' => $prod_id), array(
                    '%s',
                    '%d',
                    '%f',
                    '%f',
                    '%f',
                    '%f',
                    '%f',
                    '%f',
                    '%f',
                    '%f',
                    '%s'
                        ), array('%d')
                );
            }
        }

        return $updated;
    }

    /**
     * Build the V12 Product / Deposit Selection
     *
     * @since    1.0.0
     */
    public function v12_finance_form() {
        global $wpdb;

        $stop_on_coupon = $this->get_option('stop_on_coupon');

        if (isset($stop_on_coupon) && $stop_on_coupon == 'yes') {
            echo __('Sorry, we can not process finance payments when using a ', 'woocommerce_v12retailfinance') . __('Coupon code', 'woocommerce');
        } else {
            // get the min / max deposit values & min borrowing amount
            $order_total = $this->_get_order_total();

            list($min_deposit_percentage, $max_deposit_percentage, $min_deposit_amount, $max_deposit_amount) = $this->get_min_max_deposit($order_total);

            $min_borrow_amount = $order_total - $min_deposit_amount;

            // check for any discounts on products, this will determin what finance options are available to use
            $max_discount = $this->_calculate_discount();

            // first get all the available products from the DB
            $product_table = $wpdb->prefix . BFI_WC_V12_TABLE;
            $db_finance_sql = $wpdb->prepare("
				SELECT
					id,
					apr,
					deferred_period,
					description,
					months,
					monthly_rate,
					calculation_factor,
					service_fee,
					settlement_fee,
                    name,
                    custom_label,
					product_guid,
					product_id,
					tag,
					wc_min_loan,
					wc_max_loan,
					wc_min_discount,
					wc_max_discount
				FROM
					{$product_table}
				WHERE
					state = 1
					AND is_enabled = 1
					AND wc_min_loan <= %f
					AND wc_min_discount <= %f
					AND wc_max_discount >= %f
				ORDER BY
					alt_tag ASC,
					monthly_rate ASC,
					months ASC
			", $min_borrow_amount, $max_discount, $max_discount);
            $db_finance_prods = apply_filters('bfi_v12_checkout_finance_products', $wpdb->get_results($db_finance_sql));

            if (!empty($db_finance_prods)) {
                // convert this into a key value array
                $finance_products = array();
                foreach ($db_finance_prods as $fprod) {
                    $finance_products[$fprod->product_id] = $fprod;
                }

                $deposit_amount = $min_deposit_amount;
                $variable_deposit = $this->get_option('variable_deposit');

                // load the template for the page
                include(plugin_dir_path(dirname(__FILE__)) . 'public/partials/gateway-v12-finance-selection.php');

                // Localize the script with new data
                wp_localize_script('v12_payment', 'v12_settings', array(
                    'order_total' => $order_total,
                    'deposit' => array(
                        'min_percentage' => $min_deposit_percentage,
                        'max_percentage' => $max_deposit_percentage,
                        'min_amount' => $min_deposit_amount,
                        'max_amount' => $max_deposit_amount
                    )
                ));
                wp_localize_script('v12_payment', 'v12_products', $finance_products);
                wp_enqueue_script('v12_payment');
                wp_enqueue_style('v12_payment');
            } else {
                // get the min and max order value
                $min_finance_value = $wpdb->get_var("
					SELECT
						wc_min_loan
					FROM
						{$product_table}
					WHERE
						state = 1
						AND is_enabled = 1
					ORDER BY
						wc_min_loan ASC
					LIMIT 1
				");

                list($min_deposit_percentage, $max_deposit_percentage, $min_deposit_amount, $max_deposit_amount) = $this->get_min_max_deposit($min_finance_value);

                $min_finance_value += $min_deposit_amount;
                echo sprintf('%s &pound;%.02f', __('Sorry, the minimum order value for V12 Retail Finance is', 'woocommerce_v12retailfinance'), $min_finance_value);
            }
        }
    }

    /**
     * Return the Min/Max Deposit Perecentages and Min/Max Deposit Amounts based on the Order Total
     *
     * @since    1.0.0
     */
    private function get_min_max_deposit($order_total = 0) {
        global $wpdb;

        // remove the min depsoit amount (from the total) - we can make sure this is the min value they will borrow
        $min_deposit_percentage = $this->get_option('min_desposit_percentage');
        $max_deposit_percentage = 0;
        $min_deposit_amount = 0;
        if (!empty($min_deposit_percentage) && $min_deposit_percentage > 0) {
            $min_deposit_amount = ($min_deposit_percentage / 100) * $order_total;
        }

        $max_deposit_amount = $order_total;

        $min_financeable = self::MIN_FINANCEABLE;

        if (!empty($min_financeable) && $min_financeable > 0) {
            $max_deposit_amount = $order_total - $min_financeable;
        }

        // get the maximum amount of finance available and check we aren't trying to go above that
        $product_table = $wpdb->prefix . BFI_WC_V12_TABLE;
        $max_finance_value = $wpdb->get_var("
			SELECT
				wc_max_loan
			FROM
				{$product_table}
			WHERE
				state = 1
				AND is_enabled = 1
			ORDER BY
				wc_max_loan DESC
			LIMIT 1
		");
        if ($order_total > $max_finance_value) {
            $finance_difference = $order_total - $max_finance_value;
            $min_deposit_amount += $finance_difference;
        }


        return array($min_deposit_percentage, $max_deposit_percentage, $min_deposit_amount, $max_deposit_amount);
    }

}
