	
<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package tuxmulti
 */

get_header();
?>

	<div id="primary" class="content-area">

		<!-- <?php
			$categories = get_the_category();
			if ( ! empty( $categories ) ) {
				foreach( $categories as $category ) {
					$category_name = $category->name;
					$category_bg = get_field('background', $category->taxonomy.'_'.$category->term_id);
				}
			}
		?>

		<div class="site-hero">
            <div class="site-hero-cover site-hero-cover-blog" data-parallax="scroll" data-image-src="<?php echo $category_bg; ?>">
                <div class="site-hero-inner">
                    <div class="site-hero-content">
						<h1 class="site-title site-title-bold"><?php echo $category_name; ?></h1>
						<?php
							if ( function_exists('yoast_breadcrumb') ) {
								yoast_breadcrumb('<p id="breadcrumbs" class="breadcrumbs-top">','</p>');
							}
						?>
                    </div>
                </div>
            </div>
		</div> -->

		<main id="main" class="site-main site-post">

		<?php
			while ( have_posts() ) : the_post();
		?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<header class="entry-header">
				<?php
				if ( is_singular() ) :
					the_title( '<h1 class="site-title site-title-bold">', '</h1>' );
				else :
					the_title( '<h2 class="site-title site-title-bold"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				endif;
		
				if ( 'post' === get_post_type() ) :
					?>
					<div class="entry-meta" style="background-image: url(<?php the_post_thumbnail_url(); ?>);">
						<a class="entry-meta-date" href="<?php the_permalink(); ?>"><span><?php the_time('dS') ?></span><?php the_time('M') ?></a>
					</div><!-- .entry-meta -->
				<?php endif; ?>
			</header><!-- .entry-header -->
		
			<div class="entry-content">
				<?php
				the_content( sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'tuxmulti' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				) );
		
				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'tuxmulti' ),
					'after'  => '</div>',
				) );
				?>
			</div><!-- .entry-content -->
		
		</article><!-- #post-<?php the_ID(); ?> -->
	
		<?php
			endwhile;
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
include locate_template('footer.php');