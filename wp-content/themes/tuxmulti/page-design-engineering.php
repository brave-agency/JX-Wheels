	
<?php
/**
 * Template Name: Design & Engineering
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package tuxmulti
 */

get_header();
?>

    <div id="primary" class="content-area">
		<main id="main" class="site-main">

        <?php
            if ( function_exists('yoast_breadcrumb') ) {
                yoast_breadcrumb('<p id="breadcrumbs" class="breadcrumbs-top">','</p>');
            }
        ?>

		<div class="site-hero site-hero-parallax">
            <div class="site-hero-cover" data-parallax="scroll" data-image-src="<?php the_field('image'); ?>">
                <div class="site-hero-inner">
                    <div class="site-hero-content">
                        <h1 class="site-title site-title-bold"><?php the_field('title'); ?></h1>
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
            if( have_rows('tiles_content') ):
        ?>
        <div class="site-tiles-wrap">
            <div class="site-tiles-title">
                <h2>THE PROCESS</h2>
            </div>
            <div class="site-tiles site-tiles-stockist">
                <?php
                    while ( have_rows('tiles_content') ) : the_row();
                ?>
                <div class="site-tile">
                    <div class="site-tile-skewed"></div>
                    <div class="site-tile-content">
                        <h2><?php the_sub_field('title');?></h2>
                        <div><?php the_sub_field('content');?></div>
                    </div>
                    <div class="site-tile-img" style="background-image: url(<?php the_sub_field('image');?>);"></div>
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

        <div class="site-getintouch">
            <h2 class="site-getintouch-title">Get in Touch</h2>
            <?php echo do_shortcode( '[contact-form-7 id="198" title="Get in Touch"]' ); ?>
        </div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
include locate_template('footer.php');