<?php
/**
 * Theme Customizer Custom Repeatable section Control
 * @package Planar
 */

if ( class_exists( 'WP_Customize_Control' ) ) {
class Planar_Section_Repeater extends WP_Customize_Control {

        	private $options = array();

        	public function __construct( $manager, $id, $args = array() ) {
            		parent::__construct( $manager, $id, $args );
            		$this->options = $args;
        	}

        public function render_content() {

            $this_default = json_decode($this->setting->default);

            $values = $this->value();
            $json = json_decode($values);
            if(!is_array($json)) $json = array($values);
            $it = 0;

            $options = $this->options;
            if(!empty($options['planar_image_control'])){
                $planar_image_control = $options['planar_image_control'];
            } else {
                $planar_image_control = false;
            }
            if(!empty($options['planar_title_control'])){
                $planar_title_control = $options['planar_title_control'];
            } else {
                $planar_title_control = false;
            }
            if(!empty($options['planar_subtitle_control'])){
                $planar_subtitle_control = $options['planar_subtitle_control'];
            } else {
                $planar_subtitle_control = false;
            }                        
            if(!empty($options['planar_text_control'])){
                $planar_text_control = $options['planar_text_control'];
            } else {
                $planar_text_control = false;
            }
            if(!empty($options['planar_link_control'])){
                $planar_link_control = $options['planar_link_control'];
            } else {
                $planar_link_control = false;
            }

 ?>

            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <div class="planar_main_control_repeater planar_main_control_droppable">

 <?php
	if(empty($json)) {
                ?>
                        <div class="planar_main_control_repeater_container">
                            <div class="planar-customize-control-title"><?php esc_html_e('Section Page','planar')?></div>
                            <div class="planar-box-content-hidden">
                                <?php
                                        if($planar_image_control ==true){	?>
                                            <span class="customize-control-title"><?php esc_html_e('Image','planar')?></span>
                                            <p class="planar_image_control">
                                                <input type="text" class="widefat custom_media_url">
                                                <input type="button" class="button custom_media_button_planar" value="<?php esc_html_e('Upload Image','planar'); ?>" />
                                            </p>
                                <?php
                                        }
                                    if($planar_title_control==true){
                                ?>
                                        <span class="customize-control-title"><?php esc_html_e('Title','planar')?></span>
                                        <input type="text" class="planar_title_control" placeholder="<?php esc_html_e('Title','planar'); ?>"/>
                                <?php
                                    }
                        
                                    if($planar_subtitle_control==true){
                                ?>
                                        <span class="customize-control-title"><?php esc_html_e('Subtitle','planar')?></span>
                                        <input type="text" class="planar_subtitle_control" placeholder="<?php esc_html_e('Subtitle','planar'); ?>"/>
                                <?php
                                    }
 

                                    if($planar_text_control==true){ ?>
                                        <span class="customize-control-title"><?php esc_html_e('Text','planar')?></span>
                                        <textarea class="planar_text_control" placeholder="<?php esc_html_e('Text','planar'); ?>"></textarea>
                                <?php }

                                    if($planar_link_control==true){ ?>
                                        <span class="customize-control-title"><?php esc_html_e('Link','planar')?></span>
                                        <input type="text" class="planar_link_control" placeholder="<?php esc_html_e('Link','planar'); ?>"/>
                                <?php } ?>
                            <button type="button" class="planar_main_control_remove_field button" style="display:none;"><?php esc_html_e('Delete field','planar'); ?></button>
                            </div>
                        </div>
<?php
	} else {
	if ( !empty($this_default) && empty($json)) {
                            foreach($this_default as $section){
?>
                                <div class="planar_main_control_repeater_container planar_draggable">
                                    <div class="planar-customize-control-title"><?php esc_html_e('Section Page','planar')?></div>
                                    <div class="planar-box-content-hidden">
                                        <?php
			if($planar_image_control==true){ ?>
                                                    <span class="customize-control-title"><?php esc_html_e('Image','planar')?></span>
                                                    <p class="planar_image_control">
                                                        <input type="text" class="widefat custom_media_url" value="<?php if(!empty($section->image_url)) {echo esc_attr($section->image_url);} ?>">
                                                        <input type="button" class="button custom_media_button_planar" value="<?php esc_html_e('Upload Image','planar'); ?>" />
                                                    </p>
                                        <?php
			}
                                                if($planar_title_control==true){ ?>
                                                    <span class="customize-control-title"><?php esc_html_e('Title','planar')?></span>
                                                    <input type="text" value="<?php if(!empty($section->title)) echo esc_attr($section->title); ?>" class="planar_title_control" placeholder="<?php esc_html_e('Title','planar'); ?>"/>
                                        <?php
                                                }
                                                if($planar_subtitle_control==true){ ?>
                                                    <span class="customize-control-title"><?php esc_html_e('Subtitle','planar')?></span>
                                                    <input type="text" value="<?php if(!empty($section->subtitle)) echo esc_attr($section->subtitle); ?>" class="planar_subtitle_control" placeholder="<?php esc_html_e('Subtitle','planar'); ?>"/>
                                        <?php
                                                }
                                                if($planar_text_control==true){ ?>
                                                    <span class="customize-control-title"><?php esc_html_e('Text','planar')?></span>
                                                    <textarea placeholder="<?php esc_html_e('Text','planar'); ?>" class="planar_text_control"><?php if(!empty($section->text)) {echo esc_html($section->text);} ?></textarea>
                                        <?php
			}
                                                if($planar_link_control){ ?>
                                                    <span class="customize-control-title"><?php esc_html_e('Link','planar')?></span>
                                                    <input type="text" value="<?php if(!empty($section->link)) echo esc_url($section->link); ?>" class="planar_link_control" placeholder="<?php esc_html_e('Link','planar'); ?>"/>
                                        <?php
			} ?>
                                    <button type="button" class="planar_main_control_remove_field button" <?php if ($it == 0) echo 'style="display:none;"'; ?>><?php esc_html_e('Delete field','planar'); ?></button>
                                    </div>

                                </div>

<?php
		$it++;
		}
	} else {
		foreach($json as $section){
                    ?>
                                <div class="planar_main_control_repeater_container planar_draggable">
                                    <div class="planar-customize-control-title"><?php esc_html_e('Section Page','planar')?></div>
                                    <div class="planar-box-content-hidden">

		<?php if($planar_image_control == true){ ?>

                                                <span class="customize-control-title"><?php esc_html_e('Image','planar')?></span>
                                                <p class="planar_image_control">
                                                    <input type="text" class="widefat custom_media_url" value="<?php if(!empty($section->image_url)) {echo esc_attr($section->image_url);} ?>">
                                                    <input type="button" class="button custom_media_button_planar" value="<?php esc_html_e('Upload Image','planar'); ?>" />
                                                </p>

		<?php } if($planar_title_control==true){ ?>

                                            <span class="customize-control-title"><?php esc_html_e('Title','planar')?></span>
                                            <input type="text" value="<?php if(!empty($section->title)) echo esc_attr($section->title); ?>" class="planar_title_control" placeholder="<?php esc_html_e('Title','planar'); ?>"/>

		<?php } if($planar_subtitle_control==true){ ?>

                                            <span class="customize-control-title"><?php esc_html_e('Subtitle','planar')?></span>
                                            <input type="text" value="<?php if(!empty($section->subtitle)) echo esc_attr($section->subtitle); ?>" class="planar_subtitle_control" placeholder="<?php esc_html_e('Subtitle','planar'); ?>"/>

		<?php } if($planar_text_control==true ){ ?>

                                            <span class="customize-control-title"><?php esc_html_e('Text','planar')?></span>
                                            <textarea class="planar_text_control" placeholder="<?php esc_html_e('Text','planar'); ?>"><?php if(!empty($section->text)) {echo esc_html($section->text);} ?></textarea>
                                        
		<?php } if($planar_link_control){ ?>

                                            <span class="customize-control-title"><?php esc_html_e('Link','planar')?></span>
                                            <input type="text" value="<?php if(!empty($section->link)) echo esc_url($section->link); ?>" class="planar_link_control" placeholder="<?php esc_html_e('Link','planar'); ?>"/>

		<?php } ?>

                                        <button type="button" class="planar_main_control_remove_field button" <?php if ($it == 0) echo 'style="display:none;"'; ?>><?php esc_html_e('Delete field','planar'); ?></button>
                                    </div>

                                </div>
                    <?php
                                $it++;
                            }
                        }
                    }

	if ( !empty($this_default) && empty($json)) { ?>

                    <input type="hidden" id="planar_<?php echo $options['section']; ?>_repeater_colector" <?php $this->link(); ?> class="planar_repeater_colector" value="<?php  echo esc_textarea( json_encode($this_default )); ?>" />
<?php
	} else { ?>
                    <input type="hidden" id="planar_<?php echo $options['section']; ?>_repeater_colector" <?php $this->link(); ?> class="planar_repeater_colector" value="<?php echo esc_textarea( $this->value() ); ?>" />

<?php
	} ?>

            </div>

            <button type="button"   class="button add_field planar_main_control_new_field"><?php esc_html_e('Add new field','planar'); ?></button>

            <?php

    }

} // class Planar_Section_Repeater
} // class_exists( 'WP_Customize_Control' )