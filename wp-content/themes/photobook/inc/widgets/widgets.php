<?php

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function photobook_widgets_init() {

    // Register Right Sidebar
    register_sidebar( array(
        'name'          => esc_html__( 'Right Sidebar', 'photobook' ),
        'id'            => 'dt-right-sidebar',
        'description'   => __( 'Add widgets to Show widgets at right panel of page', 'photobook' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    // Footer Social
    register_sidebar( array(
        'name'          => esc_html__( 'Footer Social Icons', 'photobook' ),
        'id'            => 'dt-footer-social',
        'description'   =>  __( 'Add Social widgets to Show social profiles icons at Footer', 'photobook' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

}
add_action( 'widgets_init', 'photobook_widgets_init' );

/**
 * Enqueue Admin Scripts
 */
function photobook_media_script( $hook ) {
    if ( 'widgets.php' != $hook ) {
        return;
    }

    // widgets.css
    wp_enqueue_style('admin-styles', get_template_directory_uri() . '/inc/widgets/widgets.css');
}
add_action( 'admin_enqueue_scripts', 'photobook_media_script' );

/**
 * Social Icons widget.
 */
class photobook_social_icons extends WP_Widget {

    public function __construct() {

        parent::__construct(
            'photobook_social_icons',
            __( 'Daisy: Social Icons', 'photobook' ),
            array(
                'classname'     => 'dt-social-icons',
                'description'   => __( 'Social Icons', 'photobook' )
            )
        );

    }

    public function widget( $args, $instance ) {

        $title      = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';
        $facebook   = isset( $instance['facebook'] ) ? $instance['facebook'] : '';
        $twitter    = isset( $instance['twitter'] ) ? $instance['twitter'] : '';
        $g_plus     = isset( $instance['g-plus'] ) ? $instance['g-plus'] : '';
        $instagram  = isset( $instance['instagram'] ) ? $instance['instagram'] : '';
        $github     = isset( $instance['github'] ) ? $instance['github'] : '';
        $flickr     = isset( $instance['flickr'] ) ? $instance['flickr'] : '';
        $pinterest  = isset( $instance['pinterest'] ) ? $instance['pinterest'] : '';
        $wordpress  = isset( $instance['wordpress'] ) ? $instance['wordpress'] : '';
        $youtube    = isset( $instance['youtube'] ) ? $instance['youtube'] : '';
        $vimeo      = isset( $instance['vimeo'] ) ? $instance['vimeo'] : '';
        $linkedin   = isset( $instance['linkedin'] ) ? $instance['linkedin'] : '';
        $behance    = isset( $instance['behance'] ) ? $instance['behance'] : '';
        $dribbble   = isset( $instance['dribbble'] ) ? $instance['dribbble'] : '';
   ?>

        <ul class="widget dt-social-icons">
            <?php if( ! empty( $title ) ) { ?><h2 class="widget-title"><?php echo esc_attr( $title ); ?></h2><?php } ?>

            <?php if( ! empty( $facebook ) ) { ?>
                <li><a href="<?php echo esc_url( $facebook ); ?>" target="_blank"><i class="fa fa-facebook transition35"></i></a> </li>
            <?php } ?>

            <?php if( ! empty( $twitter ) ) { ?>
                <li><a href="<?php echo esc_url( $twitter ); ?>" target="_blank"><i class="fa fa-twitter transition35"></i></a> </li>
            <?php } ?>

            <?php if( ! empty( $g_plus ) ) { ?>
                <li><a href="<?php echo esc_url( $g_plus ); ?>" target="_blank"><i class="fa fa-google-plus transition35"></i></a> </li>
            <?php } ?>

            <?php if( ! empty( $instagram ) ) { ?>
                <li><a href="<?php echo esc_url( $instagram ); ?>" target="_blank"><i class="fa fa-instagram transition35"></i></a> </li>
            <?php } ?>

            <?php if( ! empty( $github ) ) { ?>
                <li><a href="<?php echo esc_url( $github ); ?>" target="_blank"><i class="fa fa-github transition35"></i></a> </li>
            <?php } ?>

            <?php if( ! empty( $flickr ) ) { ?>
                <li><a href="<?php echo esc_url( $flickr ); ?>" target="_blank"><i class="fa fa-flickr transition35"></i></a> </li>
            <?php } ?>

            <?php if( ! empty( $pinterest ) ) { ?>
                <li><a href="<?php echo esc_url( $pinterest ); ?>" target="_blank"><i class="fa fa-pinterest transition35"></i></a> </li>
            <?php } ?>

            <?php if( ! empty( $wordpress ) ) { ?>
                <li><a href="<?php echo esc_url( $wordpress ); ?>" target="_blank"><i class="fa fa-wordpress transition35"></i></a> </li>
            <?php } ?>

            <?php if( ! empty( $youtube ) ) { ?>
                <li><a href="<?php echo esc_url( $youtube ); ?>" target="_blank"><i class="fa fa-youtube transition35"></i></a> </li>
            <?php } ?>

            <?php if( ! empty( $vimeo ) ) { ?>
                <li><a href="<?php echo esc_url( $vimeo ); ?>" target="_blank"><i class="fa fa-vimeo transition35"></i></a> </li>
            <?php } ?>

            <?php if( ! empty( $linkedin ) ) { ?>
                <li><a href="<?php echo esc_url( $linkedin ); ?>" target="_blank"><i class="fa fa-linkedin transition35"></i></a> </li>
            <?php } ?>

            <?php if( ! empty( $behance ) ) { ?>
                <li><a href="<?php echo esc_url( $behance ); ?>" target="_blank"><i class="fa fa-behance transition35"></i></a> </li>
            <?php } ?>

            <?php if( ! empty( $dribbble ) ) { ?>
                <li><a href="<?php echo esc_url( $dribbble ); ?>" target="_blank"><i class="fa fa-dribbble transition35"></i></a> </li>
            <?php } ?>

            <div class="clearfix"></div>
        </ul>

        <?php

    }

    public function form( $instance ) {

        $instance = wp_parse_args(
            (array) $instance, array(
                'title'             => '',
                'facebook'          => '',
                'twitter'           => '',
                'g-plus'            => '',
                'instagram'         => '',
                'github'            => '',
                'flickr'            => '',
                'pinterest'         => '',
                'wordpress'         => '',
                'youtube'           => '',
                'vimeo'             => '',
                'linkedin'          => '',
                'behance'           => '',
                'dribbble'          => ''
            )
        );

        ?>

        <div class="dt-social-icons">
            <div class="dt-admin-input-wrap">
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'photobook' ); ?></label>
                <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" placeholder="<?php _e( 'Title', 'photobook' ); ?>">
            </div><!-- .dt-admin-input-wrap -->

            <div class="dt-admin-input-wrap">
                <label for="<?php echo $this->get_field_id( 'facebook' ); ?>"><?php _e( 'Facebook', 'photobook' ); ?></label>
                <input type="text" id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" value="<?php echo esc_attr( $instance['facebook'] ); ?>" placeholder="<?php _e( 'https://www.facebook.com/', 'photobook' ); ?>">
            </div><!-- .dt-admin-input-wrap -->

            <div class="dt-admin-input-wrap">
                <label for="<?php echo $this->get_field_id( 'twitter' ); ?>"><?php _e( 'Twitter', 'photobook' ); ?></label>
                <input type="text" id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" value="<?php echo esc_attr( $instance['twitter'] ); ?>" placeholder="<?php _e( 'https://twitter.com/', 'photobook' ); ?>">
            </div><!-- .dt-admin-input-wrap -->

            <div class="dt-admin-input-wrap">
                <label for="<?php echo $this->get_field_id( 'g-plus' ); ?>"><?php _e( 'G plus', 'photobook' ); ?></label>
                <input type="text" id="<?php echo $this->get_field_id( 'g-plus' ); ?>" name="<?php echo $this->get_field_name( 'g-plus' ); ?>" value="<?php echo esc_attr( $instance['g-plus'] ); ?>" placeholder="<?php _e( 'https://plus.google.com/', 'photobook' ); ?>">
            </div><!-- .dt-admin-input-wrap -->

            <div class="dt-admin-input-wrap">
                <label for="<?php echo $this->get_field_id( 'instagram' ); ?>"><?php _e( 'Instagram', 'photobook' ); ?></label>
                <input type="text" id="<?php echo $this->get_field_id( 'instagram' ); ?>" name="<?php echo $this->get_field_name( 'instagram' ); ?>" value="<?php echo esc_attr( $instance['instagram'] ); ?>" placeholder="<?php _e( 'https://instagram.com/', 'photobook' ); ?>">
            </div><!-- .dt-admin-input-wrap -->

            <div class="dt-admin-input-wrap">
                <label for="<?php echo $this->get_field_id( 'github' ); ?>"><?php _e( 'Github', 'photobook' ); ?></label>
                <input type="text" id="<?php echo $this->get_field_id( 'github' ); ?>" name="<?php echo $this->get_field_name( 'github' ); ?>" value="<?php echo esc_attr( $instance['github'] ); ?>" placeholder="<?php _e( 'https://github.com/', 'photobook' ); ?>">
            </div><!-- .dt-admin-input-wrap -->

            <div class="dt-admin-input-wrap">
                <label for="<?php echo $this->get_field_id( 'flickr' ); ?>"><?php _e( 'Flickr', 'photobook' ); ?></label>
                <input type="text" id="<?php echo $this->get_field_id( 'flickr' ); ?>" name="<?php echo $this->get_field_name( 'flickr' ); ?>" value="<?php echo esc_attr( $instance['flickr'] ); ?>" placeholder="<?php _e( 'https://www.flickr.com/', 'photobook' ); ?>">
            </div><!-- .dt-admin-input-wrap -->

            <div class="dt-admin-input-wrap">
                <label for="<?php echo $this->get_field_id( 'pinterest' ); ?>"><?php _e( 'Pinterest', 'photobook' ); ?></label>
                <input type="text" id="<?php echo $this->get_field_id( 'pinterest' ); ?>" name="<?php echo $this->get_field_name( 'pinterest' ); ?>" value="<?php echo esc_attr( $instance['pinterest'] ); ?>" placeholder="<?php _e( 'https://www.pinterest.com/', 'photobook' ); ?>">
            </div><!-- .dt-admin-input-wrap -->

            <div class="dt-admin-input-wrap">
                <label for="<?php echo $this->get_field_id( 'wordpress' ); ?>"><?php _e( 'WordPress', 'photobook' ); ?></label>
                <input type="text" id="<?php echo $this->get_field_id( 'wordpress' ); ?>" name="<?php echo $this->get_field_name( 'wordpress' ); ?>" value="<?php echo esc_attr( $instance['wordpress'] ); ?>" placeholder="<?php _e( 'https://wordpress.org/', 'photobook' ); ?>">
            </div><!-- .dt-admin-input-wrap -->

            <div class="dt-admin-input-wrap">
                <label for="<?php echo $this->get_field_id( 'youtube' ); ?>"><?php _e( 'YouTube', 'photobook' ); ?></label>
                <input type="text" id="<?php echo $this->get_field_id( 'youtube' ); ?>" name="<?php echo $this->get_field_name( 'youtube' ); ?>" value="<?php echo esc_attr( $instance['youtube'] ); ?>" placeholder="<?php _e( 'https://www.youtube.com/', 'photobook' ); ?>">
            </div><!-- .dt-admin-input-wrap -->

            <div class="dt-admin-input-wrap">
                <label for="<?php echo $this->get_field_id( 'vimeo' ); ?>"><?php _e( 'Vimeo', 'photobook' ); ?></label>
                <input type="text" id="<?php echo $this->get_field_id( 'vimeo' ); ?>" name="<?php echo $this->get_field_name( 'vimeo' ); ?>" value="<?php echo esc_attr( $instance['vimeo'] ); ?>" placeholder="<?php _e( 'https://vimeo.com/', 'photobook' ); ?>">
            </div><!-- .dt-admin-input-wrap -->

            <div class="dt-admin-input-wrap">
                <label for="<?php echo $this->get_field_id( 'linkedin' ); ?>"><?php _e( 'Linkedin', 'photobook' ); ?></label>
                <input type="text" id="<?php echo $this->get_field_id( 'linkedin' ); ?>" name="<?php echo $this->get_field_name( 'linkedin' ); ?>" value="<?php echo esc_attr( $instance['linkedin'] ); ?>" placeholder="<?php _e( 'https://linkedin.com', 'photobook' ); ?>" >
            </div><!-- .dt-admin-input-wrap -->

            <div class="dt-admin-input-wrap">
                <label for="<?php echo $this->get_field_id( 'behance' ); ?>"><?php _e( 'Behance', 'photobook' ); ?></label>
                <input type="text" id="<?php echo $this->get_field_id( 'behance' ); ?>" name="<?php echo $this->get_field_name( 'behance' ); ?>" value="<?php echo esc_attr( $instance['behance'] ); ?>" placeholder="<?php _e( 'https://www.behance.net/', 'photobook' ); ?>" >
            </div><!-- .dt-admin-input-wrap -->

            <div class="dt-admin-input-wrap">
                <label for="<?php echo $this->get_field_id( 'dribbble' ); ?>"><?php _e( 'Dribbble', 'photobook' ); ?></label>
                <input type="text" id="<?php echo $this->get_field_id( 'dribbble' ); ?>" name="<?php echo $this->get_field_name( 'dribbble' ); ?>" value="<?php echo esc_attr( $instance['dribbble'] ); ?>" placeholder="<?php _e( 'https://dribbble.com/', 'photobook' ); ?>" >
            </div><!-- .dt-admin-input-wrap -->
        </div><!-- .dt-social-icons -->
        <?php
    }

    public function update( $new_instance, $old_instance ) {

        $instance              = $old_instance;
        $instance[ 'title' ]     = sanitize_text_field( $new_instance[ 'title' ] );
        $instance['facebook']  = esc_url_raw ( $new_instance['facebook'] );
        $instance['twitter']   = esc_url_raw ( $new_instance['twitter'] );
        $instance['g-plus']    = esc_url_raw ( $new_instance['g-plus'] );
        $instance['instagram'] = esc_url_raw ( $new_instance['instagram'] );
        $instance['github']    = esc_url_raw ( $new_instance['github'] );
        $instance['flickr']    = esc_url_raw ( $new_instance['flickr'] );
        $instance['pinterest'] = esc_url_raw ( $new_instance['pinterest'] );
        $instance['wordpress'] = esc_url_raw ( $new_instance['wordpress'] );
        $instance['youtube']   = esc_url_raw ( $new_instance['youtube'] );
        $instance['vimeo']     = esc_url_raw ( $new_instance['vimeo'] );
        $instance['linkedin']  = esc_url_raw ( $new_instance['linkedin'] );
        $instance['behance']   = esc_url_raw ( $new_instance['behance'] );
        $instance['dribbble']  = esc_url_raw ( $new_instance['dribbble'] );
        return $instance;

    }

}

// Register widgets
function photobook_register_widgets() {

    register_widget( 'photobook_social_icons' );

}
add_action( 'widgets_init', 'photobook_register_widgets' );
