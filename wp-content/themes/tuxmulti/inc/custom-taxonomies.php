<?php

function cptui_register_my_taxes() {

	/**
	 * Taxonomy: Stockist Categories.
	 */

	$labels = array(
		"name" => __( "Categories", "tuxauto" ),
		"singular_name" => __( "Category", "tuxauto" ),
	);

	$args = array(
		"label" => __( "Categories", "tuxauto" ),
		"labels" => $labels,
		"public" => true,
		"hierarchical" => true,
		"label" => "Categories",
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'stockist_category', 'with_front' => true, ),
		"show_admin_column" => true,
		"show_in_rest" => false,
		"rest_base" => "stockist_category",
		"show_in_quick_edit" => true,
	);
    register_taxonomy( "stockist_category", array( "stockist" ), $args );
    
    /**
	 * Taxonomy: Wheel Categories.
	 */

	$labels = array(
		"name" => __( "Categories", "tuxmulti" ),
		"singular_name" => __( "Category", "tuxmulti" ),
	);

	$args = array(
		"label" => __( "Categories", "tuxmulti" ),
		"labels" => $labels,
		"public" => true,
		"hierarchical" => true,
		"label" => "Categories",
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'wheel_category', 'with_front' => true, ),
		"show_admin_column" => true,
		"show_in_rest" => false,
		"rest_base" => "wheel_category",
		"show_in_quick_edit" => true,
	);
	register_taxonomy( "wheel_category", array( "wheel" ), $args );

}

add_action( 'init', 'cptui_register_my_taxes' );

