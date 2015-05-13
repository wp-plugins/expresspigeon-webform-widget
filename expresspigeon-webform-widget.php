<?php
/*
Plugin Name: ExpressPigeon Subscription Form
Plugin URI: http://expresspigeon.com
Description: The ExpressPigeon Subscription Form allows you to easily add a newsletter subscription form to your Wordpress blog or site.
Version: 1.5
Min WP Version: 3.0
Author: Stas Sidorov
Author URI: http://expresspigeon.com
*/
?>
<?php
add_action('widgets_init', create_function('', 'return register_widget("ExpressPigeon_Webform_Widget");'));

class ExpressPigeon_Webform_Widget extends WP_Widget {

	function __construct() {	   
		$widget_ops = array('classname' => 'ExpressPigeon_Webform_Widget', 'description' => "The ExpressPigeon Subscription Form allows you to easily add a newsletter subscription form to your Wordpress blog or site." );
		$control_ops = array('width' => 200, 'height' => 300);
		parent::__construct('iframewidget', __('ExpressPigeon Subscription Form'), $widget_ops, $control_ops);
	}
	
	function form($instance) {
		$instance = wp_parse_args((array) $instance, array('width' => 400, 'height' => 200, 'guid' => ''));
		$width = strip_tags($instance['width']);
		$height = strip_tags($instance['height']);
		$guid = strip_tags($instance['guid']);
		$style = strip_tags($instance['style']);
		?>
		<p><small>Displays newsletter subscription form.</small></p>
		<p>
			<label for="<?php echo $this->get_field_id( 'width' ); ?>"><?php _e( 'Width*:' ); ?></label>
			<input size="4" id="<?php echo $this->get_field_id('width'); ?>" name="<?php echo $this->get_field_name('width'); ?>" type="text" value="<?php echo esc_attr($width); ?>" />
	        &nbsp;&nbsp;&nbsp;  
			<label for="<?php echo $this->get_field_id( 'height' ); ?>"><?php _e( 'Height*:' ); ?></label> 
			<input size="4" id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" type="text" value="<?php echo esc_attr($height); ?>" />
		</p>
		<p><small>* The Width and Height attributes can be specified either in pixels (example: 50px or simply 50) or as a percentage of the available space (example: 50%).</small></p>		
		<p>
			<label for="<?php echo $this->get_field_id( 'guid' ); ?>"><?php _e( 'Form GUID*:' ); ?></label>
			<input size="40" id="<?php echo $this->get_field_id('guid'); ?>" name="<?php echo $this->get_field_name('guid'); ?>" type="text" value="<?php echo esc_attr($guid); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'style' ); ?>"><?php _e( 'CSS Style:' ); ?></label>
			<input size="40" id="<?php echo $this->get_field_id('style'); ?>" name="<?php echo $this->get_field_name('style'); ?>" type="text" value="<?php echo esc_attr($style); ?>" />
			<br><small>(example:<i>border:1px solid black;align:left;</i>)</small>	
		</p>	
		<?php
	}
	
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['width'] = strip_tags($new_instance['width']);
		$instance['height'] = strip_tags($new_instance['height']);
		$instance['guid'] = strip_tags($new_instance['guid']);			
		$instance['style'] = strip_tags($new_instance['style']);		
		return $instance;
	}

	// This prints the widget
	function widget( $args, $instance ) {	
		extract($args);
		?>
		<iframe style="<?php echo $instance['style'] ; ?>" scrolling="auto" frameborder="0" src="https://expresspigeon.com/subscription/iframe_form/<?php echo $instance['guid'] ; ?>" width="<?php echo $instance['width'] ; ?>" height="<?php echo $instance['height'] ; ?>">
			Your user agent does not support frames or is currently configured not to display frames. However, you can subscribe <a href="https://expresspigeon.com/subscription/form/<?php echo $instance['guid'] ; ?>">here</a>.
		</iframe>
		<?php 
		echo $after_widget; 
	}	
}	
?>
