<?php
////////////////////////////
// Custom Post Type Setup
////////////////////////////
add_action( 'init', 'bs_post_type' );
function bs_post_type() {
	$labels = array(
		'name' => __('Carousel Images', 'bootstrap-carousel'),
		'singular_name' => __('Carousel Image', 'bootstrap-carousel'),
		'add_new' => __('Add New', 'bootstrap-carousel'),
		'add_new_item' => __('Add New Carousel Image', 'bootstrap-carousel'),
		'edit_item' => __('Edit Carousel Image', 'bootstrap-carousel'),
		'new_item' => __('New Carousel Image', 'bootstrap-carousel'),
		'view_item' => __('View Carousel Image', 'bootstrap-carousel'),
		'search_items' => __('Search Carousel Images', 'bootstrap-carousel'),
		'not_found' => __('No Carousel Image', 'bootstrap-carousel'),
		'not_found_in_trash' => __('No Carousel Images found in Trash', 'bootstrap-carousel'),
		'parent_item_colon' => '',
		'menu_name' => __('BS Slider', 'bootstrap-carousel')
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'exclude_from_search' => true,
		'publicly_queryable' => false,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'page',
		'has_archive' => true, 
		'hierarchical' => false,
		'menu_position' => 21,
		'supports' => array('title','editor','thumbnail', 'page-attributes')
	); 
	register_post_type('bs', $args);
}
// Create a taxonomy for the carousel post type
function bs_taxonomies () {
	$args = array('hierarchical' => true);
	register_taxonomy( 'carousel_category', 'bs', $args );
}
add_action( 'init', 'bs_taxonomies', 0 );

// Add theme support for featured images if not already present
// http://wordpress.stackexchange.com/questions/23839/using-add-theme-support-inside-a-plugin
function bs_addFeaturedImageSupport() {
	$supportedTypes = get_theme_support( 'post-thumbnails' );
	if( $supportedTypes === false ) {
		add_theme_support( 'post-thumbnails', array( 'bs' ) );      
		add_image_size('featured_preview', 100, 55, true);
	} elseif( is_array( $supportedTypes ) ) {
		$supportedTypes[0][] = 'bs';
		add_theme_support( 'post-thumbnails', $supportedTypes[0] );
		add_image_size('featured_preview', 100, 55, true);
	}
}
add_action( 'after_setup_theme', 'bs_addFeaturedImageSupport');

// Add column in admin list view to show featured image
// http://wp.tutsplus.com/tutorials/creative-coding/add-a-custom-column-in-posts-and-custom-post-types-admin-screen/
function bs_get_featured_image($post_ID) {  
	$post_thumbnail_id = get_post_thumbnail_id($post_ID);  
	if ($post_thumbnail_id) {  
		$post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'featured_preview');  
		return $post_thumbnail_img[0];  
	}  
}
function bs_columns_head($defaults) {  
	$defaults['featured_image'] = __('Featured Image', 'bootstrap-carousel');  
	$defaults['category'] = __('Category', 'bootstrap-carousel');  
	return $defaults;  
}  
function bs_columns_content($column_name, $post_ID) {  
	if ($column_name == 'featured_image') {  
		$post_featured_image = bs_get_featured_image($post_ID);  
		if ($post_featured_image) {  
			echo '<a href="'.get_edit_post_link($post_ID).'"><img src="' . $post_featured_image . '" alt="" style="max-width:100%;" /></a>';  
		}  
	}
	if ($column_name == 'category') {  
		$post_categories = get_the_terms($post_ID, 'carousel_category');
		if ($post_categories) {
			$output = '';
			foreach($post_categories as $cat){
				$output .= $cat->name.', ';
			}
			echo trim($output, ', ');
		} else {
			echo 'No categories';
		}
	}
}
add_filter('manage_bs_posts_columns', 'bs_columns_head');  
add_action('manage_bs_posts_custom_column', 'bs_columns_content', 10, 2);

// Extra admin field for image URL
function bs_image_url(){
	global $post;
	$custom = get_post_custom($post->ID);
	$bs_image_url = isset($custom['bs_image_url']) ?  $custom['bs_image_url'][0] : '';
	$bs_image_url_openblank = isset($custom['bs_image_url_openblank']) ?  $custom['bs_image_url_openblank'][0] : '0';
	?>
	<label><?php _e('Image URL', 'bootstrap-carousel'); ?>:</label>
	<input style="border:1px solid #ddd; width:100%" name="bs_image_url" value="<?php echo $bs_image_url; ?>" /> <br />
	<small><em><?php _e('(optional - leave blank for no link)', 'bootstrap-carousel'); ?></em></small><br /><br />
	<label><input type="checkbox" name="bs_image_url_openblank" <?php if($bs_image_url_openblank == 1){ echo ' checked="checked"'; } ?> value="1" /> <?php _e('Open link in new window?', 'bootstrap-carousel'); ?></label>
	<?php
}
function bs_admin_init_custpost(){
	add_meta_box("bs_image_url", "Image Link URL", "bs_image_url", "bs", "side", "low");
}
add_action("add_meta_boxes", "bs_admin_init_custpost");
function bs_mb_save_details(){
	global $post;
	if (isset($_POST["bs_image_url"])) {
		$openblank = 0;
		if(isset($_POST["bs_image_url_openblank"]) && $_POST["bs_image_url_openblank"] == '1'){
			$openblank = 1;
		}
		update_post_meta($post->ID, "bs_image_url", esc_url($_POST["bs_image_url"]));
		update_post_meta($post->ID, "bs_image_url_openblank", $openblank);
	}
}
add_action('save_post', 'bs_mb_save_details');

// Set up settings defaults
register_activation_hook(__FILE__, 'bs_set_options');
function bs_set_options (){
	$defaults = array(
		'interval' => '5000',
		'showcaption' => 'true',
		'showcontrols' => 'true',
		'customprev' => '',
		'customnext' => '',
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'category' => '',
		'id' => '',
		'twbs' => '3'
	);
	add_option('bs_settings', $defaults);
}
// Clean up on uninstall
register_activation_hook(__FILE__, 'bs_deactivate');
function bs_deactivate(){
	delete_option('bs_settings');
}


///////////////////
// SETTINGS PAGE
///////////////////
class bs_settings_page {
	// Holds the values to be used in the fields callbacks
	private $options;
			
	// Start up
	public function __construct() {
			add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
			add_action( 'admin_init', array( $this, 'page_init' ) );
	}
			
	// Add settings page
	public function add_plugin_page() {
		add_submenu_page('edit.php?post_type=bs', __('Settings', 'bootstrap-carousel'), __('Settings', 'bootstrap-carousel'), 'manage_options', 'bootstrap-carousel', array($this,'create_admin_page'));
	}
			
	// Options page callback
	public function create_admin_page() {
			// Set class property
			$this->options = get_option( 'bs_settings' );
		if(!$this->options){
			bs_set_options ();
			$this->options = get_option( 'bs_settings' );
		}
			?>
			<div class="wrap">
			<?php screen_icon('edit');?> <h2>Bootstrap Carousel <?php _e('Settings', 'bootstrap-carousel'); ?></h2>
					<form method="post" action="options.php">
					<?php
							settings_fields( 'bs_settings' );   
							do_settings_sections( 'bootstrap-carousel' );
							submit_button(); 
					?>
					</form>
<table cellpadding="10" cellspacing="1" border="0" bgcolor="#b5b8b9">
<tr>
	<th colspan="2"><font style="color:#fff; font-size:24px;">Shortcode Options</font></th>
</tr>
<tr bgcolor="#f7f5f5">
	<td>interval (default 5000)<br/>
Length of time for the caption to pause on each image. Time in milliseconds.</td>
	<td>[image-carousel interval="12000"]</td>
</tr>

<tr bgcolor="#f7f5f5">
	<td>showcaption (default true)<br/>
	Whether to display the text caption on each image or not. true or false.</td>
	<td>[image-carousel showcaption="false"]</td>
</tr>

<tr bgcolor="#f7f5f5">
	<td>showcontrols (default true)<br/>
	Whether to display the control arrows or not. true or false.</td>
	<td>[image-carousel showcontrols="false"]</td>
</tr>
<tr bgcolor="#f7f5f5">
<td>orderby and order (default menu_order ASC)<br/>
What order to display the posts in. Uses WP_Query terms.</td>
<td>[image-carousel orderby="rand"]<br/>
[image-carousel orderby="date" orderby="DESC"]</td>
</tr>
<tr bgcolor="#f7f5f5">
<td>category (default all)<br/>
Filter carousel items by a comma separated list of carousel category slugs.</td>
<td>[image-carousel category="homepage,highlights"]</td>
</tr>

<tr bgcolor="#f7f5f5">
<td>id (default all)<br/>
Specify the ID of a specific carousel post to display only one image.<br/>
Find the image ID by looking at the edit post link, eg. post 109 would be /wp-admin/post.php?post=109&action=edit
</td>
<td>[image-carousel id="109"]</td>

</tr>
<tr bgcolor="#f7f5f5">
	<td colspan="2">
    	<?php
		$cats = get_terms('carousel_category');
		foreach($cats as $cat){
			echo '<b>[image-carousel category="'. $cat->name .'"]</b><br/>';
		}
		?>
    </td>
</tr>
</table>
			</div>
			<?php
	}
			
	// Register and add settings
	public function page_init() {        
			register_setting(
					'bs_settings', // Option group
					'bs_settings', // Option name
					array( $this, 'sanitize' ) // Sanitize
			);
			
			add_settings_section(
					'bs_settings_options', // ID
					'', // Title - nothing to say here.
					array( $this, 'bs_settings_options_header' ), // Callback
					'bootstrap-carousel' // Page
			);  
			
			add_settings_field(
					'interval', // ID
					__('Slide Interval (milliseconds)', 'bootstrap-carousel'), // Title
					array( $this, 'interval_callback' ), // Callback
					'bootstrap-carousel', // Page
					'bs_settings_options' // Section
			);
		
			add_settings_field(
					'showcaption', // ID
					__('Show Slide Captions?', 'bootstrap-carousel'), // Title 
					array( $this, 'showcaption_callback' ), // Callback
					'bootstrap-carousel', // Page
					'bs_settings_options' // Section           
			);
		
			add_settings_field(
					'showcontrols', // ID
					__('Show Slide Controls?', 'bootstrap-carousel'), // Title 
					array( $this, 'showcontrols_callback' ), // Callback
					'bootstrap-carousel', // Page
					'bs_settings_options' // Section           
			);
			
			add_settings_field(
					'customprev', // ID
					__('Custom prev button class', 'bootstrap-carousel'), // Title
					array( $this, 'customprev_callback' ), // Callback
					'bootstrap-carousel', // Page
					'bs_settings_options' // Section
			);
			
			add_settings_field(
					'customnext', // ID
					__('Custom next button class', 'bootstrap-carousel'), // Title
					array( $this, 'customnext_callback' ), // Callback
					'bootstrap-carousel', // Page
					'bs_settings_options' // Section
			);
		
			add_settings_field(
					'orderby', // ID
					__('Order Slides By', 'bootstrap-carousel'), // Title 
					array( $this, 'orderby_callback' ), // Callback
					'bootstrap-carousel', // Page
					'bs_settings_options' // Section           
			);
		
			add_settings_field(
					'order', // ID
					__('Ordering Direction', 'bootstrap-carousel'), // Title 
					array( $this, 'order_callback' ), // Callback
					'bootstrap-carousel', // Page
					'bs_settings_options' // Section           
			);
		
			add_settings_field(
					'category', // ID
					__('Restrict to Category', 'bootstrap-carousel'), // Title 
					array( $this, 'category_callback' ), // Callback
					'bootstrap-carousel', // Page
					'bs_settings_options' // Section           
			);
			 
	}
			
	// Sanitize each setting field as needed -  @param array $input Contains all settings fields as array keys
	public function sanitize( $input ) {
			$new_input = array();
		foreach($input as $key => $var){
			if($key == 'twbs' || $key == 'interval'){
				$new_input[$key] = absint( $input[$key] );
				if($key == 'interval' && $new_input[$key] == 0){
					$new_input[$key] = 5000;
				}
			} else {
				$new_input[$key] = sanitize_text_field( $input[$key] );
			}
		}
			return $new_input;
	}
			
	// Print the Section text
	public function bs_settings_options_header() {
			// nothing to say here.x
	}

	public function interval_callback() {
			printf('<input type="text" id="interval" name="bs_settings[interval]" value="%s" size="6" />',
					isset( $this->options['interval'] ) ? esc_attr( $this->options['interval']) : '');
	}
	
	public function showcaption_callback() {
		if(isset( $this->options['showcaption'] ) && $this->options['showcaption'] == 'false'){
			$bs_showcaption_t = '';
			$bs_showcaption_f = ' selected="selected"';
		} else {
			$bs_showcaption_t = ' selected="selected"';
			$bs_showcaption_f = '';
		}
		print '<select id="showcaption" name="bs_settings[showcaption]">
			<option value="true"'.$bs_showcaption_t.'>'.__('Show', 'bootstrap-carousel').'</option>
			<option value="false"'.$bs_showcaption_f.'>'.__('Hide', 'bootstrap-carousel').'</option>
		</select>';
	}
	
	public function showcontrols_callback() {
		if(isset( $this->options['showcontrols'] ) && $this->options['showcontrols'] == 'false'){
			$bs_showcontrols_t = '';
			$bs_showcontrols_f = ' selected="selected"';
			$bs_showcontrols_c = '';
		} else if(isset( $this->options['showcontrols'] ) && $this->options['showcontrols'] == 'true'){
			$bs_showcontrols_t = ' selected="selected"';
			$bs_showcontrols_f = '';
			$bs_showcontrols_c = '';
		} else if(isset( $this->options['showcontrols'] ) && $this->options['showcontrols'] == 'custom'){
			$bs_showcontrols_t = '';
			$bs_showcontrols_f = '';
			$bs_showcontrols_c = ' selected="selected"';
		}
		print '<select id="showcontrols" name="bs_settings[showcontrols]">
			<option value="true"'.$bs_showcontrols_t.'>'.__('Show', 'bootstrap-carousel').'</option>
			<option value="false"'.$bs_showcontrols_f.'>'.__('Hide', 'bootstrap-carousel').'</option>
			<option value="custom"'.$bs_showcontrols_c.'>'.__('Custom', 'bootstrap-carousel').'</option>
		</select>';
	}
	
	public function customnext_callback() {
			printf('<input type="text" id="customnext" name="bs_settings[customnext]" value="%s" size="12" />',
					isset( $this->options['customnext'] ) ? esc_attr( $this->options['customnext']) : '');
	}
	
	public function customprev_callback() {
			printf('<input type="text" id="customprev" name="bs_settings[customprev]" value="%s" size="12" />',
					isset( $this->options['customprev'] ) ? esc_attr( $this->options['customprev']) : '');
	}
	
	public function orderby_callback() {
		$orderby_options = array (
			'menu_order' => __('Menu order, as set in Carousel overview page', 'bootstrap-carousel'),
			'date' => __('Date slide was published', 'bootstrap-carousel'),
			'rand' => __('Random ordering', 'bootstrap-carousel'),
			'title' => __('Slide title', 'bootstrap-carousel')      
		);
		print '<select id="orderby" name="bs_settings[orderby]">';
		foreach($orderby_options as $val => $option){
			print '<option value="'.$val.'"';
			if(isset( $this->options['orderby'] ) && $this->options['orderby'] == $val){
				print ' selected="selected"';
			}
			print ">$option</option>";
		}
		print '</select>';
	}
	
	public function order_callback() {
		if(isset( $this->options['order'] ) && $this->options['order'] == 'DESC'){
			$bs_showcontrols_a = '';
			$bs_showcontrols_d = ' selected="selected"';
		} else {
			$bs_showcontrols_a = ' selected="selected"';
			$bs_showcontrols_d = '';
		}
		print '<select id="order" name="bs_settings[order]">
			<option value="ASC"'.$bs_showcontrols_a.'>'.__('Ascending', 'bootstrap-carousel').'</option>
			<option value="DESC"'.$bs_showcontrols_d.'>'.__('Decending', 'bootstrap-carousel').'</option>
		</select>';
	}
	
	public function category_callback() {
		$cats = get_terms('carousel_category');
		print '<select id="orderby" name="bs_settings[category]">
			<option value="">'.__('All Categories', 'bootstrap-carousel').'</option>';
		foreach($cats as $cat){
			print '<option value="'.$cat->name.'"';
			if(isset( $this->options['category'] ) && $this->options['category'] == $cat->name){
				print ' selected="selected"';
			}
			print ">".$cat->name."</option>";
		}
		print '</select>';
	}
			
	
}

if( is_admin() ){
		$bs_settings_page = new bs_settings_page();
}

// Add settings link on plugin page
function bs_settings_link ($links) { 
	$settings_link = '<a href="edit.php?post_type=bs&page=bootstrap-carousel">'.__('Settings', 'bootstrap-carousel').'</a>'; 
	array_unshift($links, $settings_link); 
	return $links; 
}
$bs_plugin = plugin_basename(__FILE__); 
add_filter("plugin_action_links_$bs_plugin", 'bs_settings_link' );



////////////////////////////////////////////////////////////////////
// CONTEXTUAL HELP
////////////////////////////////////////////////////////////////////
function bs_contextual_help_tab() {
	$help = '<p>You can add a <strong>Bootstrap Carousel</strong> image carousel using the shortcode <code>[image-carousel]</code>.</p>
		<p>You can read the full plugin documentation on the <a href="#" target="_blank">WordPress plugins page</a></p>
		<p>Most settings can be changed in the <a href="">settings page</a> but you can also specify options for individual carousels
		using the following settings:</p>
		
		<ul>
			<li><code>interval</code> <em>(default 5000)</em>
			<ul>
				<li>Length of time for the caption to pause on each image. Time in milliseconds.</li>
			</ul></li>
			
			<li><code>showcaption</code> <em>(default true)</em>
			<ul>
				<li>Whether to display the text caption on each image or not. true or false.</li>
			</ul></li>
			
			<li><code>showcontrols</code> <em>(default true)</em>
			<ul>
				<li>Whether to display the control arrows or not. true or false.</li>
			</ul></li>
			
			<li><code>orderby</code> and <code>order</code> <em>(default menu_order ASC)</em>
			<ul>
				<li>What order to display the posts in. Uses WP_Query terms.</li>
			</ul></li>
			
			<li><code>category</code> <em>(default all)</em>
			<ul>
				<li>Filter carousel items by a comma separated list of carousel category slugs.</li>
			</ul></li>
			
			<li><code>id</code> <em>(default all)</em>
			<ul>
				<li>Specify the ID of a specific carousel post to display only one image.</li>';
	if(isset($_GET['post'])){
		$help .= '<li>The ID of the post you\'re currently editing is <strong>'.$_GET['post'].'</strong></li>';
	}
	$help .= '
			</ul></li>
			
			<li><code>twbs</code> <em>(default 2)</em>
			<ul>
				<li>Output markup for Twitter Bootstrap Version 2 or 3.</li>
			</ul></li>
		</ul>
			';
	$screen = get_current_screen();
	$screen->add_help_tab( array(
	   'id' => 'bs_contextual_help',
	   'title' => __('Carousel'),
	   'content' => __($help)
	) );
}
add_action('load-post.php', 'bs_contextual_help_tab');
add_action('load-post-new.php', 'bs_contextual_help_tab');



///////////////////
// FRONT END
///////////////////

// Shortcode
function bs_shortcode($atts, $content = null) {
		// Set default shortcode attributes
	$options = get_option( 'bs_settings' );
	if(!$options){
		bs_set_options ();
		$options = get_option( 'bs_settings' );
	}
	$options['id'] = '';

	// Parse incomming $atts into an array and merge it with $defaults
	$atts = shortcode_atts($options, $atts);

	return bs_frontend($atts);
}
add_shortcode('image-carousel', 'bs_shortcode');

// Display carousel
function bs_frontend($atts){
	$id = rand(0, 999); // use a random ID so that the CSS IDs work with multiple on one page
	$args = array(
		'post_type' => 'bs',
		'posts_per_page' => '-1',
		'orderby' => $atts['orderby'],
		'order' => $atts['order']
	);
	if($atts['category'] != ''){
		$args['carousel_category'] = $atts['category'];
	}
	if($atts['id'] != ''){
		$args['p'] = $atts['id'];
	}
	$loop = new WP_Query( $args );
	$images = array();
	while ( $loop->have_posts() ) {
		$loop->the_post();
		if ( '' != get_the_post_thumbnail() ) {
			$post_id = get_the_ID();
			$title = get_the_title();
			$content = get_the_content();
			$image = get_the_post_thumbnail( get_the_ID(), 'full' );
			$url = get_post_meta(get_the_ID(), 'bs_image_url');
			$url_openblank = get_post_meta(get_the_ID(), 'bs_image_url_openblank');
			$images[] = array('post_id' => $post_id, 'title' => $title, 'content' => $content, 'image' => $image, 'url' => esc_url($url[0]), 'url_openblank' => $url_openblank[0] == "1" ? true : false);
		}
	}
	if(count($images) > 0){
		ob_start();
		?>
		<div id="bs_<?php echo $id; ?>" class="carousel slide" data-ride="carousel" data-interval="<?php echo $atts['interval']; ?>">
			<ol class="carousel-indicators">
			<?php foreach ($images as $key => $image) { ?>
				<li data-target="#bs_<?php echo $id; ?>" data-slide-to="<?php echo $key; ?>" <?php echo $key == 0 ? 'class="active"' : ''; ?>></li>
			<?php } ?>
			</ol>
			<div class="carousel-inner">
			<?php foreach ($images as $key => $image) {
				$linkstart = '';
				$linkend = '';
				if($image['url']) {
					$linkstart = '<a href="'.$image['url'].'"';
					if($image['url_openblank']) {
						$linkstart .= ' target="_blank"';
					}
					$linkstart .= '>';
					$linkend = '</a>';
				}
			?>
				<div class="item <?php echo $key == 0 ? 'active' : ''; ?>" id="<?php echo $image['post_id']; ?>">
					<?php echo $linkstart.$image['image'].$linkend; ?>
					<?php if($atts['showcaption'] === 'true' && strlen($image['title']) > 0 && strlen($image['content']) > 0) { ?>
						<div class="carousel-caption">
							<h4><?php echo $linkstart.$image['title'].$linkend; ?></h4>
							<p><?php echo $linkstart.$image['content'].$linkend; ?></p>
						</div>
					<?php } ?>
				</div>
			<?php } ?>
			</div>
			<?php if($atts['showcontrols'] === 'true') { ?>
				<a class="left carousel-control" href="#bs_<?php echo $id; ?>" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
				<a class="right carousel-control" href="#bs_<?php echo $id; ?>" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
			<?php }  else if($atts['showcontrols'] === 'custom' &&  $atts['customprev'] != '' &&  $atts['customnext'] != ''){ ?>
				<a class="left carousel-control" href="#bs_<?php echo $id; ?>" data-slide="prev"><span class="<?php echo $atts['customprev'] ?> icon-prev"></span></a>
				<a class="right carousel-control" href="#bs_<?php echo $id; ?>" data-slide="next"><span class="<?php echo $atts['customnext'] ?> icon-next"></span></a>
			<?php } ?>
		</div>
		<script type="text/javascript">
			jQuery(document).ready(function() {
				jQuery('#bs_<?php echo $id; ?>').carousel({
					interval: <?php echo $atts['interval']; ?>
				});
			});
		</script>
<?php }
	$output = ob_get_contents();
	ob_end_clean();
	
	// Restore original Post Data
	wp_reset_postdata();  
	
	return $output;
}

?>
