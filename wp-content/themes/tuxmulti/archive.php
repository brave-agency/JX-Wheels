<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package tuxmulti
 */

get_header();
?>

	<div id="primary" class="content-area">

		<?php
			$categories = get_the_category();
			if ( ! empty( $categories ) ) {
				foreach( $categories as $category ) {
					$category_name = $category->name;
					$category_bg = get_field('background', $category->taxonomy.'_'.$category->term_id);
				}
			}
		?>

		<?php
            if ( function_exists('yoast_breadcrumb') ) {
                yoast_breadcrumb('<p id="breadcrumbs" class="breadcrumbs-top">','</p>');
            }
        ?>

		<div class="site-hero site-hero-parallax">
            <div class="site-hero-cover" data-parallax="scroll" data-image-src="<?php echo $category_bg; ?>">
                <div class="site-hero-inner">
                    <div class="site-hero-content">
                        <h1 class="site-title site-title-bold"><?php echo $category_name; ?></h1>
                    </div>
                </div>
            </div>
        </div>

		<main id="main" class="site-main site-archive">

		<?php 

			if ( have_posts() ) :
				
			while ( have_posts() ) : the_post();
		?>

			<article class="post">

				<a class="entry-meta" href="<?php the_permalink(); ?>">
					<div style="background-image: url(<?php the_post_thumbnail_url(); ?>);" class="entry-meta-bg"></div>
					<span class="entry-meta-date"><span><?php the_time('dS') ?></span><?php the_time('M') ?></span>
				</a><!-- .entry-meta -->

				<h3 class="site-post-title"><a href="<?php the_permalink(); ?>"><?php echo mb_strimwidth(get_the_title(), 0, 45, '...'); ?></a></h3>

				<div class="site-post-excerpt"><?php the_excerpt(); ?></div>

				<a href="<?php the_permalink(); ?>" class="site-button">Read More</a>

			</article>
					
		<?php

			endwhile;

			endif;

			wpex_pagination();
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
include locate_template('footer.php');
