<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package PhotoBook
 */

get_header(); ?>

	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-md-8">
				<div id="primary" class="content-area dt-archive-wrap">
					<main id="main" class="site-main" role="main">

						<?php if ( have_posts() ) : ?>

							<header class="page-header">
								<?php
								the_archive_title( '<h1 class="page-title">', '</h1>' );
								the_archive_description( '<div class="taxonomy-description">', '</div>' );
								?>
							</header><!-- .page-header -->

							<div class="dt-archive-posts">
								<?php

								while ( have_posts() ) : the_post(); ?>

									<div class="dt-archive-post">
										<figure>

											<?php
												if ( has_post_thumbnail() ) :
													$image = '';
													$title_attribute = get_the_title( $post->ID );
													$image .= '<a href="'. esc_url( get_permalink() ) . '" title="' . the_title( '', '', false ) .'">';
													$image .= get_the_post_thumbnail( $post->ID, 'photobook-blog-img', array( 'title' => esc_attr( $title_attribute ), 'alt' => esc_attr( $title_attribute ) ) ).'</a>';
													echo $image;
												endif;
											?>

										</figure>

										<article>
											<header class="entry-header">
												<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
											</header><!-- .entry-header -->

											<div class="dt-archive-post-content">
												<?php the_excerpt(); ?>

											</div><!-- .dt-archive-post-content -->

											<div class="entry-footer">
												<a class="transition35" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php _e( 'Read more', 'photobook' ); ?></a>
											</div><!-- .dt-archive-post-readmore -->
										</article>
									</div><!-- .dt-archive-post -->

								<?php endwhile; ?>

								<?php wp_reset_postdata(); ?>
							</div><!-- .dt-category-posts -->

							<div class="clearfix"></div>

							<div class="dt-pagination-nav">
								<?php echo paginate_links(); ?>
							</div><!---- .dt-pagination-nav ---->

						<?php else : ?>
							<p><?php _e( 'Sorry, no posts matched your criteria.', 'photobook' ); ?></p>
						<?php endif; ?>

					</main><!-- #main -->
				</div><!-- #primary -->
			</div><!-- .col-lg-8 -->

			<div class="col-lg-4 col-md-4">
				<?php get_sidebar(); ?>
			</div><!-- .col-lg-4 -->
		</div><!-- .row -->
	</div><!-- .container -->

<?php
get_footer();
