<?php
/**
 * Homepage
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package tuxmulti
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main site-home">

			<?php
				if( have_rows('slideshow', 'option') ):
				$count_rows = count(get_field('slideshow', 'option'));
			?>
			<div class="site-hero site-hero-home">

				<div id="main-carousel" class="carousel">

					<?php
						while ( have_rows('slideshow', 'option') ) : the_row();
					?>

					<div class="carousel-slide">

						<div class="site-carousel-slide-parallax">
							<div data-limit-y=2 data-scalar-y="0" data-depth="0.05" class="site-hero-bg" style="background-image:url(<?php the_sub_field('background'); ?>)">
							<div class="site-hero-flag"><?php echo get_sub_field('flag', false); ?></div></div>
							<div data-limit-y=2 data-depth="0.15" class="site-hero-fg" style="background-image:url(<?php the_sub_field('foreground'); ?>)"></div>
						</div>

						<div class="site-hero-heading">
							<h2 class="site-title site-title-bold"><span><?php the_sub_field('title', 'option'); ?></span><?php the_sub_field('subtitle', 'option'); ?></h2>
						</div>

						<a class="site-button" href="<?php the_sub_field('page_link', 'option') ?>">Find out more</a>

					</div>

					<?php 
						endwhile;
						wp_reset_postdata();
					?>

				</div>

			</div>
			<?php
				endif; 
			?>

			<?php
                if( have_rows('about', 'option') ):
			?>
			<div class="site-home-about">
				<div class="site-home-about-content">
					<h3 class="site-title"><?php the_field('about_title', 'option'); ?></h3>
					<div class="site-about-small"><?php the_field('about_description_title', 'option'); ?></div>
					<div class="site-about-text"><?php the_field('about_description_text', 'option'); ?></div>
					<a href="<?php the_field('about_page_link', 'option'); ?>" class="site-button">Find Out More</a>
				</div>
				<div class="site-home-about-heading">
					<div class="site-home-about-heading-bg" style="background-image:url(<?php the_field('about_background', 'option'); ?>);"></div>
				</div>
			</div>
			<?php
                endif;
			?>

			<div class="site-newarrivals">

			<div class="site-newarrivals-intro">
				<h2 class="site-title"><?php the_field('new_arrivals_title', 'option'); ?></h2>
				<p class="site-newarrivals-text"><?php the_field('new_arrivals_text', 'option'); ?></p>
				<div class="site-newarrivals-arrows">
					<button class="site-newarrivals-arrow site-newarrivals-prev"></button>
					<button class="site-newarrivals-arrow site-newarrivals-next"></button>
				</div>
			</div>

			<?php

				$args = array(
					'wheel_category' => 'new-arrivals',
					'post_status' => 'publish',
					'orderby'=>'menu_order',
					'order' => 'ASC',
					'posts_per_page' => 5,
					'post_type' => 'wheel'
				);

				$the_query = new WP_Query( $args );

				if ( $the_query->have_posts() ) :

			?>
			<div class="site-newarrivals-list">
				<?php
					while ( $the_query->have_posts() ) : $the_query->the_post();
				?>
				<div class="site-newarrivals-item">
					<a class="site-newarrivals-image" href="<?php the_permalink(); ?>" style="background-image: url(<?php the_field('feature_image'); ?>);"></a>
					<p class="site-newarrivals-model"><?php the_field('model'); ?></p>
					<p class="site-newarrivals-price"><?php the_field('price_sign'); ?><?php the_field('price_pounds'); ?><span>.<?php the_field('price_pence'); ?></span><span>Per Set</span></p>
					<ul class="site-newarrivals-finishes">
						<li>Finishes</li>
						<?php 
							while ( have_rows('colours') ) : the_row();
							$colour_name = get_sub_field('colour_name');
							$colour_name = preg_replace('/\s*/', '', $colour_name);
							$colour_name = strtolower($colour_name);
						?>
						<li class="<?php echo $colour_name; ?>" data-colour-finish="<?php echo $colour_name; ?>" style="background-color: <?php the_sub_field('colour'); ?>;"></li>
						<?php
							endwhile;
						?>
					</ul>
					<a href="<?php the_permalink(); ?>" class="site-button">View Wheels</a>
				</div>
				<?php 
					endwhile;
					wp_reset_postdata();
				?>
			</div>
			<div class="site-newarrivals-arrows site-newarrivals-arrows-mobile">
				<button class="site-newarrivals-arrow site-newarrivals-prev"></button>
				<button class="site-newarrivals-arrow site-newarrivals-next"></button>
			</div>
			<a href="<?php the_field('new_arrivals_link', 'option'); ?>" class="site-button site-button-alt site-newarrivals-more">View more Products</a>

			<?php 
				endif; 
			?>
			</div>

			<?php
				if( have_rows('about_more', 'option') ):
			?>
			<div id="about-more-carousel" class="site-about-more-carousel">
				<?php
					while ( have_rows('about_more', 'option') ) : the_row();
				?>
				<div class="site-about-more">
					<div class="site-about-more-image">
						<div style="background-image: url(<?php the_sub_field('background', 'option'); ?>);"></div>
					</div>
					<div class="site-about-more-details">
						<h2 class="site-title site-about-more-title"><?php the_sub_field('title', 'option'); ?></h2>
						<div class="site-about-more-highlight"><?php the_sub_field('highlight', 'option'); ?></div>
						<div class="site-about-more-text"><?php the_sub_field('text', 'option'); ?></div>
						<a href="<?php the_field('about_more_link', 'option'); ?>" class="site-button">Find Out More</a>
					</div>
				</div>
				<?php
					endwhile;
				?>
			</div>
			<?php
				endif;
			?>

			<div class="site-home-video" data-parallax="scroll" data-image-src="<?php the_field('youtube_video_background', 'option'); ?>" data-speed="0.5">

				<div class="site-home-triangle site-home-triangle-top"></div>
				<div class="site-home-triangle site-home-triangle-bottom"></div>
				
				<!-- <div class="youtube-player" data-id="<?php the_field('youtube_video_id', 'option'); ?>"></div> -->

			</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
include locate_template('footer.php');
