<?php
class EYE_FooterTopWidget extends WP_Widget {
    /** constructor */
    function EYE_FooterTopWidget() {
        parent::WP_Widget(false, $name = 'Footer - Top Areas');	
    }
	/** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
				$text = apply_filters('widget_txt1', $instance['text']);
				$txt4 = apply_filters('widget_txt3', $instance['txt4']);
				
				$txt5 = apply_filters('widget_txt3', $instance['txt5']);
				$txt6 = apply_filters('widget_txt3', $instance['txt6']);
				$txt7 = apply_filters('widget_txt3', $instance['txt7']);
				$txt8 = apply_filters('widget_txt3', $instance['txt8']);
				$txt9 = apply_filters('widget_txt3', $instance['txt9']);
				$txt10 = apply_filters('widget_txt4', $instance['txt10']);
				$txt11 = apply_filters('widget_txt4', $instance['txt11']);
				$txt12 = apply_filters('widget_txt12', $instance['txt12']);
				
				$image_uri = apply_filters('widget_txt', $instance['image_uri']);
				$image_uri2 = apply_filters('widget_txt2', $instance['image_uri2']);
				$image_uri3 = apply_filters('widget_txt3', $instance['image_uri3']);
				$image_uri4 = apply_filters('widget_txt4', $instance['image_uri4']);
				$image_uri5 = apply_filters('widget_txt5', $instance['image_uri5']);
				$image_uri6 = apply_filters('widget_txt6', $instance['image_uri6']);
				
				$txt13 = apply_filters('widget_txt13', $instance['txt13']);
				$txt14 = apply_filters('widget_txt14', $instance['txt14']);
				$txt15 = apply_filters('widget_txt15', $instance['txt15']);
				$txt16 = apply_filters('widget_txt16', $instance['txt16']);
				$txt17 = apply_filters('widget_txt17', $instance['txt17']);
				$txt18 = apply_filters('widget_txt18', $instance['txt18']);
        ?>   
              <?php echo $before_widget; ?>
                <div class="col-sm-6">
                    <?php if($txt4!=""){ ?><h3><?php echo $txt4; ?></h3><?php } ?>
                    <?php if($txt5!=""){ ?>
                    	<div class="text-justify">
                    		<?php echo $txt5; ?>
                        </div>
					<?php } ?>
                </div><!--.col -->
                <div class="col-sm-3 bdr-lft-rit">
                    <?php if($txt6!=""){ ?><h3><?php echo $txt6; ?></h3><?php } ?>
                    <div class="content">
                        <div class="demo">
                            <div class="scrollbar-inner">
                                 <?php echo $txt7; ?>
                            </div>
                        </div>
                     </div>
                </div><!--.col -->
                <div class="col-sm-3" style="padding-right:0;">
                    <?php if($txt8!=""){ ?><h3><?php echo $txt8; ?></h3><?php } ?>
                    <?php echo $txt9; ?>
                    <div class="row">
                        <div class="col-xs-8" style="padding-right:0;">
                            <span class="tel"><?php echo $txt10; ?></span>
                            <span class="fax"><?php echo $txt11; ?></span>
                        </div>
                        <div class="col-xs-4" style="padding:0 15px 0 2px;">
                            <a target="_blank" href="<?php echo $txt12; ?>"><img src="<?php bloginfo('template_url'); ?>/img/gmap.png" alt="Google Map" class="gmaplk" /></a>
                        </div>
                    </div>
                    <div class="socials">
                        <a rel="nofollow" class="fb ico" href="<?php echo $txt13; ?>"><em>Facebook</em></a>
                        <a rel="nofollow"  class="gp ico" href="<?php echo $txt14; ?>"><em>Google Plus</em></a>
                        <a rel="nofollow"  class="in ico" href="<?php echo $txt15; ?>"><em>Linked In</em></a>
                        <a rel="nofollow"  class="pi ico" href="<?php echo $txt16; ?>"><em>Yelp</em></a>
                        <a rel="nofollow"  class="so ico" href="<?php echo $txt17; ?>"><em>Avo Profile</em></a>
                    </div>
                </div><!--.col -->

             
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
				$txt4 = esc_attr($instance['txt4']);
				$txt5 = esc_attr($instance['txt5']);
				$txt6 = esc_attr($instance['txt6']);
				$txt7 = esc_attr($instance['txt7']); 
				$txt8 = esc_attr($instance['txt8']);
				$txt9 = esc_attr($instance['txt9']);
				$txt10 = esc_attr($instance['txt10']);
				$txt11 = esc_attr($instance['txt11']); 
				$txt12 = esc_attr($instance['txt12']); 
				 
				$image_uri = esc_attr($instance['image_uri']); 
				$image_uri2 = esc_attr($instance['image_uri2']);
				$image_uri3 = esc_attr($instance['image_uri3']);
				$image_uri4 = esc_attr($instance['image_uri4']);
				$image_uri5 = esc_attr($instance['image_uri5']);
				$image_uri6 = esc_attr($instance['image_uri6']);
				
				$txt13 = esc_attr($instance['txt13']); 
				$txt14 = esc_attr($instance['txt14']); 
				$txt15 = esc_attr($instance['txt15']); 
				$txt16 = esc_attr($instance['txt16']); 
				$txt17 = esc_attr($instance['txt17']); 
				$txt18 = esc_attr($instance['txt18']); 
				$i = rand(1,999);
				$i2 = rand(1,999);
				$i3 = rand(1,999);
				$i4 = rand(1,999);
				$i5 = rand(1,999);
				$i6 = rand(1,999);
        ?>         

<!-- Col 1 -->
<fieldset style="border:1px solid #dfdfdf; padding:5px; margin-bottom:1em;">
<legend style="padding:0 5px;"><?php _e('<h3>Col - 1 :</h3>'); ?></legend>
<table cellpadding="5" cellspacing="0" width="100%">
    <tr>
        <td colspan="2">
            <input id="<?php echo $this->get_field_id('txt4'); ?>" class="widefat" placeholder="Title 1"
            name="<?php echo $this->get_field_name('txt4'); ?>" type="text" value="<?php echo $txt4; ?>" />
        </td>
    </tr>  
	<tr>
    	<td colspan="2">
            <label for="<?php echo $this->get_field_id('txt5'); ?>"><?php _e(' Textarea:', 'ds'); ?><textarea rows="10"  class="widefat" id="<?php echo $this->get_field_id('txt5'); ?>" name="<?php echo $this->get_field_name('txt5'); ?>"><?php echo $txt5; ?></textarea></label>
        </td>
    </tr> 
</table>
</fieldset>

<!-- Col 2 -->
<fieldset style="border:1px solid #dfdfdf; padding:5px; margin-bottom:1em;">
<legend style="padding:0 5px;"><?php _e('<h3>Col - 2 :</h3>'); ?></legend>
<table cellpadding="5" cellspacing="0" width="100%">
    <tr>
        <td colspan="2">
            <input id="<?php echo $this->get_field_id('txt6'); ?>" class="widefat" placeholder="Title 2"
            name="<?php echo $this->get_field_name('txt6'); ?>" type="text" value="<?php echo $txt6; ?>" />
        </td>
    </tr>
    <tr>
    	<td colspan="2">
            <label for="<?php echo $this->get_field_id('txt7'); ?>"><?php _e(' Textarea:', 'ds'); ?><textarea rows="10"  class="widefat" id="<?php echo $this->get_field_id('txt7'); ?>" name="<?php echo $this->get_field_name('txt7'); ?>"><?php echo $txt7; ?></textarea></label>
        </td>
    </tr> 
</table>
</fieldset>

<!-- Col 3 -->
<fieldset style="border:1px solid #dfdfdf; padding:5px; margin-bottom:1em;">
<legend style="padding:0 5px;"><?php _e('<h3>Col - 3 :</h3>'); ?></legend>
<table cellpadding="5" cellspacing="0" width="100%">
    <tr>
        <td colspan="2">
            <input id="<?php echo $this->get_field_id('txt8'); ?>" class="widefat" placeholder="Title 3"
            name="<?php echo $this->get_field_name('txt8'); ?>" type="text" value="<?php echo $txt8; ?>" />
        </td>
    </tr>
	<tr>
    	<td colspan="2">
        	<label for="<?php echo $this->get_field_id('txt9'); ?>"><?php _e('Address:', 'ds'); ?><textarea rows="5"  class="widefat" id="<?php echo $this->get_field_id('txt9'); ?>" name="<?php echo $this->get_field_name('txt9'); ?>"><?php echo $txt9; ?></textarea></label>
        </td>
    </tr> 

    <tr>
        <td colspan="2">
            <input id="<?php echo $this->get_field_id('txt10'); ?>" class="widefat" placeholder="Tel:"
            name="<?php echo $this->get_field_name('txt10'); ?>" type="text" value="<?php echo $txt10; ?>" />
        </td>
    </tr>
    
    <tr>
        <td colspan="2">
            <input id="<?php echo $this->get_field_id('txt11'); ?>" class="widefat" placeholder="Fax:"
            name="<?php echo $this->get_field_name('txt11'); ?>" type="text" value="<?php echo $txt11; ?>" />
        </td>
    </tr>
    
    <tr>
    	<td colspan="2">
        	<label>Google Map Link</label>
        	<input type="text"  placeholder="http://" class="widefat" id="<?php echo $this->get_field_id('txt12'); ?>" 
            name="<?php echo $this->get_field_name('txt12'); ?>" value="<?php echo $txt12; ?>" />
        </td>
    </tr>
    <tr><td colspan="2"><h3><strong>Social Link</strong></h3></td></tr>
	<tr>
    	<td colspan="2">
        	<label>Facebook Link</label>
        	<input type="text"  placeholder="http://" class="widefat" id="<?php echo $this->get_field_id('txt13'); ?>" 
            name="<?php echo $this->get_field_name('txt13'); ?>" value="<?php echo $txt13; ?>" />
        </td>
    </tr> 
    
    <tr>
    	<td colspan="2">
        	<label>Google Plus Link</label>
        	<input type="text"  placeholder="http://" class="widefat" id="<?php echo $this->get_field_id('txt13'); ?>" 
            name="<?php echo $this->get_field_name('txt14'); ?>" value="<?php echo $txt13; ?>" />
        </td>
    </tr> 
    
    <tr>
    	<td colspan="2">
        	<label>Linkedin Link</label>
        	<input type="text"  placeholder="http://" class="widefat" id="<?php echo $this->get_field_id('txt13'); ?>" 
            name="<?php echo $this->get_field_name('txt15'); ?>" value="<?php echo $txt13; ?>" />
        </td>
    </tr> 
    
    <tr>
    	<td colspan="2">
        	<label>Yelp Link</label>
        	<input type="text"  placeholder="http://" class="widefat" id="<?php echo $this->get_field_id('txt13'); ?>" 
            name="<?php echo $this->get_field_name('txt16'); ?>" value="<?php echo $txt13; ?>" />
        </td>
    </tr> 
    
    <tr>
    	<td colspan="2">
        	<label>Avvo Link</label>
        	<input type="text"  placeholder="http://" class="widefat" id="<?php echo $this->get_field_id('txt13'); ?>" 
            name="<?php echo $this->get_field_name('txt17'); ?>" value="<?php echo $txt13; ?>" />
        </td>
    </tr> 
    
</table>
</fieldset>
        <?php 
    }

} // class Products Widget

?>