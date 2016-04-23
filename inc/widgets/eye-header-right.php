<?php
/**
 * @package 	WordPress
 * @subpackage 	bseye
 * @version 	1.0.0
 * 
 * Custom Theme Widgets
 * Created by TemplateEYE
 * 
 */
class EYE_HeaderRightWidget extends WP_Widget {
    /** constructor */
    function EYE_HeaderRightWidget() {
        parent::WP_Widget(false, $name = 'Header - Right');	
    }
	/** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
				$txt1 = apply_filters('widget_txt3', $instance['txt1']);
				$txt2 = apply_filters('widget_txt3', $instance['txt2']);
				$txt3 = apply_filters('widget_txt3', $instance['txt3']);
				$txt4 = apply_filters('widget_txt3', $instance['txt4']);
        ?>   
              <?php echo $before_widget; ?>                            
					<?php if($txt1!=""){ ?><span><?php echo $txt1; ?></span><?php } ?>
                    <?php if($txt2!=""){ ?><h2><?php echo $txt2; ?></h2><?php } ?>
                    <?php if($txt3!=""){ ?><a href="<?php echo $txt4; ?>"><?php echo $txt3; ?></a><?php } ?>            
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
				$txt1 = esc_attr($instance['txt1']);
				$txt2 = esc_attr($instance['txt2']);
				$txt3 = esc_attr($instance['txt3']);
				$txt4 = esc_attr($instance['txt4']); 
        ?>  
        <p><label for="<?php echo $this->get_field_id('txt1'); ?>"><?php _e('Small Text Top:', 'bseye'); ?><input class="widefat" id="<?php echo $this->get_field_id('txt1'); ?>" name="<?php echo $this->get_field_name('txt1'); ?>" type="text" value="<?php echo $txt1; ?>" /></label></p>
        <p><label for="<?php echo $this->get_field_id('txt2'); ?>"><?php _e('Phone No:', 'bseye'); ?><input class="widefat" id="<?php echo $this->get_field_id('txt2'); ?>" name="<?php echo $this->get_field_name('txt2'); ?>" type="text" value="<?php echo $txt2; ?>" /></label></p>
        <p><label for="<?php echo $this->get_field_id('txt3'); ?>"><?php _e('Small Text Bottom:', 'bseye'); ?> <input class="widefat" id="<?php echo $this->get_field_id('txt3'); ?>" name="<?php echo $this->get_field_name('txt3'); ?>" type="text" value="<?php echo $txt3; ?>" /></label></p>
        <p><label for="<?php echo $this->get_field_id('txt4'); ?>"><?php _e('Link:', 'bseye'); ?> <input class="widefat" id="<?php echo $this->get_field_id('txt4'); ?>" name="<?php echo $this->get_field_name('txt4'); ?>" type="text" value="<?php echo $txt4; ?>" /></label></p>
        <?php 
    }

} // class Header Middel Widget

?>