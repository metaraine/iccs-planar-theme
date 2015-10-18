<?php
/**
 * Custom Widget Image-Text
 * @package Planar
 */
add_action('widgets_init', create_function('', 'register_widget("DT_Textimage_Widget");'));

add_action('admin_print_scripts-widgets.php', 'widget_textimage_script');
add_action('admin_print_styles-widgets.php', 'widget_textimage_style');

//add_action('admin_enqueue_scripts', 'widget_textimage_script');
//add_action('admin_enqueue_scripts', 'widget_textimage_style');

function widget_textimage_script() {
	wp_enqueue_media();
	wp_enqueue_script( 'planar-color-picker', get_template_directory_uri() . '/js/color-picker-widget.js', array( 'jquery', 'wp-color-picker' ), '', true );
	wp_enqueue_script( 'image_widget', get_template_directory_uri() . '/js/widget-image-txt.js', array( 'jquery', 'media-upload', 'media-views' ), '', true );
}
function widget_textimage_style() {
	wp_enqueue_style( 'wp-color-picker' );
    	wp_enqueue_style( 'image_widget_css', get_template_directory_uri() . '/css/widget-image-txt.css' );
}

class DT_Textimage_Widget extends WP_Widget {
	function __construct() {
		parent::__construct(
			'dt_textimage_widget',
			'DT ' . __( 'Image&Text', 'planar' ),
			array(
				'classname' => 'dt_textimage_widget', 
				'description' => __( 'Widget display text on the background image', 'planar' ),
				'width' => 250,
				'height' => 350
			)
		);
	}

	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$image = ( isset( $instance['image'] ) ) ? $instance['image'] : '';
		$text = apply_filters( 'widget_text', empty( $instance['text'] ) ? '' : $instance['text'], $instance );
		$color_txt = ( isset( $instance['color_txt'] ) ) ? $instance['color_txt'] : '#000';
		$url = ( isset( $instance['url'] ) ) ? $instance['url'] : '';

		$title_string = ( $url ) ? '<a href="' . $url . '" style="color: ' . $color_txt . ';">'. $title . '</a>' : $title;
		$image_string = ( $url ) ? '<a href="' . $url . '"><img src="' . $image. '" alt="' . esc_attr( $title ) . '" class="aligncenter" /></a>' : '<img src="' . $image. '" alt="' . esc_attr( $title ) . '" class="aligncenter" />';

		echo $before_widget;
?>
		<div class="image-text-widget" style="color: <?php echo $color_txt; ?>;<?php if ( ! empty( $image ) ) { ?>background: url(<?php echo $image; ?>) no-repeat; background-size: cover; background-position:50%;"<?php } ?>>

<?php
		if ( $title )
			echo '<h3>' . $title_string . '</h3>';
		?>
			<?php echo ( ! empty( $instance['filter'] ) ) ? wpautop( $text ) : $text; ?>
		<?php
		echo '</div>';
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['image'] = esc_url( $new_instance['image'] );
		$instance['url'] = esc_url( $new_instance['url'] );
		$instance['color_txt'] = esc_attr($new_instance['color_txt']);

		if ( current_user_can( 'unfiltered_html' ) )
			$instance['text'] =  $new_instance['text'];
		else
			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes( $new_instance['text'] ) ) );

		$instance['filter'] = isset( $new_instance['filter'] );

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '', 'color_txt' => '#000', 'image' => '', 'url' => '' ) );
		extract( $instance );
		$img_tag = ( $image ) ? '<img src="' . esc_url( $image ) . '" alt="" />' : '';
		?>

		<p>This widget is assigned to create a block with the image, title, and short text.</p>

		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'planar' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<p><label><?php _e( 'Image:', 'planar' ); ?></label>
		<span class="widget-image-container"><?php echo $img_tag; ?></span>
		<a href="#" class="select-image"><?php _e( 'Select Image', 'planar' ); ?></a> | <a href="#" class="delete-image"><?php _e( 'Remove Image', 'planar' ); ?></a>
		<input class="image-widget-image-container" name="<?php echo $this->get_field_name( 'image' ); ?>" type="hidden" value="<?php echo esc_url( $image ); ?>" />
		</p>

		<p><label for="<?php echo $this->get_field_id( 'url' ); ?>"><?php _e( 'URL:', 'planar' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'url' ); ?>" name="<?php echo $this->get_field_name( 'url' ); ?>" type="text" value="<?php echo esc_attr( $url ); ?>" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id('text'); ?>"><?php _e( 'Text:', 'planar' ); ?></label><br />
		<textarea class="widefat" rows="8" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo esc_textarea( $text ); ?></textarea>
		</p>

		<p><input id="<?php echo $this->get_field_id('filter'); ?>" name="<?php echo $this->get_field_name('filter'); ?>" type="checkbox" <?php checked( isset( $filter ) ? $filter : 0 ); ?> />&nbsp;<label for="<?php echo $this->get_field_id('filter'); ?>"><?php _e( 'Automatically add paragraphs', 'planar' ); ?></label>
		</p>

		<p><!-- text color picker -->
	  	<label for="<?php echo $this->get_field_id('color_txt'); ?>"><?php _e( 'Color Text:', 'planar' ); ?></label><br />
	  	<input class="cw-color-picker" type="text" id="<?php echo $this->get_field_id('color_txt'); ?>" name="<?php echo $this->get_field_name('color_txt'); ?>" value="<?php if($color_txt) { echo $color_txt; } else { echo '#000'; } ?>" />
		</p>

		<?php
	}
}