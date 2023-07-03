<?php

function cptui_register_my_cpts() {

	/**
	 * Post Type: Brands.
	 */

	$labels = array(
		"name" => __( "Brands", "tuxauto" ),
		"singular_name" => __( "Brand", "tuxauto" ),
	);

	$args = array(
		"label" => __( "Brands", "tuxauto" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => false,
		"show_in_nav_menus" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "brand", "with_front" => true ),
		"query_var" => true,
		"supports" => array( "title", "editor", "thumbnail" ),
	);

	register_post_type( "brand", $args );

	/**
	 * Post Type: Stockists.
	 */

	// $labels = array(
	// 	"name" => __( "Stockists", "tuxauto" ),
	// 	"singular_name" => __( "Stockist", "tuxauto" ),
	// );

	// $args = array(
	// 	"label" => __( "Stockists", "tuxauto" ),
	// 	"labels" => $labels,
	// 	"description" => "",
	// 	"public" => true,
	// 	"publicly_queryable" => true,
	// 	"show_ui" => true,
	// 	"show_in_rest" => false,
	// 	"rest_base" => "",
	// 	"has_archive" => false,
	// 	"show_in_menu" => false,
	// 	"show_in_nav_menus" => false,
	// 	"exclude_from_search" => false,
	// 	"capability_type" => "post",
	// 	"map_meta_cap" => true,
	// 	"hierarchical" => false,
	// 	"rewrite" => array( "slug" => "stockist", "with_front" => true ),
	// 	"query_var" => true,
	// 	"supports" => array( "title", "editor", "thumbnail" ),
	// );

	// register_post_type( "stockist", $args );

	/**
	 * Post Type: Wheels.
	 */

	$labels = array(
		"name" => __( "Wheels", "tuxmulti" ),
		"singular_name" => __( "Wheel", "tuxmulti" ),
	);

	$args = array(
		"label" => __( "Wheels", "tuxmulti" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => true,
		"rewrite" => array( "slug" => "wheel", "with_front" => true ),
		"query_var" => true,
		"supports" => array( "title", "editor", "thumbnail", "page-attributes", "post-formats" ),
	);

	register_post_type( "wheel", $args );

}

add_action( 'init', 'cptui_register_my_cpts' );

