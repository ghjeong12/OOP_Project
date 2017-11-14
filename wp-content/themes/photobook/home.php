<?php
/**
 * The home template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Passionate
 */

get_header(); ?>

<section class="dt-front-posts-wrap">

	<?php

	if ( have_posts() ) :

		while ( have_posts() ) : the_post(); ?>

			<div <?php post_class( 'dt-front-post' ); ?>>
				<figure>
					<?php
					if ( has_post_thumbnail() ) :
						$dt_post_id = get_the_ID();
						$dt_post_thumbnail_id = get_post_thumbnail_id( $dt_post_id );
						$dt_thumbnail = wp_get_attachment_image( $dt_post_thumbnail_id, 'photobook-front-post-img', true );
						echo $dt_thumbnail;

					else : ?>
						<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/blank.png" alt="no image found"/>
					<?php
					endif;
					?>
				</figure>

				<div class="dt-front-post-meta transition5">
					<h2 class="transition5"><?php the_title(); ?></h2>

					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php _e( 'View Details', 'photobook' ); ?></a>
				</div><!-- .dt-front-post-meta -->
			</div>

			<?php
		endwhile;

		wp_reset_postdata();

	endif;
	?>

	<div id="dt-append-ajax-data"></div>

	<div class="dt-front-post-load-more" id="dt-ajax-btn">
		<span class="transition5"><?php _e( 'Load More', 'photobook' ); ?></span>
		<img src="<?php echo esc_url( admin_url( '/images/wpspin_light.gif' ) );  ?>" class="waiting" id="dt-ajax-loading-icon" style="display: none;">
	</div><!-- .dt-front-post-load-more -->

	<div class="clearfix"></div>
</section><!-- .dt-front-posts-wrap -->

<?php get_footer(); ?>
