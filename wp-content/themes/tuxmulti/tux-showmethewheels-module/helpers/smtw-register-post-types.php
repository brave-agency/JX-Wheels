<?php
/*
--------------------------------------------------------------------------------------------------
Add custom post type for competition
For more info see: http://codex.wordpress.org/Function_Reference/register_post_type
--------------------------------------------------------------------------------------------------
*/

	function register_showmethewheels_post_type() {
		
		// Define post type labels
		$labels = array (
			'name' => 'Show Me The Wheels Entries',
			'singular_name' => 'MTW Entry',
			'menu_name' => 'SMTW Entries',
			'all_items' => 'All Entries',
			'add_new' => 'Add New',
			'add_new_item' => 'Add New Entry',
			'edit_item' => 'Edit Entry',
			'new_item' => 'New Entry',
			'view_item' => 'View Entry',
			'search_items' => 'Search Show Me The Wheels Entries',
			'not_found' => 'No Entries Found',
			'not_found_in_trash' => 'No Show Me The Wheels Entries Found in Trash'
	 	);
		
		// Define post type arguments
		$args = array(
			'labels' => $labels,
			'description' => 'Get Involved',
			'public' => true,
			'capability_type' => 'post',
			'supports' => array( 'title'),
			"publicly_queryable" => false,
			"show_in_rest" => false,
		);
		
		register_post_type( 'showmethewheels', $args );
		
	}

	add_action( 'init', 'register_showmethewheels_post_type' );


?>