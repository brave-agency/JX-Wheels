<?php

/*
  Plugin Name: Find Stockist
  Description: Functions required for "Find a Stockist" to work accross multi site.
  Version: 1.0.0
 */

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly


    
// ***********************************************************************//
// Function to get data if data exists in the table
// ***********************************************************************//

function brave_geocode_get_data($query) {
    global $wpdb;

    $query = str_replace(' ', '', $query);
    $query = sanitize_text_field($query);

    $query_exists = $wpdb->get_results(
            $wpdb->prepare(
                    "SELECT latitude, longitude FROM wp_tuxautopostcodelatlng WHERE postcode = %s LIMIT 1", $query
            )
    );

    if ($query_exists) :

        return $query_exists;

    else :

        return false;

    endif;
}

/**
 * -----------------------------------------
 * FIND A STOCKIST BY LOCATION
 * -----------------------------------------
 */

/**
 * Find a stockist location from user input
 */
function geocode_location($town) {

    $location = brave_geocode_get_data($town);
    // print_r($location);
    // $location = json_decode($location['body']);

    $latlong = array();

    // if($location->status == "OK"){

    $latlong[] = isset($location[0]) && $location[0]->latitude ? $location[0]->latitude : '';
    $latlong[] = isset($location[0]) && $location[0]->longitude ? $location[0]->longitude : '';

    return $latlong;

    // } else {
    //     $latlong[] =  '40.7143528';
    //     $latlong[] =  '-74.0059731';
    //     return $latlong;
    // }
}

/**
 * Filter posts by location
 */
function find_nearby_stockists($lat, $long, $distance = 5) {

    global $wpdb;

    $wpdb->show_errors();

    $sql = $wpdb->prepare("SELECT
		p.ID,
		(3959 * acos(cos(radians(%s)) * cos(radians(location_lat.meta_value)) * cos( radians(%s) - radians(location_lng.meta_value)) + sin(radians(location_lat.meta_value)) * sin(radians($lat)))) AS distance
		FROM wp_posts p
		JOIN wp_postmeta location_lat
		ON location_lat.post_id = p.ID AND location_lat.meta_key = 'location_lat'
		JOIN wp_postmeta location_lng
		ON location_lng.post_id = p.ID AND location_lng.meta_key = 'location_lng'
		WHERE p.post_type = 'stockist'
		AND p.post_status = 'publish'
		HAVING distance <= %s
        ORDER BY distance", $lat, $long, $distance);

    $results = $wpdb->get_results($sql);

    $stockists = array();
    foreach ($results as $result)
        $stockists[] = $result->ID;
    return $stockists;
}

// ***********************************************************************//
// Add api call if postcode lat and 
// ***********************************************************************//


$filename = plugin_dir_path(__FILE__) . 'findpostcode.php';
if (file_exists($filename)) {
    require_once $filename;
    $class = new brave_findpostcode();
}
