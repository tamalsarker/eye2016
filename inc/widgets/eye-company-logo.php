<?php
// =============================== My Products Widget ======================================
class EYE_CLogoWidget extends WP_Widget {
	
    /** constructor */
    function EYE_CLogoWidget() {
        parent::WP_Widget(false, $name = 'Company - Logo');	
    }
	
	/** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
				$text = apply_filters('widget_txt1', $instance['text']);
				$image_uri = apply_filters('widget_txt3', $instance['image_uri']);
        ?>
              
              <?php echo $before_widget; ?>
              		<?php if($image_uri=""){ echo 'No Image';} else { ?>
                        <?php if(!empty($text)){?><a target="_blank" rel="nofollow" href="<?php echo $text; ?>"><?php } ?>
                            <img src="<?php echo esc_url($instance['image_uri']); ?>" alt="<?php echo $title; ?>" />
                        <?php if(!empty($text)){?></a><?php } ?>
                    <?php } ?>
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
				$i = rand(1,999); //echo $i;
        ?>

<table cellpadding="5" cellspacing="0" width="100%">
    <tr>
        <td colspan="2">
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
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
        	<input type="text"  placeholder="http://" class="widefat" id="<?php echo $this->get_field_id('text'); ?>" 
            name="<?php echo $this->get_field_name('text'); ?>" value="<?php echo $text; ?>" />
        </td>
    </tr> 
</table>

<script>
jQuery(function($){
	jQuery('.custom_media_upload<?php echo $i; ?>').live('click', function(e){
        e.preventDefault();
        var custom_uploader = wp.media({
            title: 'Custom Title',
            button: {
                text: 'Custom Button Text',
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
</script>
        <?php 
    }

} // class Products Widget

?>