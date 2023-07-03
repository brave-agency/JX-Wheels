<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Brave_WC_V12_API
 *
 * @author developer
 */
class Brave_WC_V12_API extends BFI_WC_V12_API {
    //put your code here

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $BFI_Woocommerce_Iris_Plugin       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($BFI_Woocommerce_Iris_Plugin, $version) {
        parent::__construct($BFI_Woocommerce_Iris_Plugin, $version);

        $this->BFI_Woocommerce_Iris_Plugin = $BFI_Woocommerce_Iris_Plugin;
        $this->version = $version;

        // set V12 Specific details
        $this->options = [
             "Identification[api_key]" => BRAVE_WC_V12_API_KEY ,
        ];
        $this->api_url = BRAVE_WC_V12_API_URL;
    }

    /**
     * 
     * @param type $api_fields
     * @return type
     */
    public function call($api_fields = array()) {

        $api = new Brave_Api_manager($api_fields);
        return $api->getReponse();
    }

}

/**
 * Brave_Api_manager
 * 
 * do a curl call
 */
Class Brave_Api_manager {

    public $respose;

    /**
     * 
     * @param array $post_field_values
     * @throws Exception
     */
    public function __construct(array $post_field_values = []) {


        try {

            $curlSession = curl_init();
            curl_setopt($curlSession, CURLOPT_URL, BRAVE_WC_V12_API_URL);
            curl_setopt($curlSession, CURLOPT_HEADER, 0);
            curl_setopt($curlSession, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($curlSession, CURLOPT_POST, 1);
            curl_setopt($curlSession, CURLOPT_POSTFIELDS, $post_field_values);
            curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curlSession, CURLOPT_TIMEOUT, 180);
            curl_setopt($curlSession, CURLOPT_FOLLOWLOCATION, 1);
            $curlResponse = curl_exec($curlSession);
            
            $this->respose = $curlResponse;
        } catch (Exception $e) {
            $this->respose = $e->getMessage();
        }
    }

    /**
     * 
     * @return type
     */
    public function getReponse() {
        return $this->respose;
    }

}
