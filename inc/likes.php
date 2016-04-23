<?php
/**
 * @package 	WordPress
 * @subpackage 	Business
 * @version		1.0.0
 * 
 * Likes Functions
 * Changed by TemplateEYE
 * 
 */


function eyeLike($show = true) {
	$post_ID = get_the_ID();
	
	
	$ip = $_SERVER['REMOTE_ADDR'];
	
	
	$likes = (get_post_meta($post_ID, 'eye_likes', true) != '') ? get_post_meta($post_ID, 'eye_likes', true) : '0';
	
	
	$ipCheck = get_posts(array( 
		'post_type' => 		'eye_like', 
		'post_status' => 	'draft', 
		'post_parent' => 	$post_ID, 
		'post_title' => 	$ip 
	));
	
	
	if (isset($_COOKIE['like-' . $post_ID]) || count($ipCheck) != 0) {
		$counter = '<a href="#" onclick="return false;" id="eyeLike-' . $post_ID . '" class="eyeLike active glyphicon glyphicon-heart"><span>' . $likes . '</span></a>';
	} else {
		$counter = '<a href="#" onclick="eyeLike(' . $post_ID . '); return false;" id="eyeLike-' . $post_ID . '" class="eyeLike glyphicon glyphicon-heart"><span>' . $likes . '</span></a>';
	}
	
	
	if ($show != true) {
		return $counter;
	} else {
		echo $counter;
	}
}

