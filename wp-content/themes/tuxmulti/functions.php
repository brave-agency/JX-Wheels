<?php
/**
 * tuxmulti functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package tuxmulti
 */

if ( ! function_exists( 'tuxmulti_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function tuxmulti_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on tuxmulti, use a find and replace
		 * to change 'tuxmulti' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'tuxmulti', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'tuxmulti' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'tuxmulti_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'tuxmulti_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function tuxmulti_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'tuxmulti_content_width', 640 );
}
add_action( 'after_setup_theme', 'tuxmulti_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function tuxmulti_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'tuxmulti' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'tuxmulti' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'tuxmulti_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function tuxmulti_scripts() {

	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', includes_url( '/js/jquery/jquery.js' ), false, null, false );

	wp_enqueue_script( 'parallax-js', get_template_directory_uri() . '/plugins/parallax/parallax.min.js', array(), null, true );

	wp_enqueue_script( 'mc-validate-js', get_template_directory_uri() . '/plugins/mailchimp/mc-validate.js', array('jquery'), null, true );

	wp_enqueue_style( 'selectric-style', get_template_directory_uri() . '/plugins/selectric/selectric.css');
	wp_enqueue_script( 'selectric-js', get_template_directory_uri() . '/plugins/selectric/selectric.min.js', array('jquery'), null, true );

	wp_enqueue_script( 'addthis-js', '//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5b472a1501ca0eb1', array('jquery'), null, true );

	if( is_front_page() || is_page_template('page-show-wheels.php') ){
		wp_enqueue_style( 'slick-carousel-style', get_template_directory_uri() . '/plugins/slick-carousel/slick.css' );
		wp_enqueue_style( 'slick-carousel-style-theme', get_template_directory_uri() . '/plugins/slick-carousel/slick-theme.css' );
		wp_enqueue_script( 'slick-carousel-js', get_template_directory_uri() . '/plugins/slick-carousel/slick.min.js', array('jquery'), null, true );
	}

	if ( is_singular('wheel') || is_post_type_archive('wheel') || is_tax('wheel_category' ) || is_page_template('gallery-template.php')) {
		wp_enqueue_script( 'isotope-js', get_template_directory_uri() . '/plugins/isotope/isotope.min.js', array(), null, true );
	}

	if ( is_singular('wheel') ) {
		wp_enqueue_style( 'slick-carousel-style', get_template_directory_uri() . '/plugins/slick-carousel/slick.css' );
		wp_enqueue_style( 'slick-carousel-style-theme', get_template_directory_uri() . '/plugins/slick-carousel/slick-theme.css' );
		wp_enqueue_script( 'slick-carousel-js', get_template_directory_uri() . '/plugins/slick-carousel/slick.min.js', array('jquery'), null, false );
	}

	if( is_page_template('page-show-wheels.php') ){
		wp_enqueue_style('smtw-styles', get_template_directory_uri() .'/tux-showmethewheels-module/css/combined-styles.css', array());
		wp_enqueue_script('smtw-gallery', get_template_directory_uri().'/tux-showmethewheels-module/js/custom-scripts/gallery.js', array('jquery'), null, true);
		wp_enqueue_script('smtw-uploader', get_template_directory_uri().'/tux-showmethewheels-module/js/custom-scripts/image-uploader.js', array('jquery'), null, true);
		wp_enqueue_script( 'jquery-validate', 'https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js', array('jquery'), null, true );
		wp_enqueue_script( 'jquery-validate', 'https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/additional-methods.min.js', array('jquery'), null, true );
		wp_enqueue_script('smtw-page-scripts', get_template_directory_uri().'/tux-showmethewheels-module/js/custom-scripts/smtw-page-scripts.js', array('jquery'), null, true);
		wp_localize_script( 'smtw-page-scripts', 'tux_smtw_ajax_data', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
		wp_enqueue_script( 'recaptcha-js', 'https://www.google.com/recaptcha/api.js?render=6LfklYMUAAAAANm4FUzUrRCj3T0JWjHD--Y_y16x', array(), '2.0', true );
	}

	if( is_page_template('page-contact.php') ){
		wp_enqueue_script( 'map-init', get_template_directory_uri() . '/js/map-init.js', array('jquery'), null, true);
		wp_localize_script( 'map-init', 'site', array('theme_path' => get_template_directory_uri()));
		wp_enqueue_script( 'google-maps-js', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyAERJdctLPDT-legkf0b09n67ZtwcJE5Rg&callback=initMap', array('map-init'), null, true );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	$timestamp = filemtime( get_template_directory() . '/css/style.css');
	wp_enqueue_style( 'tuxmulti-style', get_template_directory_uri() . '/css/style.css', array(), $timestamp );
	$timestamp = filemtime( get_template_directory() . '/js/min/site.js');
	wp_enqueue_script( 'tuxmulti-site', get_template_directory_uri() . '/js/min/site.js', array('jquery'), $timestamp, true );

}
add_action( 'wp_enqueue_scripts', 'tuxmulti_scripts' );

function facebook_pixel_js()
{
    echo "<!-- Facebook Pixel Code -->
<script>
 !function(f,b,e,v,n,t,s)
 {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
 n.callMethod.apply(n,arguments):n.queue.push(arguments)};
 if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
 n.queue=[];t=b.createElement(e);t.async=!0;
 t.src=v;s=b.getElementsByTagName(e)[0];
 s.parentNode.insertBefore(t,s)}(window, document,'script',
 'https://connect.facebook.net/en_US/fbevents.js');
 fbq('init', '628518857750113');
 fbq('track', 'PageView');
</script>
<noscript><img height=\"1\" width=\"1\" style=\"display:none\"
 src=\"https://www.facebook.com/tr?id=628518857750113&ev=PageView&noscript=1\"
/></noscript>
<!-- End Facebook Pixel Code -->";
}
// Add hook for front-end <head></head>
add_action( 'wp_head', 'facebook_pixel_js' );

//Remove JQuery migrate
function remove_jquery_migrate( $scripts ) {
	if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
		$script = $scripts->registered['jquery'];
		if ( $script->deps ) { // Check whether the script has any dependencies
			$script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
		}
	}
}
add_action( 'wp_default_scripts', 'remove_jquery_migrate' );

//* TN - Remove Query String from Static Resources
function remove_css_js_ver( $src ) {
	if( strpos( $src, '?ver=' ) )
	$src = remove_query_arg( 'ver', $src );
	return $src;
}
add_filter( 'style_loader_src', 'remove_css_js_ver', 10, 2 );
add_filter( 'script_loader_src', 'remove_css_js_ver', 10, 2 );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Implement the Custom Post Types.
 */
require get_template_directory() . '/inc/custom-post-types.php';

/**
 * Implement the Custom Taxonomies.
 */
require get_template_directory() . '/inc/custom-taxonomies.php';

/**
 * Show me the wheels functionality
 */
require get_template_directory() . '/tux-showmethewheels-module/tux-smtw-init.php';

/**
 * globals
 */
require get_template_directory() . '/global.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * ACF Options
 */
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page();
}

// Numbered Pagination
if ( !function_exists( 'wpex_pagination' ) ) {
	
	function wpex_pagination() {
		
		$prev_arrow = is_rtl() ? '' : '';
		$next_arrow = is_rtl() ? '' : '';
		
		global $wp_query;
		$total = $wp_query->max_num_pages;
		$big = 999999999; // need an unlikely integer
		if( $total > 1 )  {
			 if( !$current_page = get_query_var('paged') )
				 $current_page = 1;
			 if( get_option('permalink_structure') ) {
				 $format = 'page/%#%/';
			 } else {
				 $format = '&paged=%#%';
			 }
			echo paginate_links(array(
				'base'			=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format'		=> $format,
				'current'		=> max( 1, get_query_var('paged') ),
				'total' 		=> $total,
				'mid_size'		=> 3,
				'type' 			=> 'list',
				'prev_text'		=> $prev_arrow,
				'next_text'		=> $next_arrow,
			 ) );
		}
	}
	
}

/**
 * Filter the except length to 20 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function wpdocs_custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );

/**
 * Filter the excerpt "read more" string.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
function wpdocs_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );

remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );