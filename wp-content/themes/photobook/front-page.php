<?php
/**
 * The front page template file.
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

<?php if( is_front_page() ) :
	$activate_slider = get_theme_mod( 'photobook_activate_slider' );

	if ( $activate_slider == 1 ) : ?>

		<div class="dt-image-slider">
			<div class="swiper-wrapper">

				<?php
				$show_posts_from = get_theme_mod( 'dt_slider_type', '' );
				$category        = get_theme_mod( 'dt_slider_cat', '' );
				$no_of_posts     = get_theme_mod( 'dt_slides_number', '' );

				if( $show_posts_from == 'recent_posts' ) {
					$dt_image_slider = new WP_Query( array(
							'post_type'         	=> 'post',
							'category__in'      	=> '',
							'posts_per_page'    	=> $no_of_posts,
							'ignore_sticky_posts'   => true
					) );
				} else {
					$dt_image_slider = new WP_Query(
							array(
									'post_type'        	=> 'post',
									'category__in'     	=> $category,
									'posts_per_page'   	=> $no_of_posts
							)
					);
				}
				?>

				<?php if ( $dt_image_slider->have_posts() ) : ?>

					<?php while ( $dt_image_slider->have_posts() ) : $dt_image_slider->the_post(); ?>
						<?php if ( has_post_thumbnail() ) : ?>

							<div class="swiper-slide">
								<div class="dt-image-slider-holder">
									<figure>

										<?php
										if ( has_post_thumbnail() ) :
											$image = '';
											$title_attribute = get_the_title( $post->ID );
											$image .= get_the_post_thumbnail( $post->ID, 'photobook-banner-image', array( 'title' => esc_attr( $title_attribute ), 'alt' => esc_attr( $title_attribute ) ) ).'</a>';
											echo $image;
										else : ?>
											<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/blank.png" alt="no image found"/>
										<?php
										endif;
										?>

									</figure>

									<div class="dt-image-slider-desc">
										<article>
											<h1><?php the_title(); ?></h1>

											<?php the_excerpt(); ?>

											<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php _e( 'Read More', 'photobook' ); ?></a>
										</article>
									</div><!-- .dt-image-slider-desc -->
								</div><!-- .dt-image-slider-holder -->
							</div><!-- .swiper-slide -->

						<?php
						endif;

					endwhile;

					wp_reset_postdata();

				endif;
				?>

			</div><!-- .swiper-wrapper -->

			<div class="swiper-pagination"></div>

			<div class="dt-scroll-down"><i class="fa fa-angle-down"></i></div>
		</div><!-- .dt-image-slider -->

	<?php else : ?>

		<div class="dt-header-sep dt-front-header-sep"></div>

	<?php endif; ?>

<?php endif; ?>

<?php if ( 'page' == get_option( 'show_on_front' ) ) : ?>

	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-md-8">
				<div id="primary" class="content-area">
					<main id="main" class="site-main" role="main">

						<?php
						while ( have_posts() ) : the_post();

							get_template_part( 'template-parts/content', 'page' );

							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;

						endwhile; // End of the loop.

						wp_reset_postdata();
						?>

					</main><!-- #main -->
				</div><!-- #primary -->
			</div><!-- .col-lg-8 -->

			<div class="col-lg-4 col-md-4">
				<?php get_sidebar(); ?>
			</div><!-- .col-lg-4 -->
		</div><!-- .row -->
	</div><!-- .container -->

<?php else : ?>

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

<?php endif; ?>

<?php get_footer(); ?>
