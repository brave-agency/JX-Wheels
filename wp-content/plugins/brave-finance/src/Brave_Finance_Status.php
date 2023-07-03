<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Brave_Finance_Staths
 *
 * @author developer
 */
class Brave_Finance_Status {

    private $get_var;

    /**
     * add var
     */
    public function __construct() {
        
        
        $retail_confirm = filter_input(INPUT_GET, 'retaileruniqueref', FILTER_SANITIZE_URL);

        if ($retail_confirm != '') {
            $var_uri = ($_SERVER['REQUEST_URI']);
            $parse = parse_url($var_uri, PHP_URL_PATH);
            $break_slash = explode("/", $parse);
            $code = array_filter($break_slash, function($value) {

                if ($value !== '' && $value != 'close-brothers') {
                    return $value;
                }
            });
            $this->get_var = (object) array(
                        'code' => end($code),
                        'retail_code' => $retail_confirm,
            );
        }
    }

    public function init() {
        global $wpdb;
        global $woocommerce;


        if (isset($this->get_var->code) && isset($this->get_var->retail_code)) {


            $_v12_application_guid = rand(0, 99999999);
            $_v12_application_id = hash('ripemd160', 'brave-finance');

            // save the application details against the order
            update_post_meta($this->get->retail_code, '_v12_status', $this->get->code);
            update_post_meta($this->get->retail_code, '_v12_application_guid', $_v12_application_guid);
            update_post_meta($this->get->retail_code, '_v12_application_id', $_v12_application_id);

            if (wp_redirect('/my-account/view-order/'.$this->get->code.'/')) {
                exit;
            }
        }
    }

}
