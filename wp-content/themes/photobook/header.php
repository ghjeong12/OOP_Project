<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package PhotoBook
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> xmlns="http://www.w3.org/1999/html">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<header class="dt-header<?php if ( ! is_front_page() ) { echo ' inner-page-header'; } ?>">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<div class="dt-logo">

					<?php
					$description = get_bloginfo( 'description', 'display' );
					?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php
					if ( $description || is_customize_preview() ) : ?>
						<p class="site-description"><?php echo $description; ?></p>
					<?php endif; ?>

				</div><!-- .dt-logo -->
			</div><!-- .col-lg-12 ---->
		</div><!-- .row -->
	</div><!-- .container-fluid -->
</header><!-- .dt-header -->

<nav class="dt-main-menu transition5">
	<div class="dt-menu-wrap<?php if ( ! is_front_page() ) { echo ' inner-page-menu'; } ?>">
		<span class="dt-menu-trigger transition5"></span>
	</div><!-- .dt-menu-wrap -->

	<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
</nav><!-- .dt-main-menu -->

<?php if( ! is_front_page() ) : ?>

	<div class="dt-header-sep"></div>

	<div class="dt-breadcrumbs">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<?php photobook_breadcrumb(); ?>
				</div><!-- .col-lg-12 -->
			</div><!-- .row-->
		</div><!-- .container-->
	</div><!-- .dt-breadcrumbs-->

<?php endif; ?>

