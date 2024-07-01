<?php
/**
 * Template Name: Find a Stockist
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package tuxauto
 */

get_header();

$original_blog_id = get_current_blog_id();
$main_blog_id = 4;

//switch_to_blog( $main_blog_id );

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
        <div class="site-stockists site-stockists-resultpage">
            <button class="site-stockists-close"></button>

            <h2 class="site-title">Where To Buy</h2>

            <form class="site-stockists-form" action="/find-a-stockist/">
                <ul class="site-stockists-options">

                    <li>
                        <label class="checkbox">
                            <input type="hidden" name="categories[]" value="jx-wheels" checked />
                        </label>
                    </li>

                </ul>
                <div class="site-stockists-inputs">
                    <div class="site-stockists-postcode">
                        <input type="text" value="<?php echo urldecode($postcode) ?>" name="postcode" placeholder="Enter Postcode">
                    </div>
                    <div class="site-stockists-distance">
                        <select name="distance">
                            <?php
                            $selected = null;

                            foreach ($distances as $d) :

                                if ($distance == $d) :
                                    $selected = 'selected';
                                else :
                                    $selected = '';
                                endif;
                                ?>
                                <option value="<?php echo $d ?>" <?php echo $selected; ?>><?php echo $d ?> Miles</option>
                                <?php
                            endforeach;
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="site-button">Search</button>
                </div>
            </form>

            <h2 class="site-stockists-results">Search Results</h2>

            <ul class="site-stockists-list">
                <?php
                if (!empty($myposts)) :
                    foreach ($myposts as $post) : setup_postdata($post);
                        ?>
                        <li>
                            <div>
                                <h3><?php the_title(); ?></h3>
                                <p class="site-stockists-list-address"><b>A: </b><?php the_field('address'); ?>, <?php the_field('post_code'); ?></p>
                                <p class="site-stockists-list-telephone"><b>T: </b><?php the_field('telephone'); ?></p>
                                <p class="site-stockists-list-email"><b>E: </b><?php the_field('email'); ?></p>
                                <p class="site-stockists-list-website"><b>W: </b><a href="<?php the_field('website'); ?>" target="_blank"><?php the_field('website'); ?></a></p>
                            </div>
                        </li>
                        <?php
                    endforeach;
                    wp_reset_postdata();
                else :
                    ?>
                    <li>
                        <div style="text-align: center;">
                            No results found. Please try a different post code.
                        </div>
                    </li>
                <?php
                endif;
                ?>
            </ul>
        </div>

        <div class="site-getintouch">
            <h2 class="site-getintouch-title">Get in Touch</h2>
            <?php echo do_shortcode('[contact-form-7 id="161" title="Get in Touch"]'); ?>
        </div>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
//restore_current_blog();
include locate_template('footer.php');
