	
<?php
/**
 * Template Name: Contact Us
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package tuxmulti
 */

get_header();
?>

    <div id="primary" class="content-area">
		<main id="main" class="site-main site-contact">

        <div class="site-hero">
            <div class="site-hero-cover" data-parallax="scroll" data-image-src="<?php the_field('image'); ?>">
                <div class="site-hero-inner">
                    <div class="site-hero-content">
                        <h1 class="site-title site-title-bold"><?php the_title(); ?></h1>
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
            if( have_rows('description') ):
        ?>
        <div class="site-description">
            <h2 class="site-description-title"><?php the_field('description_title'); ?></h2>
            <div class="site-description-intro"><?php the_field('description_intro'); ?></div>
        </div>
        <?php
            endif;
        ?>

        <?php
            if( have_rows('maps') ):
        ?>

        <ul class="site-tiles">

            <?php
                $mapId = 0;
                while ( have_rows('maps') ) : the_row();
                $mapId++;
            ?>

            <li class="site-tile">
                <div class="site-tile-content">
                    <h3 class="site-title site-title-bold"><?php the_sub_field('title');?></h3>
                    <p class="site-intro"><b>Telephone: </b><?php the_sub_field('telephone');?></p>
                    <p class="site-intro"><b>Email: </b><a href="mailto:<?php the_sub_field('email');?>"><?php the_sub_field('email');?></a></p>
                    <p class="site-intro"><b>Address: </b><?php the_sub_field('address');?></p>
                </div>
                <!-- <div class="site-map site-map-<?php echo $mapId - 1 ?>" data-lat="<?php the_sub_field('location_lat') ?>" data-lng="<?php the_sub_field('location_lng') ?>" data-title="<?php the_sub_field('location_title') ?>"></div> -->
                <div class="site-map site-map-static" style="background-image: url(<?php the_sub_field('map_image');?>);"></div>
            </li>

            <?php 
                endwhile;
                wp_reset_postdata();
            ?>

        </ul>

        <?php
            endif;
        ?>

        <div class="site-getintouch">
            <h2 class="site-getintouch-title">Get in Touch</h2>
            <?php echo do_shortcode( '[contact-form-7 id="95" title="Get in Touch"]' ); ?>
        </div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
include locate_template('footer.php');