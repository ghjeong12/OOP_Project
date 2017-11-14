<?php
/**
 * PhotoBook functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package PhotoBook
 */

if ( ! function_exists( 'photobook_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function photobook_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on PhotoBook, use a find and replace
	 * to change 'photobook' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'photobook', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Custom Image Crop
	add_image_size( 'photobook-banner-image', 1920, 980, true );
	add_image_size( 'photobook-front-post-img', 450, 330, true );
	add_image_size( 'photobook-blog-img', 750, '', true );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'photobook' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'photobook_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	/**
	 * Add editor style
	 */
	add_editor_style( 'css/custom-editor-style.css' );
}
endif; // photobook_setup
add_action( 'after_setup_theme', 'photobook_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function photobook_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'photobook_content_width', 640 );
}
add_action( 'after_setup_theme', 'photobook_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function photobook_scripts() {

	// Enqueue Bootstrap Grid
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.5', '' );

	// Enqueue FontAwesome
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.4.0', '' );

	// Enqueue Swiper.css
	wp_enqueue_style( 'swiper', get_template_directory_uri() . '/css/swiper.min.css', array(), '3.2.5', '' );

	// Enqueue colorbox.css
	wp_enqueue_style( 'colorbox', get_template_directory_uri() . '/css/colorbox.css', array(), '', '' );

	// Enqueue Google fonts
	wp_enqueue_style( 'photobook-font-roboto', '//fonts.googleapis.com/css?family=Roboto:400,300,500,700,900' );

	// Stylesheet
	wp_enqueue_style( 'photobook-style', get_stylesheet_uri() );

	// Enqueue nicescroll
	wp_enqueue_script( 'nicescroll', get_template_directory_uri() . '/js/jquery.nicescroll.min.js', array( 'jquery' ), '3.6.6', '' );

	// Enqueue Swiper
	wp_enqueue_script( 'swiper', get_template_directory_uri() . '/js/swiper.jquery.min.js', array( 'jquery' ), '3.2.5', '' );

	// colorbox JS
	wp_enqueue_script( 'colorbox', get_template_directory_uri() . '/js/jquery.colorbox-min.js', array( 'jquery' ), '', '' );

	// Custom JS
	wp_enqueue_script( 'photobook-custom-js', get_template_directory_uri() . '/js/custom.js', array( 'jquery' ), '', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'photobook_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Widgets file
 */
require get_template_directory() . '/inc/widgets/widgets.php';

/**
 * Convert hexdec color string to rgb(a) string
 */
function photobook_hex2rgba( $color, $opacity = false ) {

	$default = 'rgb(0,0,0)';

	//Return default if no color provided
	if( empty( $color ) )
		return $default;

	//Sanitize $color if "#" is provided
	if ( $color[0] == '#' ) {
		$color = substr( $color, 1 );
	}

	//Check if color has 6 or 3 characters and get values
	if ( strlen( $color ) == 6 ) {
		$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
	} elseif ( strlen( $color ) == 3 ) {
		$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
	} else {
		return $default;
	}

	//Convert hexadec to rgb
	$rgb =  array_map( 'hexdec', $hex );

	//Check if opacity is set(rgba or rgb)
	if( $opacity ){
		if( abs( $opacity ) > 1 )
			$opacity = 1.0;
		$output = 'rgba( '.implode( ",",$rgb ).','.$opacity.' )';
	} else {
		$output = 'rgb( '.implode( ",",$rgb ).' )';
	}

	//Return rgb(a) color string
	return $output;
}

/**
 * Breadcrumbs
 */
function photobook_breadcrumb() {
	global $post;
	echo '<ul id="dt_breadcrumbs">';
	if ( !is_home() ) {
		echo '<li><a href="';
		echo esc_url( home_url() );
		echo '">';
		echo __( 'Home', 'photobook' );
		echo '</a></li><li class="separator"> / </li>';
		if ( is_category() || is_single() ) {
			echo '<li>';
			the_category( ' </li><li class="separator"> / </li><li> ' );
			if ( is_single() ) {
				echo '</li><li class="separator"> / </li><li>';
				the_title();
				echo '</li>';
			}
		} elseif ( is_page() ) {
			if ( $post->post_parent ){
				$anc = get_post_ancestors( $post->ID );
				$title = get_the_title();
				foreach ( $anc as $ancestor ) {
					$output = '<li><a href="'. esc_url( get_permalink( $ancestor ) ) .'" title="'. esc_attr( get_the_title( $ancestor ) ) .'">'. esc_attr( get_the_title( $ancestor ) ) .'</a></li> <li class="separator"> / </li>';
				}
				echo $output;
				echo esc_attr( $title );
			} else {
				echo '<li>'. the_title_attribute() .'</li>';
			}
		}
	} elseif ( is_tag() ) {
		single_tag_title();
	} elseif ( is_day() ) {
		echo"<li>" . __( 'Archive for', 'photobook' ); the_time( 'F jS, Y' ); echo'</li>';
	} elseif ( is_month() ) {
		echo"<li>" . __( 'Archive for', 'photobook' ); the_time( 'F, Y' ); echo'</li>';
	} elseif ( is_year() ) {
		echo"<li>" . __( 'Archive for', 'photobook' ); the_time( 'Y' ); echo'</li>';
	} elseif ( is_author( ) ) {
		echo"<li>" . __( 'Author Archive', 'photobook' ); echo'</li>';
	} elseif ( isset( $_GET['paged'] ) && !empty( $_GET['paged'] ) ) {
		echo "<li>" . __( 'Blog Archive', 'photobook' ); echo'</li>';
	} elseif ( is_search() ) {
		echo"<li>" . __( 'Search Results', 'photobook' ); echo'</li>';
	}
	echo '</ul>';
}

/**
 * Register Load more scripts
 */
function photobook_register_load_more_scripts() {
	wp_localize_script( 'photobook-custom-js', 'photobook_load_more', array(
		'dt_nonce' => wp_create_nonce( 'dt_nonce' ),
		'ajax_url' => admin_url( 'admin-ajax.php' )
	));
}
add_action( 'wp_enqueue_scripts','photobook_register_load_more_scripts' );

/**
 * Ajax load more posts
 */
function photobook_get_ajax_results(){

	if ( !isset( $_POST['dt_nonce'] ) || !wp_verify_nonce( $_POST['dt_nonce'], 'dt_nonce' ) )
		die( 'Permissions check failed.' );
	$dt_pageNumber = absint( ( isset( $_POST['dt_pageNumber'] ) ) ? $_POST['dt_pageNumber'] : 0 );

	$args = array(
		'post_type'		 => 'post',
		'posts_per_page' => get_option( 'posts_per_page' ) + 1,
		'paged'   		 => $dt_pageNumber
	);

	$loop = new WP_Query( $args );

	if ( $loop->have_posts() ) :
		while ( $loop->have_posts() ) : $loop->the_post(); ?>

			<div class="dt-front-post">
				<figure>
					<?php
					if ( has_post_thumbnail() ) {

						$dt_post_id = get_the_ID();
						$dt_post_thumbnail_id = get_post_thumbnail_id( $dt_post_id );
						$dt_thumbnail = wp_get_attachment_image( $dt_post_thumbnail_id, 'photobook-front-post-img', true );
						echo $dt_thumbnail;
					}
					?>
				</figure>

				<div class="dt-front-post-meta transition5">
					<h2><?php the_title(); ?></h2>

					<a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php _e( 'View Details', 'photobook' ); ?></a>
				</div><!-- .dt-front-post-meta .transition5 -->
			</div><!-- .dt-front-post -->

		<?php endwhile;
		wp_reset_postdata();

	endif;
	die();
}
add_action( 'wp_ajax_get_ajax_results', 'photobook_get_ajax_results' ); //for logged in users
add_action( 'wp_ajax_nopriv_get_ajax_results', 'photobook_get_ajax_results' ); //for non logged in users

/**
 * wp localize script
 */
function photobook_load_scripts() {

	wp_enqueue_script( 'photobook-loadmore', get_template_directory_uri() .'/js/loadmore.js' );

	wp_localize_script( 'photobook-loadmore', 'photobook_script_vars', array(
			'no_more_posts' => __( 'No more post', 'photobook' )
		)
	);
}
add_action('wp_enqueue_scripts', 'photobook_load_scripts');

/**
 * Filter the except length.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function glow_archive_excerpt_length( $length ) {
	return ( is_front_page() ) ? 18 : 35;
}
add_filter( 'excerpt_length', 'glow_archive_excerpt_length', 999 );

/**
 * Filter the excerpt "read more" string.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
function glow_excerpt_more( $more ) {
	return '...';
}
add_filter( 'excerpt_more', 'glow_excerpt_more' );
