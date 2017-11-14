<?php
/**
 * PhotoBook Theme Customizer.
 *
 * @package PhotoBook
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function photobook_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// Drop-down Category
	if ( class_exists( 'WP_Customize_Control' ) ) {
		class photobook_Dropdown_Categories_Control extends WP_Customize_Control {
			public $type = 'dropdown-categories';

			public function render_content() { $dropdown = wp_dropdown_categories( array(
					'name'             => '_customize-dropdown-categories-' . $this->id,
					'echo'             => 0,
					'hide_empty'       => false,
					'show_option_none' => '&mdash; ' . __( 'Select', 'photobook' ) . ' &mdash;',
					'hide_if_empty'    => false,
					'selected'         => $this->value(),
				) );

				$dropdown = str_replace('<select', '<select ' . $this->get_link(), $dropdown );

				printf(
						'<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
						$this->label,
						$dropdown
				);
			}
		}
	}

	// Front Page Slider
	$wp_customize->add_section(	'dt_slider_section', array(
		'priority' 			 => 200,
		'title' 			 => __( 'Front Page Slider', 'photobook' ),
		'description'        => __( 'Front Page Slider Settings', 'photobook' )
	) );

	// Activate Homepage Slider
	$wp_customize->add_setting( 'photobook_activate_slider', array(
		'default' 			=> 0,
		'capability' 		=> 'edit_theme_options',
		'sanitize_callback' => 'photobook_checkbox_sanitize'
	) );

	$wp_customize->add_control( 'photobook_activate_slider', array(
		'type' 				=> 'checkbox',
		'label' 			=> __( 'Enable Home Page Slider', 'photobook' ),
		'settings' 			=> 'photobook_activate_slider',
		'section' 			=> 'dt_slider_section'
	) );

	// Choose Type
	$wp_customize->add_setting(	'dt_slider_type', array(
		'default' 			 => 'recent_posts',
		'capability' 		 => 'edit_theme_options',
		'sanitize_callback'  => 'photobook_slider_type_sanitize'
	) );

	$wp_customize->add_control( 'dt_slider_type', array(
		'type'			 	 => 'radio',
		'label' 			 => __( 'Choose Type: ', 'photobook' ),
		'choices' 			 => array(
			'recent_posts' 	 => __( 'Recent Posts', 'photobook' ),
			'posts_category' => __( 'Posts From category', 'photobook' )
		),
		'section'			 => 'dt_slider_section',
		'settings' 			 => 'dt_slider_type'
	) );

	// Choose Category
	$wp_customize->add_setting( 'dt_slider_cat', array(
		'capability' 		=> 'edit_theme_options',
		'sanitize_callback' => 'absint'
	) );

	$wp_customize->add_control( new photobook_Dropdown_Categories_Control( $wp_customize, 'dt_slider_cat', array(
		'label'    		 => __( 'Choose Category:', 'photobook' ),
		'type'    		 => 'dropdown-categories',
		'settings' 		 => 'dt_slider_cat',
		'section' 		 => 'dt_slider_section'
	) ) );

	// Number of Slides
	$wp_customize->add_setting(	'dt_slides_number',	array(
		'default' 			=> '3',
		'capability' 		=> 'edit_theme_options',
		'sanitize_callback' => 'photobook_sanitize_integer'
	) );

	$wp_customize->add_control(	'dt_slides_number',	array(
		'type'			 	=> 'number',
		'label' 			=> __( 'Set number of slides', 'photobook' ),
		'section'			=> 'dt_slider_section',
		'settings' 			=> 'dt_slides_number'
	) );

	// Font Colors
	$wp_customize->add_setting(	'photobook_font_color',	array(
			'default' 			     => '#273039',
			'capability' 			 => 'edit_theme_options',
			'sanitize_callback'		 => 'photobook_color_sanitize',
			'sanitize_js_callback'   => 'photobook_color_escaping_sanitize'
	) );

	$wp_customize->add_control(	new WP_Customize_Color_Control(	$wp_customize, 'photobook_font_color', array(
			'label' 		=> __( 'Font Color', 'photobook' ),
			'section' 		=> 'colors',
			'settings' 		=> 'photobook_font_color'
	) ) );

	// Primary Color
	$wp_customize->add_setting(	'photobook_primary_color', array(
			'default' 			     => '#17bebb',
			'capability' 			 => 'edit_theme_options',
			'sanitize_callback'		 => 'photobook_color_sanitize',
			'sanitize_js_callback'   => 'photobook_color_escaping_sanitize'
	) );

	$wp_customize->add_control(	new WP_Customize_Color_Control(	$wp_customize, 'photobook_primary_color', array(
			'label' 		=> __( 'Primary Color', 'photobook' ),
			'section' 		=> 'colors',
			'settings' 		=> 'photobook_primary_color'
	) ) );

	// Color Sanitizate
	function photobook_color_sanitize( $color ) {
		if ( $unhashed = sanitize_hex_color_no_hash( $color ))
			return '#' . $unhashed;

		return $color;
	}

	// Checkbox Sanitize
	function photobook_checkbox_sanitize( $input ) {
		if ( $input == 1 ) {
			return 1;
		} else {
			return '';
		}
	}

	// Color Escape Sanitize
	function photobook_color_escaping_sanitize( $input ) {
		$input = esc_attr( $input );
		return $input;
	}

	// Sanitize Slider type
	function photobook_slider_type_sanitize( $input ) {
		$valid_keys = array(
			'recent_posts' 	 => __( 'Recent Posts', 'photobook' ),
			'posts_category' => __( 'Posts From category', 'photobook' )
		);

		if ( array_key_exists( $input, $valid_keys ) ) {
			return $input;
		} else {
			return '';
		}
	}

	// Number Integer
	function photobook_sanitize_integer( $input ) {
		return absint( $input );
	}

}
add_action( 'customize_register', 'photobook_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function photobook_customize_preview_js() {
	wp_enqueue_script( 'photobook_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'photobook_customize_preview_js' );

/**
 * Enqueue Inline styles generated by customizer
 */
function photobook_customizer_styles() {
	$font_color = esc_attr( get_theme_mod( 'photobook_font_color' ) );

	if ( $font_color != '' ) {
		$rgba_8_font_color = esc_attr( photobook_hex2rgba( $font_color, .8 ) );
		$rgba_6_font_color = esc_attr( photobook_hex2rgba( $font_color, .6 ) );

		$dt_font_color = "
	body,
	h1 a,
	h2 a,
	h3 a,
	h4 a,
	h5 a,
	h6 a,
	.dt-logo a,
	select,
	input[type='text'],
	input[type='email'],
	input[type='number'],
	input[type='search'],
	input[type='url'],
	textarea,
	input[type='submit'] {
		color: {$font_color};
	}

	a,
	#dt_breadcrumbs li a,
	label,
	.form-submit input[type=\"submit\"],
	.wpcf7-form input[type=\"submit\"] {
		color: {$rgba_6_font_color};
	}

	.inner-page-header .dt-logo p,
	.inner-page-header .dt-logo h1 a,
	#dt_breadcrumbs li,
	.dt-archive-post .entry-footer a,
	.dt-pagination-nav a,
	.dt-pagination-nav .current,
	.dt-sidebar li,
	.dt-sidebar li a,
	caption,
	.dt-main-menu li a {
		color: {$rgba_8_font_color};
	}
	";

	} else {
		$dt_font_color = '';
	}

	$primary_color = esc_attr( get_theme_mod( 'photobook_primary_color' ) );

	if ( $primary_color != '' ) {
		$dt_primary_color = "
	a:hover,
	.dt-logo h1 a:hover,
	.inner-page-header .dt-logo h1 a:hover,
	.dt-menu-trigger:hover,
	.dt-main-menu li a:hover,
	#dt_breadcrumbs li a:hover,
	.dt-pagination-nav a:hover,
	.dt-pagination-nav .current:hover,
	.dt-sidebar li:hover,
	.dt-sidebar li a:hover,
	.dt-footer-bar a:hover {
		color: {$primary_color};
	}

	.dt-menu-trigger:hover {
		border-color: {$primary_color};
	}

	.dt-image-slider-desc article a:hover,
	.dt-image-slider .swiper-pagination-bullet-active,
	.dt-front-post-load-more span:hover,
	.dt-front-post-load-more p,
	.dt-front-post-meta a:hover,
	.dt-archive-post .entry-footer a:hover,
	.dt-sidebar .tagcloud a:hover,
	#back-to-top:hover,
	.form-submit input[type=\"submit\"]:hover,
	.tagcloud a:hover {
		background: {$primary_color};
	}
	";
	} else {
		$dt_primary_color = '';
	}

	$custom_css = $dt_font_color . $dt_primary_color;

	wp_add_inline_style( 'photobook-style', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'photobook_customizer_styles' );
