<?php 
/**
 * @package 	WordPress
 * @subpackage 	Business
 * @version		1.0.0
 * 
 * Likes Post Type
 * Changed by TemplateEYE
 * 
 */


class Eye_Likes {
	function Eye_Likes() { 
		$like_labels = array( 
			'name' => __('Likes', 'eye_content_composer'), 
			'singular_name' => __('Like', 'eye_content_composer') 
		);
		
		
		$like_args = array( 
			'labels' => $like_labels, 
			'public' => false, 
			'capability_type' => 'post', 
			'hierarchical' => false, 
			'exclude_from_search' => true, 
			'publicly_queryable' => false, 
			'show_ui' => false, 
			'show_in_nav_menus' => false 
		);
		
		
		register_post_type('eye_like', $like_args);
	}
}


function eye_likes_init() {
	global $lk;
	
	
	$lk = new Eye_Likes();
}


add_action('init', 'eye_likes_init');

