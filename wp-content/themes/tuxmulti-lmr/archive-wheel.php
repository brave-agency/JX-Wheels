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

		<main id="main" class="site-main site-wheels">

			<div class="site-hero">
				<div class="site-hero-cover site-hero-cover-blog" data-parallax="scroll" data-image-src="<?php the_field('wheels_info_background', 'option'); ?>">
					<div class="site-hero-inner">
						<div class="site-hero-content">
							<h1 class="site-title site-title-bold"><?php the_field('wheels_info_title', 'option'); ?></h1>
							<?php
								if ( function_exists('yoast_breadcrumb') ) {
									yoast_breadcrumb('<p id="breadcrumbs" class="breadcrumbs-top">','</p>');
								}
							?>
						</div>
					</div>
				</div>
			</div>

			<?php
		
			global $post;

			$args = array(
				'post_status' => 'publish',
				'orderby'=>'menu_order',
				'order' => 'ASC',
				'posts_per_page'   => -1,
				'post_type' => 'wheel'
			);

			$the_query = new WP_Query( $args );

			?>

			<div class="site-wheels-filters">
				<button class="site-wheels-filters-button">Filter Search<span></span></button>
				<ul class="site-wheels-filters-list">
					<li>
						<select class="site-wheels-filters site-wheels-filters-options site-wheels-filters-colours" data-filter-group="colours">
							<option value="">All</option>
							<?php
								$unique_colours = array();
								while ( $the_query->have_posts() ) : $the_query->the_post();
								while ( have_rows('colours') ) : the_row();
								$colour_name = get_sub_field('colour_name');
								$colour_name_nospace = preg_replace('/\s*/', '', $colour_name);
								$colour_name_lowercase = strtolower($colour_name_nospace);
								if( ! in_array( $colour_name, $unique_colours ) ) :
								$unique_colours[] = $colour_name;
							?>
							<option value=".<?php echo $colour_name_lowercase; ?>"><?php echo $colour_name; ?></option>
							<?php
								endif;
								endwhile;
								endwhile;
							?>
						</select>
					</li>
					<li>
						<select class="site-wheels-filters site-wheels-filters-options site-wheels-filters-range" data-filter-group="range">
							<option value="">All</option>
							<option value=".less500">0-500</option>
							<option value=".less1000">500-1000</option>
							<option value=".less1500">1000-1500</option>
							<option value=".more1500">1500 <</option>
						</select>
					</li>
					<li>
						<select class="site-wheels-filters site-wheels-filters-sortby">
							<option value="">None</option>
							<option value="low-to-high">Lowest to highest</option>
							<option value="high-to-low">Highest to lowest</option>
						</select>
					</li>
				</ul>
			</div>

			<?php
				if ( $the_query->have_posts() ) :
			?>
			<ul class="site-wheels-list">

				<?php

					while ( $the_query->have_posts() ) : $the_query->the_post();

				?>

				<li class="<?php

					while ( have_rows('colours') ) : the_row();
					$colour_name = get_sub_field('colour_name');
					$colour_name = preg_replace('/\s*/', '', $colour_name);
					$colour_name = strtolower($colour_name);

					echo $colour_name . ' ';

					endwhile;

					if ( get_field('price_pounds') >= 0 && 500 >= get_field('price_pounds') ) :
						$price_range = 'less500';
					elseif ( get_field('price_pounds') >= 500 && 1000 >= get_field('price_pounds') ) :
						$price_range = 'less1000';
					elseif ( get_field('price_pounds') >= 1000 && 1500 >= get_field('price_pounds') ) :
						$price_range = 'less1500';
					elseif ( get_field('price_pounds') >= 1500) :
						$price_range = 'more1500';
					endif;

					echo $price_range . ' ';

				?>" data-price="<?php the_field('price_pounds'); ?>">
					<a class="site-wheels-image" href="<?php the_permalink(); ?>" style="background-image: url(<?php the_field('feature_image'); ?>);"></a>
					<p class="site-wheels-model"><?php the_field('model'); ?></p>
					<p class="site-wheels-price"><?php the_field('price_sign'); ?><?php the_field('price_pounds'); ?><span>.<?php the_field('price_pence'); ?></span><span>Per Set</span></p>
					<ul class="site-wheels-finishes">
						<li>Finishes</li>
						<?php 
							while ( have_rows('colours') ) : the_row();
							$colour_name = get_sub_field('colour_name');
							$colour_name_nospace = preg_replace('/\s*/', '', $colour_name);
							$colour_name_lowercase = strtolower($colour_name_nospace);
						?>
						<li title="<?php echo $colour_name; ?>" class="<?php echo $colour_name_lowercase; ?>" data-colour-finish="<?php echo $colour_name_lowercase; ?>" style="background-color: <?php the_sub_field('colour'); ?>;"></li>
						<?php
							endwhile;
						?>
					</ul>
					<a href="<?php the_permalink(); ?>" class="site-button site-button-alt">View Product</a>
				</li>

				<?php 
					endwhile;
					wp_reset_postdata();
				?>
			</ul>
			<?php 
				endif; 
			?>

			<?php
				if( have_rows('wheels_info_description', 'option') ):
			?>
			<div class="site-wheels-info">
				<div class="site-wheels-info-image"><div style="background-image: url(<?php the_field('wheels_info_description_background', 'option'); ?>);"></div></div>
				<div class="site-wheels-info-details">
					<h2 class="site-title site-title-bold site-wheels-info-title"><span><?php the_field('wheels_info_description_title_first', 'option'); ?> </span><?php the_field('wheels_info_description_title_second', 'option'); ?></h2>
					<div class="site-wheels-info-text"><?php the_field('wheels_info_description_text', 'option'); ?></div>
				</div>
			</div>
			<?php
				endif;
			?>

            </main>
	</div><!-- #primary -->

<?php
include locate_template('footer.php');
