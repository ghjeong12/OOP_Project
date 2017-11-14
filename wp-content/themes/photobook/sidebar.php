<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package PhotoBook
 */

if ( ! is_active_sidebar( 'dt-right-sidebar' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area dt-sidebar" role="complementary">
	<?php dynamic_sidebar( 'dt-right-sidebar' ); ?>
</aside><!-- #secondary -->
