<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package tuxmulti
 */

$original_blog_id = get_current_blog_id();
$main_blog_id = 4;

//switch_to_blog( $main_blog_id );

$postcode = null;
$categories = null;

$args = array(
	'suppress_filters' => false,
	'post_type'    => 'stockist',
	'orderby' => 'post__in',
	'posts_per_page' => -1 
);

if(!empty($_GET['categories'])) :

	$categories = $_GET['categories'];

	$tax_query = array();
	$tax_query[] = array(
		'taxonomy' => 'stockist_category',
		'field'    => 'slug',
		'terms'    => $categories,
		'operator' => 'IN'
	);
	$args['tax_query'] = $tax_query;

endif;

$distances = array(5,10,20,30,50);

if(!empty($_GET['distance'])) :
	$distance = sanitize_text_field($_GET['distance']);
endif;

if(!empty($_GET['postcode'])) :
	$postcode = $_GET['postcode'];
endif;

if (isset($postcode)) :

	list($center_lat, $center_long) = geocode_location($postcode);

	$include_stockists = find_nearby_stockists($center_lat, $center_long, $distance);

	if ( ! empty( $include_stockists ) ) :
		$args['post__in'] = $include_stockists;
	else :
		$args['post__in'] = array(0);
	endif;
	
endif;

$myposts = get_posts( $args );

//restore_current_blog();

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<!-- Global Site Tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-67424349-4"></script>
	<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());
	gtag('config', 'UA-67424349-4');
	</script>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="icon" href="<?php echo get_stylesheet_directory_uri() ?>/images/favicon.ico" type="image/x-icon">
	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri() ?>/images/favicon.ico" type="image/x-icon">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'tuxmulti' ); ?></a>

	<header id="masthead" class="site-header">

		<nav id="site-navigation" class="main-navigation">
			<div class="main-navigation-inner">
				<a class="menu-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/ui/logo-new.svg"></a>
				<?php
				wp_nav_menu( array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu'
				) );
				?>
			</div>
		</nav><!-- #site-navigation -->

		<button class="menu-toggle-lmr">
			<div>
				<span></span>
				<span></span>
				<span></span>
			</div>
		</button>

		<div class="site-branding">
		 
			<a class="site-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/ui/logo-new.svg"></a>

		</div><!-- .site-branding -->

		<?php //switch_to_blog( $main_blog_id ); ?>

		<div class="site-stockists">
			<button class="site-stockists-close"><span></span></button>

			<h2 class="site-title">Find a Stockist</h2>

			<form class="site-stockists-form" action="/find-a-stockist/">
				<ul class="site-stockists-options">

					<li>
						<label class="checkbox">
							<input type="hidden" name="categories[]" value="lmr-wheels" checked />
						</label>
					</li>

				</ul>
				<div class="site-stockists-postcode">
					<input type="text" value="<?php echo urldecode($postcode) ?>" name="postcode" placeholder="Enter Postcode">
				</div>
				<div class="site-stockists-distance">
					<select name="distance">
						<?php

							$selected = null;

							foreach ($distances as $d) :

							if($distance == $d) :
								$selected = 'selected';
							else :
								$selected = '';
							endif;
						?>
						<option value="<?php echo $d ?>" <?php echo $selected; ?>><?php echo $d ?> Miles</option>
						<?php
							endforeach;
						?>
					</select>
				</div>
				<button type="submit" class="site-button">Search</button>
			</form>
			
		</div>

		<?php //restore_current_blog(); ?>

	</header><!-- #masthead -->

	<div id="content" class="site-content">
