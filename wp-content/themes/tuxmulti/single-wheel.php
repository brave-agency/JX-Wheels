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

            <main id="main" class="site-main site-wheels">

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
                        <p class="site-wheels-price"><span>FROM </span><?php the_field('price_sign'); ?><?php the_field('price_pounds'); ?><span>.<?php the_field('price_pence'); ?></span><span>Per Set</span></p>
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
                        <a href="" class="site-button">Find a Stockist</a>
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
                    if( have_rows('info') ):
                ?>
                <div class="site-wheels-info">
                    <div class="site-wheels-info-details">
                        <h2 class="site-wheels-info-title"><?php the_field('info_title'); ?></h2>
                        <div class="site-wheels-info-text"><?php the_field('info_text'); ?></div>
                    </div>
                    <div class="site-wheels-info-image" style="background-image: url(<?php the_field('info_image'); ?>);"></div>
                </div>
                <?php
                    endif;
                ?>


            </main>

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
                    <h3 class="site-wheel-details-price"><span>FROM </span><?php the_field('price_sign'); ?><?php the_field('price_pounds'); ?><span>.<?php the_field('price_pence'); ?></span><span>Per Set</span></h3>
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
                <h2 class="site-title"><?php the_field('warranty_title'); ?></h2>
            </div>
            <?php
                endif;
            ?>

            <?php
                if( have_rows('available_in_options') ):
            ?>
            <div class="site-wheel-availablein" >
                <h2><?php the_field('available_in_title'); ?></h2>
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
            <div class="site-wheel-specifications" >
                <h2><?php the_field('specifications_title'); ?></h2>
                <p>PCD Range: <?php the_field('specifications_pcd_range'); ?></p>
                <?php
                    if( have_rows('specifications_options') ):
                ?>
           
                <table>
                    <thead>
                        <tr>
                            <th>SIZE</th>
                            <th>PCD</th> 
                            <th>ET / OFFSET</th>
                            <th>LOAD RATING</th>
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
                            <td><?php the_sub_field('load_rating'); ?></td>
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
