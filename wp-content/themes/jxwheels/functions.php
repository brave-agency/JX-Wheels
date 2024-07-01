<?php
function tuxmulti_stuttgart_scripts() {

	wp_enqueue_script( 'parallax-js', get_template_directory_uri() . '/plugins/parallax/parallax.min.js', array('jquery'), null, true );

	wp_enqueue_script( 'mc-validate-js', get_template_directory_uri() . '/plugins/mailchimp/mc-validate.js', array('jquery'), null, true );

	wp_enqueue_style( 'selectric-style', get_template_directory_uri() . '/plugins/selectric/selectric.css', array() );
	wp_enqueue_script( 'selectric-js', get_template_directory_uri() . '/plugins/selectric/selectric.min.js', array('jquery'), null, true );
    
  if( is_front_page() || is_page_template('page-show-wheels.php') ){
		wp_enqueue_style( 'slick-carousel-style', get_template_directory_uri() . '/plugins/slick-carousel/slick.css', array() );
		wp_enqueue_style( 'slick-carousel-style-theme', get_template_directory_uri() . '/plugins/slick-carousel/slick-theme.css', array() );
		wp_enqueue_script( 'slick-carousel-js', get_template_directory_uri() . '/plugins/slick-carousel/slick.min.js', array('jquery'), null, true );
  }

  if( is_front_page() ){
		wp_enqueue_script( 'greensock', '//cdnjs.cloudflare.com/ajax/libs/gsap/1.19.0/TweenMax.min.js', array('jquery'), null, false );
		wp_enqueue_script( 'drawsvg', '//s3-us-west-2.amazonaws.com/s.cdpn.io/16327/DrawSVGPlugin.min.js', array('jquery'), null, true );
		wp_enqueue_script( 'mod-parallax', get_stylesheet_directory_uri() . '/js/min/mod_parallax.js', array('jquery'), null, false );
  }

  if ( is_post_type_archive('wheel') || is_page_template('gallery-template.php')) {
		wp_enqueue_script( 'isotope-js', get_template_directory_uri() . '/plugins/isotope/isotope.min.js', array(), null, true );
	}
	
	$parent_style = 'tuxmulti-style';
	wp_enqueue_style( $parent_style, get_template_directory_uri() . '/css/style.css' );
	wp_enqueue_style( 'tuxmulti-stuttgart-style', get_stylesheet_directory_uri() . '/css/style.css', array( $parent_style ) );
	wp_enqueue_script( 'tuxmulti-site', get_stylesheet_directory_uri() . '/js/min/site.js', array(), null, true );

}
add_action( 'wp_enqueue_scripts', 'tuxmulti_stuttgart_scripts');

remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );