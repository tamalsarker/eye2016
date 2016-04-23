<?php
/**
 * Loads up all the widgets defined by this theme. Note that this function will not work for versions of WordPress 2.7 or lower
 *
 */
function css_script() {
	if (!is_admin()) {
		//wp_enqueue_style('widgets', get_bloginfo('template_url') . '/widgets/widgets.css', false);
	}
}

add_action('init', 'css_script');

add_action( 'admin_enqueue_scripts', 'wp_enqueue_media' );

function eye_Script(){
	//wp_enqueue_media();  // problem with customizer option if we use here
	wp_enqueue_style('wp-color-picker');	
    wp_enqueue_script('wp-color-picker');
}
add_action('init', 'eye_Script');

include_once (TEMPLATEPATH . '/inc/widgets/eye-header-middle.php');
include_once (TEMPLATEPATH . '/inc/widgets/eye-header-right.php');
include_once (TEMPLATEPATH . '/inc/widgets/eye-company-logo.php');
include_once (TEMPLATEPATH . '/inc/widgets/eye-profile.php');
include_once (TEMPLATEPATH . '/inc/widgets/eye-practice-areas.php');
include_once (TEMPLATEPATH . '/inc/widgets/eye-footer-top-areas.php');
//include_once (TEMPLATEPATH . '/widgets/eye-footer-bottom-areas.php');

add_action("widgets_init", "load_my_widgets");

function load_my_widgets() {
	
	register_widget("EYE_HeaderMiddleWidget");
	register_widget("EYE_HeaderRightWidget");
	register_widget("EYE_CLogoWidget");
	register_widget("EYE_ProfileWidget");
	register_widget("EYE_PracticeWidget");
	register_widget("EYE_FooterTopWidget");
	//register_widget("EYE_FooterBottomWidget");
	
}
?>