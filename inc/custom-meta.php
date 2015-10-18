<?php
/**
 * Custom metadata
 *
 * @package Planar
 */

function planar_custom_meta() {
        add_meta_box( 'planar_meta', __( 'Around Title', 'planar' ), 'planar_meta_callback', 'page', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'planar_custom_meta' );

/**
 * Adds the meta box stylesheet
 */
function planar_admin_styles(){
        wp_enqueue_style( 'planar_meta_styles', get_template_directory_uri() . '/css/custom-meta.css', '08092015' );
}
add_action( 'admin_enqueue_scripts', 'planar_admin_styles' ); // 'admin_print_styles'

/**
 * Loads the image management javascript
 */
function planar_image_enqueue() {
        wp_enqueue_media();
 
        // Registers and enqueues the required javascript.
        wp_register_script( 'meta-box-image', get_template_directory_uri() . '/js/meta-box-image.js', array( 'jquery' ) );
        wp_localize_script( 'meta-box-image', 'meta_image',
            array(
                'title' => __( 'Upload Image', 'planar' ),
                'button' => __( 'Use this image', 'planar' ),
            )
        );
        wp_enqueue_script( 'meta-box-image' );
}
add_action( 'admin_enqueue_scripts', 'planar_image_enqueue' );


/**
 * Outputs the content of the meta box
 */
function planar_meta_callback( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'planar_nonce' );
    $planar_stored_meta = get_post_meta( $post->ID );
    ?>
 
    <p>
        <label for="meta-text" class="custom-meta-row-title"><?php _e( 'Text on the button', 'planar' )?></label>
        <input type="text" name="meta-text" id="meta-text" value="<?php if ( isset ( $planar_stored_meta['meta-text'] ) ) echo $planar_stored_meta['meta-text'][0]; ?>" />
    </p>

    <p>
        <label for="meta-url" class="custom-meta-row-title"><?php _e( 'URL', 'planar' )?></label>
        <input type="text" name="meta-url" id="meta-url" value="<?php if ( isset ( $planar_stored_meta['meta-url'] ) ) echo $planar_stored_meta['meta-url'][0]; ?>" />
    </p>

<p>
    <label for="meta-image" class="custom-meta-row-title"><?php _e( 'Image File', 'planar' )?></label>
    <input type="text" name="meta-image" id="meta-image" value="<?php if ( isset ( $planar_stored_meta['meta-image'] ) ) echo $planar_stored_meta['meta-image'][0]; ?>" />
    <input type="button" id="meta-image-button" class="button" value="<?php _e( 'Upload Image', 'planar' )?>" />
</p>
 
    <?php
}

/**
 * Saves the custom meta input
 */
function planar_meta_save( $post_id ) {
 
    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'planar_nonce' ] ) && wp_verify_nonce( $_POST[ 'planar_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
 
    // Checks for input and sanitizes/saves if needed
    if( isset( $_POST[ 'meta-text' ] ) ) {
        update_post_meta( $post_id, 'meta-text', sanitize_text_field( $_POST[ 'meta-text' ] ) );
    }
    if( isset( $_POST[ 'meta-image' ] ) ) {
       update_post_meta( $post_id, 'meta-image', esc_url( $_POST[ 'meta-image' ] ) );
   }
    if( isset( $_POST[ 'meta-url' ] ) ) {
       update_post_meta( $post_id, 'meta-url', esc_url( $_POST[ 'meta-url' ] ) );
   }
 
}
add_action( 'save_post', 'planar_meta_save' );