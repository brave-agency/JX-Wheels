<?php
	
/*
--------------------------------------------------------------------------------------------------
Add Advanced Custom fields options pages
For more info see: http://www.advancedcustomfields.com/resources/register-multiple-options-pages/
--------------------------------------------------------------------------------------------------
*/ 

if( function_exists( 'acf_add_options_page' ) ) {

	// Add Competitions Options Page
	acf_add_options_page(array(
		'page_title' 	=> 'Show Me The Wheels Settings',
		'menu_title'	=> 'SMTW Settings',
		'capability'	=> 'edit_posts',
		'icon_url' 		=> 'dashicons-admin-settings',
		'redirect'		=> true
	));

}

?>