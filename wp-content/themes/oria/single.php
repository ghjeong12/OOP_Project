<?php
/**
 * The template for displaying all single posts.
 *
 * @package Oria
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'template-parts/content', 'single' ); ?>

<!-- ADDED -->
<?php if ( has_post_thumbnail() ) : ?>
<?php else : 
$id = get_the_ID();
?>

<?php
$filename = 'http://novain.kr/oopProject/wp-content/uploads/2017/12/default_image-150x150.png';

 //The ID of the post this attachment is for.
 $parent_post_id = $id;

 // Check the type of file. We'll use this as the 'post_mime_type'.
 $filetype = wp_check_filetype( basename( $filename ), null );

 // Get the path to the upload directory.
 $wp_upload_dir = wp_upload_dir();

 // Prepare an array of post data for the attachment.
 $attachment = array(
  'guid'           => $wp_upload_dir['url'] . '/' . basename( $filename ), 
    'post_mime_type' => $filetype['type'],
      'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
        'post_content'   => '',
          'post_status'    => 'inherit'
          );

          // Insert the attachment.
          $attach_id = wp_insert_attachment( $attachment, $filename, $parent_post_id );

          // Make sure that this file is included, as wp_generate_attachment_metadata() depends on it.
          require_once( ABSPATH . 'wp-admin/includes/image.php' );

          // Generate the metadata for the attachment, and update the database record.
          $attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
          wp_update_attachment_metadata( $attach_id, $attach_data );

          set_post_thumbnail( $parent_post_id, $attach_id );
?>
<!--
<div class="entry-thumbnail">
<a href="<?php the_permalink(); ?>"><?php echo($id); ?> <img src="<?php bloginfo('url'); ?>/wp-content/uploads/2017/12/default_image-150x150.png" alt="<?php the_title(); ?>" /></a>
</div> -->
<?php endif; ?>

			<?php the_post_navigation(); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>
  <?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php if ( get_theme_mod('fullwidth_single', 0) != 1 ) : ?>
	<?php get_sidebar(); ?>
<?php endif; ?>
<?php get_footer(); ?>
