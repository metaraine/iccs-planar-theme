<?php
/**
 * Custom Widget Call-To-Action
 * @package Planar
 */
add_action('widgets_init', create_function('', 'register_widget("DT_Action_Widget");'));

add_action('admin_print_scripts-widgets.php', 'widget_callact_script');
add_action('admin_print_styles-widgets.php', 'widget_callact_style');

function widget_callact_script() {
	wp_enqueue_script( 'planar-color-picker', get_template_directory_uri() . '/js/color-picker-widget.js', array( 'jquery', 'wp-color-picker' ), '', true );
}
function widget_callact_style() {
	wp_enqueue_style( 'wp-color-picker' );
}

class DT_Action_Widget extends WP_Widget {
	function __construct() {
		parent::__construct(
			'dt_action_widget',
			'DT ' . __( 'Call-To-Action', 'planar' ),
			array(
				'classname' => 'dt_action_widget', 
				'description' => __( 'Section call-to-action', 'planar' ),
				'width' => 250,
				'height' => 350
			)
		);
 	}

 	function form( $instance ) {
 		$planar_defaults[ 'text_main' ] = '';
 		$planar_defaults[ 'button_text' ] = '';
 		$planar_defaults[ 'button_url' ] = '';
		$planar_defaults[ 'background' ] = 'transparent';
		$planar_defaults[ 'color_txt' ] = '#000';
		$planar_defaults[ 'color_btn' ] = '#fb3e31';

 		$instance = wp_parse_args( (array) $instance, $planar_defaults );

		$text_main = esc_textarea( $instance[ 'text_main' ] );
		$button_text = esc_attr( $instance[ 'button_text' ] );
		$button_url = esc_url( $instance[ 'button_url' ] );
		$background = esc_attr($instance['background']);
		$color_txt = esc_attr($instance['color_txt']);
		$color_btn = esc_attr($instance['color_btn']);
		?>

		<p>The purpose of this widget creation section a colored background with a call to action and button.</p>
		
		<p>
		<label for="<?php echo $this->get_field_id('text_main'); ?>"><?php _e( 'Main Text:','planar' ); ?></label>
		<textarea class="widefat" rows="3" cols="20" id="<?php echo $this->get_field_id('text_main'); ?>" name="<?php echo $this->get_field_name('text_main'); ?>"><?php echo $text_main; ?></textarea>
		</p>

		<p>
		<label for="<?php echo $this->get_field_id('button_text'); ?>"><?php _e( 'Button Text:', 'planar' ); ?></label>
		<input id="<?php echo $this->get_field_id('button_text'); ?>" name="<?php echo $this->get_field_name('button_text'); ?>" type="text" value="<?php echo $button_text; ?>" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id('button_url'); ?>"><?php _e( 'Button Link:', 'planar' ); ?></label>
		<input id="<?php echo $this->get_field_id('button_url'); ?>" name="<?php echo $this->get_field_name('button_url'); ?>" type="text" value="<?php echo $button_url; ?>" />
		</p>


		<p><!-- background picker -->
		<label for="<?php echo $this->get_field_id('background'); ?>"><?php _e( 'Background Color:', 'planar' ); ?></label><br />
	  	<input class="cw-color-picker" type="text" id="<?php echo $this->get_field_id('background'); ?>" name="<?php echo $this->get_field_name('background'); ?>" value="<?php if($background) { echo $background; } else { echo '#fff'; } ?>" />
		</p>



		<p><!-- text color picker -->
	  	<label for="<?php echo $this->get_field_id('color_txt'); ?>"><?php _e( 'Color Text:', 'planar' ); ?></label><br />
	  	<input class="cw-color-picker" type="text" id="<?php echo $this->get_field_id('color_txt'); ?>" name="<?php echo $this->get_field_name('color_txt'); ?>" value="<?php if($color_txt) { echo $color_txt; } else { echo '#000'; } ?>" />
		</p>



		<p><!-- btn color picker -->
	  	<label for="<?php echo $this->get_field_id('color_btn'); ?>"><?php _e( 'Color Button:', 'planar' ); ?></label><br />
	  	<input class="cw-color-picker" type="text" id="<?php echo $this->get_field_id('color_btn'); ?>" name="<?php echo $this->get_field_name('color_btn'); ?>" value="<?php if($color_btn) { echo $color_btn; } else { echo '#fb3e31'; } ?>" />
		</p>

		<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		
		if ( current_user_can('unfiltered_html') )
			$instance['text_main'] =  $new_instance['text_main'];
		else
			$instance['text_main'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text_main']) ) );

		$instance[ 'button_text' ] = strip_tags( $new_instance[ 'button_text' ] );
		$instance[ 'button_url' ] = esc_url_raw( $new_instance[ 'button_url' ] );

		$instance['background'] = strip_tags($new_instance['background']);
		$instance['color_txt'] = strip_tags($new_instance['color_txt']);
		$instance['color_btn'] = strip_tags($new_instance['color_btn']);

		return $instance;
	}

	function widget( $args, $instance ) {
 		extract( $args );
 		extract( $instance );

 		$text_main = empty( $instance['text_main'] ) ? '' : $instance['text_main'];
 		$button_text = isset( $instance[ 'button_text' ] ) ? $instance[ 'button_text' ] : ''; 		
 		$button_url = isset( $instance[ 'button_url' ] ) ? $instance[ 'button_url' ] : '';
		$background = ( isset( $instance['background'] ) ) ? $instance['background'] : '#fff';
		$color_txt = ( isset( $instance['color_txt'] ) ) ? $instance['color_txt'] : '#000';
		$color_btn = ( isset( $instance['color_btn'] ) ) ? $instance['color_btn'] : '#398ece';

		echo $before_widget;
		?>
						<?php 
						if( !empty( $text_main ) ) {
						?>
				<div class="call-to-action" style="background-color: <?php echo $background; ?>;">
					<div class="call-to-action-text" style="color: <?php echo $color_txt; ?>;">
							<h3><?php echo esc_html( $text_main ); ?></h3>				
					</div><!-- .call-to-action-text -->
					<?php 
					if( !empty( $button_url ) ) {
					?>			
						<div class="call-to-action-button">
		<a href="<?php echo esc_url( $button_url ); ?>" class="btn red" style="background-color: <?php echo $color_btn; ?>;"><?php echo esc_html( $button_text ); ?></a>
						</div><!-- .call-to-action-button -->
					<?php
					}
					?>
				<div class="clearfix"></div>
				</div><!-- .call-to-action -->
						<?php
						}
						?>
		<?php 
		echo $after_widget;
 	}
 }