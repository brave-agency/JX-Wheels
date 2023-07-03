<?php

/**
 * Description of findPoscode
 *
 * @author rodrigo
 */
class brave_findpostcode {

    //put your code here

    const POSTCODE_ENDPOINT_URL = "https://api.postcodes.io/postcodes/%s";

    /**
     * 
     */
    final public function getData() {

        $data = [];
        try {

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => sprintf(self::POSTCODE_ENDPOINT_URL, $this->getPostCode()),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_POSTFIELDS => "",
                CURLOPT_HTTPHEADER => array(
                    "Postman-Token: 400d7cc5-541b-411d-91cb-e305f546dce7",
                    "cache-control: no-cache"
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            
 
            return json_decode($response);
        } catch (Exception $e) {
            
        }
        return $data;
    }

    /**
     * 
     * @return type
     */
    private function getPostCode() {
        return $this->postcode;
    }

    /**
     * 
     * @param type $postcode
     * @return $this
     */
    public function setCall($postcode = null) {

        if ($postcode) {
            $this->postcode = str_replace(" ", "", $postcode);
        }

        return $this;
    }

    /**
     * 
     * @param type $lat1
     * @param type $lon1
     * @param type $lat2
     * @param type $lon2
     * @param type $unit
     * @return int
     */
    public static function checkDistance($lat1, $lon1, $lat2, $lon2, $unit) {

        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
            return 0;
        } else {
            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $unit = strtoupper($unit);

            if ($unit == "K") {
                return ($miles * 1.609344);
            } else if ($unit == "N") {
                return ($miles * 0.8684);
            } else {
                return $miles;
            }
        }
    }

}
