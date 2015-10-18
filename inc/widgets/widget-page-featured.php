<?php
/**
 * Featured Page Widget
 * @package Planar
 */
add_action('widgets_init', create_function('', 'register_widget("DT_Featured_Page");'));

add_action('admin_print_scripts-widgets.php', 'widget_featurepage_script');
add_action('admin_print_styles-widgets.php', 'widget_featurepage_style');

function widget_featurepage_script() {
	wp_enqueue_script( 'planar-color-picker', get_template_directory_uri() . '/js/color-picker-widget.js', array( 'jquery', 'wp-color-picker' ), '', true );
}
function widget_featurepage_style() {
	wp_enqueue_style( 'wp-color-picker' );
}

class DT_Featured_Page extends WP_Widget {

	function dt_featured_page() {
		$widget_ops = array(
				'classname' => 'dt_featured_page',
				'description' => __( 'Display a featured page', 'planar' )
				);
		$this->WP_Widget('dt_featured_page', __( 'DT Featured Page', 'planar' ), $widget_ops);
	}

    	function widget( $args, $instance ) {
		extract($args);
		$title = ( isset( $instance['title'] ) ) ? $instance['title'] : __( 'Featured Page', 'planar' );
		$color_txt = ( isset( $instance['color_txt'] ) ) ? $instance['color_txt'] : '#000';
		$page_id = ( empty( $instance['page_id'] ) ? '0' : $instance['page_id'] );

		$featured_post_args = array(
			'post_type' => 'page',
			'page_id' => $page_id
		);
		$featured_post = new WP_Query( $featured_post_args );

?>

<?php
	if ( $featured_post->have_posts() ) : while ( $featured_post->have_posts() ) : $featured_post->the_post();
        		echo $before_widget;
        		echo '<div class="featured-page">';
?>


		<div style="color: <?php echo $color_txt; ?>;<?php if ( has_post_thumbnail() ) { ?>background:<?php $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(), 'planar-featured-small' ); ?> url(<?php echo $thumbnail[0]; ?>) no-repeat; background-size: cover; background-position:50%;<?php } ?>">

<?php if ( $title ) { echo '<span>' . $title . '</span>'; } ?>

		<h3><a href="<?php the_permalink(); ?>" style="color: <?php echo $color_txt; ?>;"><?php the_title(); ?></a></h3>

		<?php // if ( has_excerpt() ) : ?>
	<?php the_excerpt(); ?>
		<?php // endif; //has_excerpt() ?>	
		</div>
<?php
	endwhile;
	endif;
		wp_reset_postdata();
?>
<?php
        echo '</div>';
        echo $after_widget;
    }

    function update( $new_instance, $old_instance ) {
	$instance = $old_instance;
	$instance['title'] = '' != $new_instance['title'] ? strip_tags( $new_instance['title'] ) : false;
	$instance['page_id'] = strip_tags( $new_instance['page_id'] );
	$instance['color_txt'] = esc_attr($new_instance['color_txt']);

        return $instance;
    }

    function form( $instance ) {
	$instance = wp_parse_args( (array) $instance, array( 'title' => __( 'Featured Page', 'planar' ), 'color_txt' => '#000', 'page_id' => '' ) );

	extract( $instance );

	$title = strip_tags( $instance['title'] );
	$page_id = strip_tags( $instance['page_id'] );
	$color_txt = esc_attr($instance['color_txt']);
?>

		<p>This widget will show the title, thumbnail and the announcement of any page on which you want to attract the visitor's attention.</p>

		<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title', 'planar' ); ?>:</label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id('page_id'); ?>"><?php _e( 'Page:', 'planar' ); ?></label>
		<?php
		wp_dropdown_pages( array( 
			'depth'            => 0,
			'child_of'         => 0,
			'selected'         => $page_id,
			'echo'             => 1,
			'name'             => $this->get_field_name('page_id'),
			'id'               => $this->get_field_id('page_id')
				) );
		?>
		</p>

		<p><!-- text color picker -->
		<label for="<?php echo $this->get_field_id('color_txt'); ?>"><?php _e( 'Color Text:', 'planar' ); ?></label><br />
	  	<input class="cw-color-picker" type="text" id="<?php echo $this->get_field_id('color_txt'); ?>" name="<?php echo $this->get_field_name('color_txt'); ?>" value="<?php if($color_txt) { echo $color_txt; } else { echo '#000'; } ?>" />
		</p>

<?php
    }
} 