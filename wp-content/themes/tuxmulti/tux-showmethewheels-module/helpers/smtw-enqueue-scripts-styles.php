<?php

/* 
---------------------------------------------------------
Enqueue our styles and scripts
---------------------------------------------------------
*/

if (!function_exists('smtw_theme_styles_scripts')) :
	function smtw_theme_styles_scripts() {

		// De-register the bundled version of jQuery that comes with WordPress
		wp_deregister_script( 'jquery' );

		/* Register styles */

			// Combined styles
			wp_register_style('smtw-styles', SMTWCSS.'/combined-styles.css');


		/* Register scripts */

			// Combined scripts
			wp_register_script('smtw-page-scripts', SMTWSCRIPTS.'/combined-scripts.min.js', array(), false, true);

			// Localize our script for AJAX use
			wp_localize_script( 'smtw-page-scripts', 'tux_smtw_ajax_data', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

			

		/* If page is singular 'competitions', then enqueue our scripts and styles */
		//if( is_page_template( 'show-me-the-wheels.php' ) )	:

			/* Enqueue styles */
			wp_enqueue_style('smtw-styles');

			/* Enqueue scripts */
			wp_enqueue_script('smtw-page-scripts');


		//endif; // End conditional check for singular 'competitions'

	}

	add_action( 'wp_enqueue_scripts', 'smtw_theme_styles_scripts' );


endif;


?>