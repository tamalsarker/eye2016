<?php
/**
 * @package 	WordPress
 * @subpackage 	Business
 * @version 	1.0.0
 * 
 * Custom Theme Widgets
 * Created by TemplateEYE
 * 
 */
class EYE_ProfileWidget extends WP_Widget {
    /** constructor */
    function EYE_ProfileWidget() {
        parent::WP_Widget(false, $name = 'Home - Profile');	
    }
	/** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
				$text = apply_filters('widget_txt1', $instance['text']);
				$image_uri = apply_filters('widget_txt', $instance['image_uri']);
				$txt4 = apply_filters('widget_txt3', $instance['txt4']);
				$txt5 = apply_filters('widget_txt3', $instance['txt5']);
				$image_uri2 = apply_filters('widget_txt2', $instance['image_uri2']);
				$txt6 = apply_filters('widget_txt3', $instance['txt6']);
				$txt7 = apply_filters('widget_txt3', $instance['txt7']);
				$image_uri3 = apply_filters('widget_txt3', $instance['image_uri3']);
				$txt8 = apply_filters('widget_txt3', $instance['txt8']);
				$txt9 = apply_filters('widget_txt3', $instance['txt9']);
				
				$image_uri4 = apply_filters('widget_txt4', $instance['image_uri4']);
				$txt10 = apply_filters('widget_txt4', $instance['txt10']);
				$txt11 = apply_filters('widget_txt4', $instance['txt11']);
				
				$image_uri5 = apply_filters('widget_txt5', $instance['image_uri5']);
				$txt12 = apply_filters('widget_txt5', $instance['txt12']);
				$txt13 = apply_filters('widget_txt5', $instance['txt13']);
        ?>   
              <?php echo $before_widget; ?>
                
                <?php if($txt4!=""){ ?> 
              	<div class="row">
                    <div class="col-md-5ths col-sm-4">
                    	<a href="<?php echo $txt5; ?>">
                        <span class="profile-pic">
                            <span class="thumbnail-profile">
                            	<?php if($image_uri=""){ echo 'No Image';} else { ?>
                                <img src="<?php echo esc_url($instance['image_uri']); ?>" alt="<?php echo $txt4; ?>" /><?php } ?>
                            </span>
                            <span><?php echo $txt4; ?></span>
                        </span>
                        </a>
                    </div><!--/1col -->
                    <?php } ?>
                    
					<?php if($txt6!=""){ ?>
                    <div class="col-md-5ths col-sm-4">
                    	<a href="<?php echo $txt7; ?>">
                        <span class="profile-pic">
                            <span class="thumbnail-profile">
                            	<?php if($image_uri2=""){ echo 'No Image';} else { ?>
                                <img src="<?php echo esc_url($instance['image_uri2']); ?>" alt="<?php echo $txt6; ?>" /><?php } ?>
                            </span>
                            <span><?php echo $txt6; ?></span>
                        </span>
                        </a>
                    </div><!--/2col -->
                    <?php } ?>
                    
                    <?php if($txt8!=""){ ?>
                    <div class="col-md-5ths col-sm-4">
                    	<a href="<?php echo $txt9; ?>">
                        <span class="profile-pic">
                            <span class="thumbnail-profile">
                            	<?php if($image_uri3=""){ echo 'No Image';} else { ?>
                                <img src="<?php echo esc_url($instance['image_uri3']); ?>" alt="<?php echo $txt8; ?>" /><?php } ?>
                            </span>
							<span><?php echo $txt8; ?></span>
                        </span>
                        </a>
                    </div><!--/3col -->
                    <?php } ?>
                    
					<?php if($txt10!=""){ ?>
                    <div class="col-md-5ths col-sm-4">
                    	<a href="<?php echo $txt11; ?>">
                        <span class="profile-pic">
                            <span class="thumbnail-profile">
                            	<?php if($image_uri4=""){ echo 'No Image';} else { ?>
                                <img src="<?php echo esc_url($instance['image_uri4']); ?>" alt="<?php echo $txt10; ?>" /><?php } ?>
                            </span>
                            <span><?php echo $txt10; ?></span>
                        </span>
                        </a>
                    </div><!--/4col -->
                    <?php } ?>
                    
                    <?php if($txt12!=""){ ?>
                    <div class="col-md-5ths col-sm-4">
                    	<a href="<?php echo $txt13; ?>">
                        <span class="profile-pic">
                            <span class="thumbnail-profile">
                            	<?php if($image_uri5=""){ echo 'No Image';} else { ?>
                                <img src="<?php echo esc_url($instance['image_uri5']); ?>" alt="<?php echo $txt12; ?>" /><?php } ?>
                            </span>
                            <span><?php echo $txt12; ?></span>
                        </span>
                        </a>
                    </div><!--/5col -->
                    <?php } ?>
                       
                </div><!--/row -->
             
              <?php echo $after_widget; ?>
        <?php
    }
    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {				
        return $new_instance;
    }
    /** @see WP_Widget::form */
    function form($instance) {				
        $title = esc_attr($instance['title']);
				$text = esc_attr($instance['text']);
				$image_uri = esc_attr($instance['image_uri']); 
				$txt4 = esc_attr($instance['txt4']);
				$txt5 = esc_attr($instance['txt5']);
				$image_uri2 = esc_attr($instance['image_uri2']);
				$txt6 = esc_attr($instance['txt6']);
				$txt7 = esc_attr($instance['txt7']); 
				$image_uri3 = esc_attr($instance['image_uri3']);
				$txt8 = esc_attr($instance['txt8']);
				$txt9 = esc_attr($instance['txt9']); 
				$image_uri4 = esc_attr($instance['image_uri4']);
				$txt10 = esc_attr($instance['txt10']);
				$txt11 = esc_attr($instance['txt11']); 
				$image_uri5 = esc_attr($instance['image_uri5']);
				$txt12 = esc_attr($instance['txt12']);
				$txt13 = esc_attr($instance['txt13']); 
				$i = rand(1,999);
				$i2 = rand(1,999);
				$i3 = rand(1,999);
				$i4 = rand(1,999);
				$i5 = rand(1,999);
        ?>  

<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
        
<!-- Image 1 -->
<fieldset style="border:1px solid #dfdfdf; padding:5px; margin-bottom:1em;">
<legend style="padding:0 5px;"><?php _e('Profile - 1'); ?>:</legend>
<table cellpadding="5" cellspacing="0" width="100%">
    <tr>
        <td colspan="2">
            <input id="<?php echo $this->get_field_id('txt4'); ?>" class="widefat" placeholder="Name"
            name="<?php echo $this->get_field_name('txt4'); ?>" type="text" value="<?php echo $txt4; ?>" />
        </td>
    </tr>
    <tr>
        <td>
            <img style="padding:3px; border:1px solid #ddd; max-height:80px; max-width:120px;" class="custom_media_image<?php echo $i; ?>" 
            src="<?php if(!empty($instance['image_uri'])){echo $instance['image_uri'];} else { echo bloginfo('template_url').'/inc/widgets/no-image.gif';} ?>" />
        </td>
        <td>
            <input type="hidden" class="widefat custom_media_url<?php echo $i; ?>" name="<?php echo $this->get_field_name('image_uri'); 
			echo $i; ?>" id="<?php echo $this->get_field_id('image_uri'); echo $i; ?>" value="<?php echo $instance['image_uri']; ?>">
    		<input type="button" value="<?php _e( 'Upload', 'themename' ); ?>" class="button custom_media_upload<?php echo $i; ?>" />
        </td>
    </tr>
	<tr>
    	<td colspan="2">
        	<input type="text"  placeholder="http://" class="widefat" id="<?php echo $this->get_field_id('txt5'); ?>" 
            name="<?php echo $this->get_field_name('txt5'); ?>" value="<?php echo $txt5; ?>" />
        </td>
    </tr> 
</table>
</fieldset>

<!-- Image 2 -->
<fieldset style="border:1px solid #dfdfdf; padding:5px; margin-bottom:1em;">
<legend style="padding:0 5px;"><?php _e('Profile - 2'); ?>:</legend>
<table cellpadding="5" cellspacing="0" width="100%">
    <tr>
        <td colspan="2">
            <input id="<?php echo $this->get_field_id('txt6'); ?>" class="widefat" placeholder="Name"
            name="<?php echo $this->get_field_name('txt6'); ?>" type="text" value="<?php echo $txt6; ?>" />
        </td>
    </tr>
    <tr>
        <td>
            <img style="padding:3px; border:1px solid #ddd; max-height:80px;" class="custom_media_image<?php echo $i2; ?>" 
            src="<?php if(!empty($instance['image_uri2'])){echo $instance['image_uri2'];} else { echo bloginfo('template_url').'/inc/widgets/no-image.gif';} ?>" />
        </td>
        <td>
            <input type="hidden" class="widefat custom_media_url<?php echo $i2; ?>" name="<?php echo $this->get_field_name('image_uri2'); 
			echo $i; ?>" id="<?php echo $this->get_field_id('image_uri2'); echo $i2; ?>" value="<?php echo $instance['image_uri2']; ?>">
    		<input type="button" value="<?php _e( 'Upload', 'themename' ); ?>" class="button custom_media_upload<?php echo $i2; ?>" />
        </td>
    </tr>
	<tr>
    	<td colspan="2">
        	<input type="text"  placeholder="http://" class="widefat" id="<?php echo $this->get_field_id('txt7'); ?>" 
            name="<?php echo $this->get_field_name('txt7'); ?>" value="<?php echo $txt7; ?>" />
        </td>
    </tr> 
</table>
</fieldset>

<!-- Image 3 -->
<fieldset style="border:1px solid #dfdfdf; padding:5px; margin-bottom:1em;">
<legend style="padding:0 5px;"><?php _e('Profile - 3'); ?>:</legend>
<table cellpadding="5" cellspacing="0" width="100%">
    <tr>
        <td colspan="2">
            <input id="<?php echo $this->get_field_id('txt8'); ?>" class="widefat" placeholder="Name"
            name="<?php echo $this->get_field_name('txt8'); ?>" type="text" value="<?php echo $txt8; ?>" />
        </td>
    </tr>
    <tr>
        <td>
            <img style="padding:3px; border:1px solid #ddd; max-height:80px;" class="custom_media_image<?php echo $i3; ?>" 
            src="<?php if(!empty($instance['image_uri3'])){echo $instance['image_uri3'];} else { echo bloginfo('template_url').'/inc/widgets/no-image.gif';} ?>" />
        </td>
        <td>
            <input type="hidden" class="widefat custom_media_url<?php echo $i3; ?>" name="<?php echo $this->get_field_name('image_uri3'); 
			echo $i3; ?>" id="<?php echo $this->get_field_id('image_uri3'); echo $i3; ?>" value="<?php echo $instance['image_uri3']; ?>">
    		<input type="button" value="<?php _e( 'Upload', 'themename' ); ?>" class="button custom_media_upload<?php echo $i3; ?>" />
        </td>
    </tr>
	<tr>
    	<td colspan="2">
        	<input type="text"  placeholder="http://" class="widefat" id="<?php echo $this->get_field_id('txt9'); ?>" 
            name="<?php echo $this->get_field_name('txt9'); ?>" value="<?php echo $txt9; ?>" />
        </td>
    </tr> 
</table>
</fieldset>

<!-- Image 4 -->
<fieldset style="border:1px solid #dfdfdf; padding:5px; margin-bottom:1em;">
<legend style="padding:0 5px;"><?php _e('Profile - 4'); ?>:</legend>
<table cellpadding="5" cellspacing="0" width="100%">
    <tr>
        <td colspan="2">
            <input id="<?php echo $this->get_field_id('txt10'); ?>" class="widefat" placeholder="Name"
            name="<?php echo $this->get_field_name('txt10'); ?>" type="text" value="<?php echo $txt10; ?>" />
        </td>
    </tr>
    <tr>
        <td>
            <img style="padding:3px; border:1px solid #ddd; max-height:80px;" class="custom_media_image<?php echo $i4; ?>" 
            src="<?php if(!empty($instance['image_uri4'])){echo $instance['image_uri4'];} else { echo bloginfo('template_url').'/inc/widgets/no-image.gif';} ?>" />
        </td>
        <td>
            <input type="hidden" class="widefat custom_media_url<?php echo $i4; ?>" name="<?php echo $this->get_field_name('image_uri4'); 
			echo $i4; ?>" id="<?php echo $this->get_field_id('image_uri4'); echo $i4; ?>" value="<?php echo $instance['image_uri4']; ?>">
    		<input type="button" value="<?php _e( 'Upload', 'themename' ); ?>" class="button custom_media_upload<?php echo $i4; ?>" />
        </td>
    </tr>
	<tr>
    	<td colspan="2">
        	<input type="text"  placeholder="http://" class="widefat" id="<?php echo $this->get_field_id('txt11'); ?>" 
            name="<?php echo $this->get_field_name('txt11'); ?>" value="<?php echo $txt11; ?>" />
        </td>
    </tr> 
</table>
</fieldset>

<!-- Image 5 -->
<fieldset style="border:1px solid #dfdfdf; padding:5px; margin-bottom:1em;">
<legend style="padding:0 5px;"><?php _e('Profile - 5'); ?>:</legend>
<table cellpadding="5" cellspacing="0" width="100%">
    <tr>
        <td colspan="2">
            <input id="<?php echo $this->get_field_id('txt12'); ?>" class="widefat" placeholder="Name"
            name="<?php echo $this->get_field_name('txt12'); ?>" type="text" value="<?php echo $txt12; ?>" />
        </td>
    </tr>
    <tr>
        <td>
            <img style="padding:3px; border:1px solid #ddd; max-height:80px;" class="custom_media_image<?php echo $i5; ?>" 
            src="<?php if(!empty($instance['image_uri5'])){echo $instance['image_uri5'];} else { echo bloginfo('template_url').'/inc/widgets/no-image.gif';} ?>" />
        </td>
        <td>
            <input type="hidden" class="widefat custom_media_url<?php echo $i5; ?>" name="<?php echo $this->get_field_name('image_uri5'); 
			echo $i5; ?>" id="<?php echo $this->get_field_id('image_uri5'); echo $i5; ?>" value="<?php echo $instance['image_uri5']; ?>">
    		<input type="button" value="<?php _e( 'Upload Image', 'themename' ); ?>" class="button custom_media_upload<?php echo $i5; ?>" />
        </td>
    </tr>
	<tr>
    	<td colspan="2">
        	<input type="text"  placeholder="http://" class="widefat" id="<?php echo $this->get_field_id('txt13'); ?>" 
            name="<?php echo $this->get_field_name('txt13'); ?>" value="<?php echo $txt13; ?>" />
        </td>
    </tr> 
</table>
</fieldset>


<script>

jQuery(function($){
	
	jQuery('.custom_media_upload<?php echo $i; ?>').live('click', function(e){
        e.preventDefault();
        var custom_uploader = wp.media({
            title: 'Service Product Item',
            button: {
                text: 'Insert',
            },
            multiple: false  // Set this to true to allow multiple files to be selected
        })
        .on('select', function() {
            var attachment = custom_uploader.state().get('selection').first().toJSON();
            $('.custom_media_image<?php echo $i; ?>').attr('src', attachment.url);
            $('.custom_media_url<?php echo $i; ?>').val(attachment.url);
            $('.custom_media_id<?php echo $i; ?>').val(attachment.id);
        })
        .open();
		remove();
    });
});

jQuery(function($){
	jQuery('.custom_media_upload<?php echo $i2; ?>').live('click', function(e){
        e.preventDefault();
        var custom_uploader = wp.media({
            title: 'Service Product Item',
            button: {
                text: 'Insert',
            },
            multiple: false  // Set this to true to allow multiple files to be selected
        })
        .on('select', function() {
            var attachment = custom_uploader.state().get('selection').first().toJSON();
            $('.custom_media_image<?php echo $i2; ?>').attr('src', attachment.url);
            $('.custom_media_url<?php echo $i2; ?>').val(attachment.url);
            $('.custom_media_id<?php echo $i2; ?>').val(attachment.id);
        })
        .open();
		remove();
    });
});

jQuery(function($){
	jQuery('.custom_media_upload<?php echo $i3; ?>').live('click', function(e){
        e.preventDefault();
        var custom_uploader = wp.media({
            title: 'Service Product Item',
            button: {
                text: 'Insert',
            },
            multiple: false  // Set this to true to allow multiple files to be selected
        })
        .on('select', function() {
            var attachment = custom_uploader.state().get('selection').first().toJSON();
            $('.custom_media_image<?php echo $i3; ?>').attr('src', attachment.url);
            $('.custom_media_url<?php echo $i3; ?>').val(attachment.url);
            $('.custom_media_id<?php echo $i3; ?>').val(attachment.id);
        })
        .open();
		remove();
    });
});

jQuery(function($){
	jQuery('.custom_media_upload<?php echo $i4; ?>').live('click', function(e){
        e.preventDefault();
        var custom_uploader = wp.media({
            title: 'Service Product Item',
            button: {
                text: 'Insert',
            },
            multiple: false  // Set this to true to allow multiple files to be selected
        })
        .on('select', function() {
            var attachment = custom_uploader.state().get('selection').first().toJSON();
            $('.custom_media_image<?php echo $i4; ?>').attr('src', attachment.url);
            $('.custom_media_url<?php echo $i4; ?>').val(attachment.url);
            $('.custom_media_id<?php echo $i4; ?>').val(attachment.id);
        })
        .open();
		remove();
    });
});

jQuery(function($){
	jQuery('.custom_media_upload<?php echo $i5; ?>').live('click', function(e){
        e.preventDefault();
        var custom_uploader = wp.media({
            title: 'Service Product Item',
            button: {
                text: 'Insert',
            },
            multiple: false  // Set this to true to allow multiple files to be selected
        })
        .on('select', function() {
            var attachment = custom_uploader.state().get('selection').first().toJSON();
            $('.custom_media_image<?php echo $i5; ?>').attr('src', attachment.url);
            $('.custom_media_url<?php echo $i5; ?>').val(attachment.url);
            $('.custom_media_id<?php echo $i5; ?>').val(attachment.id);
        })
        .open();
		remove();
    });
});
</script>

        <?php 
    }

} // class Products Widget

?>