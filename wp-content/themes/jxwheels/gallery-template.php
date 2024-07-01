<?php
/**
 * Template Name: Gallery Template
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package tuxauto
 */

get_header();

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
?>


  <div id="primary" class="content-area">
		<main id="main" class="site-main">

    <div class="site-hero">
				<div class="site-hero-cover site-hero-cover-blog" data-parallax="scroll" data-image-src="<?php the_field('wheels_info_background', 'option'); ?>">
					<div class="site-hero-inner">
						<div class="site-hero-content">
							<h1 class="site-title site-title-bold"><?php the_title(); ?></h1>
							<?php
								// if ( function_exists('yoast_breadcrumb') ) {
								// 	yoast_breadcrumb('<p id="breadcrumbs" class="breadcrumbs-top">','</p>');
								// }
							?>
						</div>
					</div>
				</div>
			</div>
    
      <div id="gallery">
        <div class="site-stockists site-stockists-resultpage">
          <div id="sorting" class="button-group filters-button-group">
            <button class="button is-checked" data-filter="*">All</button>
          </div>
        </div>
        
        <?php 
          // echo do_shortcode('[ngg src="albums" ids="1" display="basic_extended_album" thumbnail_height="300" thumbnail_crop="0"]'); 
          echo do_shortcode('[ngg src="albums" ids="1" display="basic_extended_album" thumbnail_height="300" thumbnail_crop="0"]'); 
        ?>
      </div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();