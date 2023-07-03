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

            <section class="home-banner">
                <div id="vue-window">
                    <div class="carousel">
                        <div class="carousel__nav">
                            <a class="button--previous"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 147.157 147.157"><defs><style>.cls-1{fill:#fff}.cls-2{fill:#373c40}</style></defs><g id="Group_146" data-name="Group 146" transform="translate(62.009 -334.306)"><path id="Path_1" data-name="Path 1" class="cls-1" d="M56.968 65.926l70.656-14.142 68.689 68.767h-86.635z" transform="rotate(135 2.475 223.194)"></path><path id="Path_3" data-name="Path 3" class="cls-2" d="M17.287 0L8.643 11.256l8.49 11.755-8.451.154L0 11.256 8.989 0z" transform="translate(9.954 388.777)"></path></g></svg></a>
                            <a class="button--next"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 147.157 147.157"><defs><style>.cls-1{fill:#fff}.cls-2{fill:#373c40}</style></defs><g id="Group_145" data-name="Group 145" transform="translate(-1192.991 -324.306)"><path id="Path_2" data-name="Path 2" class="cls-1" d="M42.826 51.784h84.8l54.547 54.625-72.492 14.142z" transform="rotate(135 624.975 481.042)"></path><path id="Path_4" data-name="Path 4" class="cls-2" d="M17.287 0L8.643 11.256l8.49 11.755-8.451.154L0 11.256 8.989 0z" transform="rotate(180 633.12 205.97)"></path></g></svg></a>
                        </div>
                        <?php if( have_rows('home_banner_flexible_content', 'option') ): ?>
                            <?php while ( have_rows('home_banner_flexible_content', 'option') ) : the_row(); ?>
                                <?php if( get_row_layout() == 'image' ): ?>
                                    <div class="cell lazyload" style="background-image: url('<?php echo get_sub_field('home_banner_image') ?>'); position: absolute;">
                                        <!-- <div class="cell lazyload" style="background-image: url('');"> -->
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="new-banner-video">
                                                    <div class="information">
                                                        <div class="caption">
                                                            <h1>
                                                                <a href="<?php echo get_sub_field('home_banner_link') ?>">
                                                                    <span class="first"><?php echo get_sub_field('home_banner_title_first') ?></span><br>
                                                                    <span class="second"><?php echo get_sub_field('home_banner_title_second') ?></span>
                                                                </a>
                                                            </h1>
                                                        </div>

                                                    </div>

                                                    <div class="slider-buttons">
                                                        <!--                         <div class="link">
                                                            <a href="/vehicles/">
                                                                                        </a>
                                                          </div>
                                                         -->

                                                        <div class="link last">
                                                            <a href="<?php echo get_sub_field('home_banner_link') ?>"><?php echo get_sub_field('home_banner_link_text') ?></a>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
            <?php endif;?>
                                <?php if( get_row_layout() == 'video' ): ?>
                                    <div class="cell lazyload is-selected" style="position: absolute; left: 0%;">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="new-banner-video">
                                                    <div class="information">
                                                        <div class="caption">
                                                            <h1>
                                                                <a href="<?php echo get_sub_field('home_banner_link') ?>">
                                                                    <span class="first"><?php echo get_sub_field('home_banner_title_first') ?></span><br>
                                                                    <span class="second"><?php echo get_sub_field('home_banner_title_second') ?></span>
                                                                </a>
                                                            </h1>
                                                        </div>
                                                    </div>

                                                    <div class="slider-buttons">
                                                        <!-- 							        <div class="link">
                                                            <a href="/vehicles/">
                                                                                      </a>
                                                                        </div>
                                                                       -->

                                                        <div class="link last">
                                                            <a href="<?php echo get_sub_field('home_banner_link') ?>"><?php echo get_sub_field('home_banner_link_text') ?></a>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <video playsinline="" inline="" muted="" autoplay="" loop="">
                                            <source src="<?php echo get_sub_field('home_banner_video') ?>">
                                            Your browser does not support the video tag.
                                        </video>

                                    </div>
                                <?php endif;?>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>

                </div>



            </section>

			<div class="site-newarrivals">

				<div class="site-newarrivals-intro">
					<h2 class="site-title site-title-bold"><?php the_field('new_arrivals_title', 'option'); ?></h2>
					<p class="site-newarrivals-text"><?php the_field('new_arrivals_text', 'option'); ?></p>
					<div class="site-newarrivals-arrows">
						<button class="site-newarrivals-arrow site-newarrivals-prev"></button>
						<span></span>
						<button class="site-newarrivals-arrow site-newarrivals-next"></button>
					</div>
				</div>

				<?php

					$args = array(
						'wheel_category' => 'new-arrivals',
						'post_status' => 'publish',
						'orderby'=>'menu_order',
						'order' => 'ASC',
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
						<p class="site-newarrivals-price"><span>FROM </span><?php the_field('price_sign'); ?><?php the_field('price_pounds'); ?><span>.<?php the_field('price_pence'); ?></span><span>Per Set</span></p>
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
						<a href="#" class="site-button menu-item-stockists">Find a Stockist</a>
						<a href="<?php the_permalink(); ?>" class="site-button site-button-alt">View Product</a>
					</div>
					<?php
						endwhile;
						wp_reset_postdata();
					?>
				</div>
				<div class="site-newarrivals-arrows site-newarrivals-arrows-mobile">
					<button class="site-newarrivals-arrow site-newarrivals-prev"></button>
					<span></span>
					<button class="site-newarrivals-arrow site-newarrivals-next"></button>
				</div>
				<?php
				endif;
				?>
			</div>

			<?php
                if( have_rows('about', 'option') ):
			?>
				<div class="site-home-about">
					<div class="site-home-about-content">
						<h3><?php the_field('about_description_title', 'option'); ?></h3>
						<p><?php the_field('about_description_text', 'option'); ?></p>
						<a href="<?php the_field('about_page_link', 'option'); ?>" class="site-button">Find Out More</a>
					</div>
					<div class="site-home-about-heading">
						<div class="site-home-about-heading-bg" style="background-image:url(<?php the_field('about_background', 'option'); ?>);"></div>
                        <h2 class="site-title site-title-bold"><?php the_field('about_title', 'option'); ?> <span><?php the_field('about_description_title', 'option'); ?></span></h2>
					</div>
					<?php
						if( have_rows('about_description_images', 'option') ):
					?>
					<div class="site-home-about-images">
						<?php
							while ( have_rows('about_description_images', 'option') ) : the_row();
						?>
						<div class="site-home-about-image">
							<div style="background-image:url(<?php the_sub_field('image', 'option'); ?>);"></div>
						</div>
						<?php
							endwhile;
							wp_reset_postdata();
						?>
					</div>
					<?php
						endif;
					?>
				</div>
			<?php
                endif;
            ?>

			<?php
                if( have_rows('warranty', 'option') ):
            ?>
            	<div class="site-home-warranty" data-parallax="scroll" data-image-src="<?php the_field('warranty_background', 'option'); ?>" data-speed="0.5">
					<h2 class="site-title site-title-bold"><?php the_field('warranty_title', 'option'); ?></h2>
					<div class="site-home-warranty-text"><?php the_field('warranty_text', 'option'); ?></div>
					<p class="site-home-warranty-years"><?php the_field('warranty_years', 'option'); ?></p>
					<p class="site-home-warranty-stars site-home-warranty-stars-<?php the_field('warranty_stars', 'option'); ?>"></p>
				</div>
            <?php
                endif;
            ?>

			<?php

				$args = array(
					'parent'       => 0,
					'order' => 'ASC',
					'orderby' => 'count',
					'hide_empty'    => false,
					'post_type'  => 'wheel',
					'exclude' => 3

				);

				$terms = get_terms('wheel_category', $args);

			?>

			<div class="site-tiles">

			<?php

				foreach( $terms as $term ) :

				$term_link = get_term_link( $term );
			?>

				<div class="site-tile">
					<div class="site-tile-content">
						<h3 class="site-title site-title-bold"><?php echo $term->name; ?></h3>
						<div class="site-intro"><?php the_field('intro', 'wheel_category_' . $term->term_id);?></div>
						<a href="<?php echo esc_url($term_link); ?>" class="site-button">View Products</a>
					</div>
					<div class="site-tile-img" style="background-image: url(<?php the_field('image', 'wheel_category_' . $term->term_id);?>);"></div>
				</div>

				<?php
					endforeach;
					wp_reset_postdata();
				?>
			</div>


			<div class="site-home-video" data-parallax="scroll" data-image-src="<?php the_field('youtube_video_background', 'option'); ?>" data-speed="0.5">

				<div class="site-home-triangle site-home-triangle-top"></div>
				<div class="site-home-triangle site-home-triangle-bottom"></div>

				<!-- <div class="youtube-player" data-id="<?php the_field('youtube_video_id', 'option'); ?>"></div> -->

			</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
include locate_template('footer.php');
