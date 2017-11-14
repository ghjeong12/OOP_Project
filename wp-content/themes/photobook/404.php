<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package PhotoBook
 */

get_header(); ?>

	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-md-8">
				<div id="primary" class="content-area">
					<main id="main" class="site-main" role="main">

						<section class="error-404 not-found">
							<header class="page-header">
								<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'photobook' ); ?></h1>
							</header><!-- .page-header -->

							<div class="page-content">
								<p><?php esc_html_e( 'It looks like nothing was found at this location.', 'photobook' ); ?></p>

								<?php

								the_widget( 'WP_Widget_Recent_Posts' );

								?>

							</div><!-- .page-content -->
						</section><!-- .error-404 -->

					</main><!-- #main -->
				</div><!-- #primary -->
			</div><!-- .content-area -->

			<div class="col-lg-4 col-md-4">
				<?php get_sidebar(); ?>
			</div><!-- .col-lg-4 -->
		</div><!-- .row -->
	</div><!-- .container -->

<?php
get_footer();
