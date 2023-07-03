	
<?php
/**
 * Template Name: Show Me the Wheels
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package tuxmulti
 */

get_header();
?>

    <div id="primary" class="content-area">
		<main id="main" class="site-main site-showmethewheels">

        <?php
            if ( function_exists('yoast_breadcrumb') ) {
                yoast_breadcrumb('<p id="breadcrumbs" class="breadcrumbs-top">','</p>');
            }
        ?>

		<div class="site-hero site-hero-parallax">
            <div class="site-hero-cover" data-parallax="scroll" data-image-src="<?php the_field('image'); ?>">
                <div class="site-hero-inner">
                    <div class="site-hero-content">
                        <h1 class="site-title site-title-bold">#<?php the_title(); ?></h1>
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

        <div class="smtw-gallery site-gallery">

            <!-- The container for the list of example images -->
            <ul class="site-gallery-list">		
                
                <?php

                    // check if the repeater field has rows of data
                    if( have_rows('smtw_gallery') ):
                    
                    // loop through the rows of data
                    while ( have_rows('smtw_gallery') ) : the_row(); 
                            
                    // Get image field
                    $full_image = get_sub_field('smtw_gallery_images');
                    $thumbnail_image = $full_image['sizes']['large'];
                        
                        
                    // Check image isn't empty
                    if( !empty($full_image) ): 

                ?>
                    
                <li class="site-gallery-item">
                    <a title="<?php echo $full_image['title'];?>" href="<?php echo $full_image['url'];?>" target="_blank">
                        <div style="background-image: url(<?php echo $full_image['url'];?>);"></div>
                        <span><?php echo $full_image['title'];?></span>	
                    </a>										
                </li>
                
                
                <?php 
                    endif; // Ending check image isn't empty
                    endwhile; // Ending loop through the rows of data
                    endif; // Ending check if repeater has rows of data
                ?>
                            
            </ul>
        </div>

        <div id="show-me-the-wheels" class="site-sendyourimages">

            <h2 class="site-sendyourimages-title">Send us your images</h2>

            <!-- Server messages -->
            <div id="server-messages">
                <div class="alert-message-container alert alert-danger" role="alert">
                    <h4 class="alert-message-title">Error</h4>
                    <span class="alert-message-body"></span>
                </div>
            </div><!-- End row -->

            <div class="smtw-submit-feedback">
                <h4>Thank you</h4>
                <p>Your entry has succesfully been submitted</p>
            </div>
            <!-- /Server Messages FORM -->
            
            <!-- SMTW FORM -->
            <?php
                get_template_part("tux-showmethewheels-module/partials/smtw-form");
            ?>	
            <!-- /SMTW FORM -->
        </div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
include locate_template('footer.php');