<?php
/**
 * @package 	WordPress
 * @subpackage 	Business
 * @version		1.0.0
 * 
 * Breadcrumbs Function
 * Created by TemplateEYE
 * 
 */
 
function breadcrumbs() {
	global $post;	
	
	$homeLink = home_url();
	$homeText = esc_attr__('Home', 'templateeye');
	$sep = '';
	$maxLength = 30;
	
	$year_format = get_the_time('Y');
	$month_format = get_the_time('F');
	$day_format = get_the_time('d');
	$day_full_format = get_the_time('l');
	
	$url_year = get_year_link($year_format);
	$url_month = get_month_link($year_format, $month_format);
	
	echo '<li><a href="' . esc_url($homeLink) . '" class="cms_home">' . $homeText . '</a></li>' . $sep;
	
	if (is_single()) {
		$category = get_the_category();
		
		$num_cat = count($category);
		
		if ($num_cat < 1) {
			echo '<li>' . eye_title(get_the_ID(), false) . '</li>';
		} else if ($num_cat >= 1) {
			echo get_category_parents($category[0], true, $sep) . ' ' . '<li>' . eye_title(get_the_ID(), false) . '</li>';
		}
	} elseif (is_category()) {
		global $cat;
				
		$multiple_cats = get_category_parents($cat, true, $sep);		
		$multiple_cats_array = explode($sep, $multiple_cats);		
		$multiple_cats_num = count($multiple_cats_array);
			
		$i = 2;
		
		foreach ($multiple_cats_array as $single_cat) {
			echo $single_cat;
			
			if ($i < $multiple_cats_num) {
				echo $sep;
			}
			
			$i++;
		}
	} elseif (is_tag()) {
		echo single_tag_title('', false);
	} elseif (is_day()) {
		echo '<a href="' . esc_url($url_year) . '">' . $year_format . '</a>' . 
			$sep . 
			'<a href="' . esc_url($url_month) . '">' . $month_format . '</a>' . 
			$sep . 
			$day_format . ' (' . $day_full_format . ')';
	} elseif (is_month()) {
		echo '<a href="' . esc_url($url_year) . '">' . $year_format . '</a>' . $sep . $month_format;
	} elseif (is_year()) {
		echo $year_format;
	} elseif (is_search()) {
		echo '<li>' . esc_html__('Search Results for', 'templateeye') . "</li>: '" . get_search_query() . "'";
	} elseif (is_page() && !$post->post_parent) {
		echo '<li>' . eye_title(get_the_ID(), false) . '</li>';
	} elseif (is_page() && $post->post_parent) {
		$post_array = get_post_ancestors($post);
		
		krsort($post_array);
		
		foreach ($post_array as $key => $postid) {
			$post_ids = get_post($postid);
			
			$title = $post_ids->post_title;
			
			echo '<a href="' . esc_url(get_permalink($post_ids)) . '">' . $title . '</a>' . $sep;
		}

		echo '<li>' . eye_title(get_the_ID(), false) . '</li>';
	} elseif (is_author()) {
		global $author;

		$user_info = get_userdata($author);

		echo $user_info->display_name;
	} else if (is_tax()) {
		$tax_cat = get_queried_object();
		
		echo '<li>' . $tax_cat->name . '</li>';
	} else {
		echo '<li>' . esc_html__('No Breadcrumbs', 'templateeye') . '</li>';
	}
}

