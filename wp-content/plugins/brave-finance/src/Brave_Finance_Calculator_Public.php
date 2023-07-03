<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Brave_Finance_Calculator_Public
 *
 * @author developer
 */
class Brave_Finance_Calculator_Public extends BFI_Finance_Calculator_Public {

    /**
     * Initialize the class and set its properties.
     * price
     * @since    1.0.0
     * @param      string    $BFI_Finance_Calculator       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($BFI_Finance_Calculator, $version) {
        parent::__construct($BFI_Finance_Calculator, $version);
        remove_action('woocommerce_after_shop_loop_item_title', array($this, 'v12_smallest_monthly_payment_display_shop'), 10);
        remove_action( 'woocommerce_single_product_summary', array($this, 'v12_smallest_monthly_payment_display'), 20 );
    }

    /**
     * This is only called if a WooCommerce product has finance available, it sets up the content of the finance tab
     *
     * @since    1.0.0
     * @param      string    $BFI_Finance_Calculator       Finance Calculator
     * @param      string    $version    Finance Claculator
     */
    public function v12_show_finance() {
        global $wpdb;
        global $product;

        // only show when calc is NOT enabled!
        $options = get_option('woocommerce_v12retailfinance_settings', null);
        $calc_enabled = $options["enable_finance_calculator"];
        if ($calc_enabled != "yes") {
            $available_finance = $this->pull_available_finance_options();

            $price = $product->price;
            $price = (float) $price;

            // if we don't get a price then check if there are children to use instead
            if (empty($price)) {
                $child_prices = array();
                foreach ($product->get_children() as $child_id) {
                    $child = wc_get_product($child_id);
                    if ('' !== $child->get_price()) {
                        $child_prices[] = 'incl' === $tax_display_mode ? wc_get_price_including_tax($child) : wc_get_price_excluding_tax($child);
                    }
                }

                if (!empty($child_prices)) {
                    $price = min($child_prices);
                }
            }

            list($min_deposit_percentage, $max_deposit_percentage, $min_deposit_amount, $max_deposit_amount) = $this->get_min_max_deposit($price);

            $min_borrow_amount = $price - $min_deposit_amount;

            $max_discount = $this->calculate_discount();

            if (!empty($available_finance) && $max_deposit_amount >= $min_deposit_amount) {
                // convert this into a key value array
                $finance_products = array();
                foreach ($available_finance as $fprod) {
                    $finance_products[$fprod->product_id] = $fprod;
                }
                $deposit_amount = $min_deposit_amount;
                $options = get_option('woocommerce_v12retailfinance_settings', null);
                $variable_deposit = $options["variable_deposit"];

                $order_total = $price;

                require ( plugin_dir_path(__FILE__) . 'public/partials/gateway-v12-finance-selection.php');

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
                echo __('Payment error:', 'woothemes') . ' ' . __('Sorry, no finance products are available at this time.', 'woocommerce_v12retailfinance');
            }
        }
    }

    /**
     * Calculates the discount
     *
     * @since    1.0.0
     * @param      string    $BFI_Finance_Calculator       Finance Calculator
     * @param      string    $version    Finance Claculator
     */
    private function calculate_discount() {
        global $woocommerce;
        global $product;

        $max_discount = 0;
        if ($product->is_on_sale()) {
            if ($product->has_child()) {
                // parent product - we need to get the child price to work out the amount discounted
                $sale_price = $product->price;
                $regular_price = $product->price;

                foreach ($product->get_children() as $child_id) {
                    $child_price = get_post_meta($child_id, '_price', true);
                    if ($child_price == $sale_price) {
                        $regular_price = get_post_meta($child_id, '_regular_price', true);
                    }
                }
                $discount_amount = $regular_price - $sale_price;
                $discount_percent = ($discount_amount / $regular_price) * 100;
                if ($discount_percent > $max_discount) {
                    $max_discount = $discount_percent;
                }
            } else {
                // simple product (so use price from this item)
                $discount_amount = $product->get_regular_price() - $product->get_sale_price();
                $discount_percent = ($discount_amount / $product->get_regular_price()) * 100;
                if ($discount_percent > $max_discount) {
                    $max_discount = $discount_percent;
                }
            }
        }

        return $max_discount;
    }

    /**
     * This is only called if a WooCommerce product has finance available, it sets up the content of the finance tab
     *
     * @since    1.0.0
     * @param      string    $BFI_Finance_Calculator       Finance Calculator
     * @param      string    $version    Finance Claculator
     */
    public function v12_finance_tab_content($name, $tab_arr) {



        global $product;

        $db_finance_prods = $tab_arr["callback_parameters"]["1"];
        $options = get_option('woocommerce_v12retailfinance_settings', null);

        $price = $product->price;
        $price = (float) $price;

        // if we don't get a price then check if there are children to use instead
        if (empty($price)) {
            $child_prices = array();
            foreach ($product->get_children() as $child_id) {
                $child = wc_get_product($child_id);
                if ('' !== $child->get_price()) {
                    $child_prices[] = 'incl' === $tax_display_mode ? wc_get_price_including_tax($child) : wc_get_price_excluding_tax($child);
                }
            }

            if (!empty($child_prices)) {
                $price = min($child_prices);
            }
        }

        list($min_deposit_percentage, $max_deposit_percentage, $min_deposit_amount, $max_deposit_amount) = $this->get_min_max_deposit($price);

        $min_borrow_amount = $price - $min_deposit_amount;

        $max_discount = $this->calculate_discount();

        if (!empty($db_finance_prods) && $max_deposit_amount >= $min_deposit_amount) {
            // convert this into a key value array
            $finance_products = array();
            foreach ($db_finance_prods as $fprod) {
                $finance_products[$fprod->product_id] = $fprod;
            }
            $deposit_amount = $min_deposit_amount;
            $options = get_option('woocommerce_v12retailfinance_settings', null);
            $variable_deposit = $options["variable_deposit"];

            $order_total = $price;


            require ( plugin_dir_path(__FILE__) . 'public/partials/gateway-v12-finance-selection.php');


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
            echo __('Payment error:', 'woothemes') . ' ' . __('Sorry, no finance products are available at this time.', 'woocommerce_v12retailfinance');
        }
    }

}
