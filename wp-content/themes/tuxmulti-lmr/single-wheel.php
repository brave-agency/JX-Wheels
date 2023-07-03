<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package tuxmulti
 */

get_header();
?>

	<div id="primary" class="content-area">

            <?php

                global $post;

                $children = get_pages( array( 'child_of' => $post->ID, 'post_type' => 'wheel' ) );

                if ( count( $children ) > 0 ) :

                $args = array(
                    'post_parent' => $post->ID,
                    'post_status' => 'publish',
					'orderby'=>'menu_order',
        			'order' => 'ASC',
                    'post_type' => 'wheel'
                );
        
                $the_query = new WP_Query( $args );
            ?>


        <?php 
            else :
        ?>

        <main id="main" class="site-main site-wheel">

            <?php
                if ( function_exists('yoast_breadcrumb') ) {
                    yoast_breadcrumb('<p id="breadcrumbs" class="breadcrumbs-top">','</p>');
                }
            ?>

            <div class="site-wheel-top">

                <div class="site-wheel-details">
                    <h2 class="site-wheel-details-title"><?php the_title(); ?></h2>
                    <h3 class="site-wheel-details-price"><?php the_field('price_sign'); ?><?php the_field('price_pounds'); ?><span>.<?php the_field('price_pence'); ?></span><span>Per Set</span></h3>
                    <div class="site-wheel-details-info"><?php the_field('details'); ?></div>
                    <div class="site-wheel-details-finish">
                        <h6>Select Finish</h6>
                        <ul>
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
                    </div>
                    <div class="site-wheel-details-buttons">
                        <?php
                            if( have_rows('find_stockist', 'option') ):
                        ?>
                        <a class="site-button" href="<?php the_field('find_stockist_link', 'option'); ?>"><?php the_field('find_stockist_title', 'option'); ?></a>
                        <?php
                            endif;
                        ?>
                        <?php
                            if( have_rows('become_stockist', 'option') ):
                        ?>
                        <a class="site-button site-button-alt" href="<?php the_field('become_stockist_link', 'option'); ?>"><?php the_field('become_stockist_title', 'option'); ?></a>
                        <?php
                            endif;
                        ?>
                    </div>
                    <div class="addthis_inline_share_toolbox"><span>Share</span></div>
                </div>

                <?php
                    if( have_rows('slideshow') ):
                ?>
                <div class="site-wheel-carousels">

                    <?php 
                        while ( have_rows('slideshow') ) : the_row();
                        $colour_name = get_sub_field('colour_name');
                        $colour_name = preg_replace('/\s*/', '', $colour_name);
                        $colour_name = strtolower($colour_name);
                    ?>

                    <div class="site-wheel-carousel site-wheel-carousel-<?php echo $colour_name; ?>" data-colour-carousel="<?php echo $colour_name; ?>">

                        <?php 
                            while ( have_rows('images') ) : the_row();
                        ?>

                        <div class="site-wheel-carousel-slide">
                            <div style="background-image:url(<?php the_sub_field('image'); ?>)"></div>
                        </div>

                        <?php
                            endwhile;
                        ?>

                    </div>

                    <script defer>
                    document.addEventListener('DOMContentLoaded', function() {
                        // load carousel for specific colour
                        jQuery('.site-wheel-carousel-<?php echo $colour_name; ?>').slick({
                            speed: 750,
                            dots: true,
                            arrows: false
                        });
                    });
                    </script>

                    <?php
                        endwhile;
                    ?>

                </div>
                <?php
                    endif;
                ?>

            </div>

            <?php
                if( have_rows('warranty') ):
            ?>
            <div class="site-wheel-warranty" data-parallax="scroll" data-image-src="<?php the_field('warranty_background'); ?>" data-speed="0.5">
                <h2 class="site-title site-title-bold"><?php the_field('warranty_title'); ?></h2>
                <p class="site-wheel-warranty-text"><?php the_field('warranty_text'); ?></p>
            </div>
            <?php
                endif;
            ?>

            <?php
                if( have_rows('available_in_options') ):
            ?>
            <div class="site-wheel-availablein" >
                <?php
                    if( get_field('available_in_title') ):
                ?>
                <h2><?php the_field('available_in_title'); ?></h2>
                <?php
                    else:
                ?>
                <h2>Available in</h2>
                <?php
                    endif;
                ?>
                <?php
                    if( have_rows('available_in_options') ):
                ?>
                <ul>
                    <?php 
                        while ( have_rows('available_in_options') ) : the_row();
                    ?>
                    <li>
                        <img src="<?php the_sub_field('image'); ?>">
                        <p><?php the_sub_field('title'); ?></p>
                    </li>
                    <?php
                        endwhile;
                    ?>
                </ul>
                <?php
                    endif;
                ?>
            </div>
            <?php
                endif;
            ?>

            <?php
                if( have_rows('specifications_options') ):
            ?>
            <div class="site-wheel-specifications">
                <?php
                    if( get_field('specifications_title') ):
                ?>
                <h2><?php the_field('specifications_title'); ?></h2>
                <?php
                    else:
                ?>
                <h2>Specification</h2>
                <?php
                    endif;
                ?>
                <?php
                    if( get_field('specifications_pcd_range') ):
                ?>
                <p>PCD Range: <?php the_field('specifications_pcd_range'); ?></p>
                <?php
                    endif;
                ?>
                <?php
                    if( have_rows('specifications_options') ):
                ?>
                <table>
                    <thead>
                        <tr>
                            <th>SIZE</th>
                            <th>PCD</th> 
                            <th>ET / OFFSET</th>
                            <th>CB</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            while ( have_rows('specifications_options') ) : the_row();
                        ?>
                        <tr>
                            <td><?php the_sub_field('size'); ?></td>
                            <td><?php the_sub_field('pcd'); ?></td> 
                            <td><?php the_sub_field('et'); ?></td>
                            <th><?php the_sub_field('cb'); ?></th>
                        </tr>
                        <?php
                            endwhile;
                        ?>
                    </tbody>
                </table>
                <?php
                    endif;
                ?>
            </div>
            <?php
                endif;
            ?>

            </main>

        <?php
        endif;
        ?>
	</div><!-- #primary -->

<?php
include locate_template('footer.php');
