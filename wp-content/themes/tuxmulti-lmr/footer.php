<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package tuxmulti
 */

?>

	</div><!-- #content -->

	<!-- Begin MailChimp Signup Form -->
	<div id="mc_embed_signup hidden-xs hidden-sm" class="site-newsletter">
		<div class="site-newsletter-inner">
			<h2 class="site-newsletter-title"><?php the_field('newsletter_title', 'option'); ?></h2>

			<form action="//tuxauto.us8.list-manage.com/subscribe/post-json?u=75f8a0416f6b7987e9fafee30&id=7d782fa2b7" method="get" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" target="_blank" novalidate="">
				<div id="mc_embed_signup_scroll">
					<div class="mc-field-group form-group">
						<input type="email" value="" name="EMAIL" class="required email form-control" id="mce-EMAIL" placeholder="Enter Your Email...">
					</div>
					<div id="mce-responses" class="clear">
						<div class="response" id="mce-error-response" style="display:none"></div>
						<div class="response" id="mce-success-response" style="display:none"></div>
					</div>
					<div style="position: absolute; left: -5000px;"><input type="text" name="b_75f8a0416f6b7987e9fafee30_c769db34dc" tabindex="-1" value=""></div>
					<input type="submit" value="Submit" name="subscribe" id="mc-embedded-subscribe" class="site-button">
				</div>
			</form>
		</div>
	</div>

	<!--End mc_embed_signup-->

	<footer id="colophon" class="site-footer">

		<div class="site-footer-inner">

			<div class="site-footer-left">

				<h2 class="site-footer-title"><?php the_field('footer_title', 'option'); ?></h2>

				<p class="site-footer-text"><?php the_field('footer_text', 'option'); ?></p>

				<?php
					if( have_rows('contact_details', 'option') ):
				?>
				<div class="site-info">
					<p class="site-info-bold"><?php the_field('contact_details_title', 'option'); ?></p>
					<p>T: <?php the_field('contact_details_telephone', 'option'); ?></p>
					<p>E: <?php the_field('contact_details_email', 'option'); ?></p>
					<p>A: <?php the_field('contact_details_address', 'option'); ?></p>
				</div>
				<?php
					endif;
				?>

				<?php
					if( have_rows('social_links', 'option') ):
				?>
				<ul class="site-social">
					<?php
						while ( have_rows('social_links', 'option') ) : the_row();
					?>
						<li><a href="<?php the_sub_field('url', 'option'); ?>" target="_blank" class="<?php the_sub_field('title', 'option'); ?>"></a></li>
					<?php
						endwhile;
					?>
				</ul>
				<?php
					endif;
				?>

				<?php
					if( have_rows('page_links', 'option') ):
				?>
				<ul class="site-links">
					<?php
						while ( have_rows('page_links', 'option') ) : the_row();
					?>
						<li><a href="<?php the_sub_field('link', 'option'); ?>" target="_blank"><?php the_sub_field('title', 'option'); ?></a></li>
					<?php
						endwhile;
					?>
				</ul>
				<?php
					endif;
				?>

				<div class="site-info site-copyright">
					<p><?php the_field('copyright', 'option'); ?></p>
					<p>Web Design & Development by <a href="https://www.brave.agency/" target="_blank">Brave Agency</a></p>
				</div>

			</div>

			<!-- <div class="site-instagram sdf" data-id="<?php echo $hashtag; echo get_field("instagram_access_token") ?>">

				<h2 class="site-instagram-title">
					<a target="_blank" href="https://www.instagram.com/tags/<?php echo $hashtag ?>">#<?php echo $hashtag ?></a>
				</h2>

			</div> -->

		</div>

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
