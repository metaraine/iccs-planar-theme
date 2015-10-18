<?php
/**
 * Theme Customizer General
 * @package Planar
 */

require_once get_template_directory() . '/inc/customizer/textarea.php';
require_once get_template_directory() . '/inc/customizer/repeatable.php';

function planar_register_theme_customizer( $wp_customize ) {

	$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';

/*-----------------------------------------------------------*
 * Colors
 *-----------------------------------------------------------*/
    $wp_customize->add_setting(
        'planar_header_bgcolor',
        array(
            'default'     => '#398ece',
	'sanitize_callback' => 'sanitize_hex_color',
            'transport'   => 'postMessage'
        )
    );
    $wp_customize->add_setting(
        'planar_footer_bgcolor',
        array(
            'default'     => '#2E3138',
	'sanitize_callback' => 'sanitize_hex_color',
            'transport'   => 'postMessage'
        )
    );
    $wp_customize->add_setting(
        'planar_main_color',
        array(
            'default'     => '#2E3138',
	'sanitize_callback' => 'sanitize_hex_color',
            'transport'   => 'refresh'
        )
    );
    $wp_customize->add_setting(
        'planar_additional_color',
        array(
            'default'     => '#398ece',
	'sanitize_callback' => 'sanitize_hex_color',
            'transport'   => 'postMessage'
        )
    );
    $wp_customize->add_setting(
        'planar_menu_color',
        array(
            'default'     => '#ffffff',
	'sanitize_callback' => 'sanitize_hex_color',
            'transport'   => 'postMessage'
        )
    );
    $wp_customize->add_setting(
        'planar_submenu_color',
        array(
            'default'     => '#ffffff',
	'sanitize_callback' => 'sanitize_hex_color',
            'transport'   => 'refresh'
        )
    );
    $wp_customize->add_setting(
        'planar_topbar_bgcolor',
        array(
            'default'     => '#2e3138',
	'sanitize_callback' => 'sanitize_hex_color',
            'transport'   => 'refresh'
        )
    );
    $wp_customize->add_setting(
        'planar_topmenu_color',
        array(
            'default'     => '#dedede',
	'sanitize_callback' => 'sanitize_hex_color',
            'transport'   => 'refresh'
        )
    );
    $wp_customize->add_setting(
        'planar_submenu_bgcolor',
        array(
            'default'     => '#398ece',
	'sanitize_callback' => 'sanitize_hex_color',
            'transport'   => 'refresh'
        )
    );
    $wp_customize->add_setting(
        'planar_footer_color',
        array(
            'default'     => '#dedede',
	'sanitize_callback' => 'sanitize_hex_color',
            'transport'   => 'postMessage'
        )
    );
    $wp_customize->add_setting(
        'planar_secondary_color',
        array(
            'default'     => '#dedede',
	'sanitize_callback' => 'sanitize_hex_color',
            'transport'   => 'postMessage'
        )
    );

// Color Control

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'topbar_bgcolor',
            array(
                'label'      => __( 'Top Bar Background Color', 'planar' ),
                'section'    => 'colors',
                'settings'   => 'planar_topbar_bgcolor'
            )
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'header_bgcolor',
            array(
                'label'      => __( 'Header Background Color', 'planar' ),
                'section'    => 'colors',
                'settings'   => 'planar_header_bgcolor'
            )
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'footer_bgcolor',
            array(
                'label'      => __( 'Footer Background Color', 'planar' ),
                'section'    => 'colors',
                'settings'   => 'planar_footer_bgcolor'
            )
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'main_color',
            array(
                'label'      => __( 'Main Color', 'planar' ),
                'section'    => 'colors',
                'settings'   => 'planar_main_color'
            )
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'additional_color',
            array(
                'label'      => __( 'Additional Color', 'planar' ),
                'section'    => 'colors',
                'settings'   => 'planar_additional_color'
            )
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'topmenu_color',
            array(
                'label'      => __( 'Top Menu Color', 'planar' ),
                'section'    => 'colors',
                'settings'   => 'planar_topmenu_color'
            )
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'menu_color',
            array(
                'label'      => __( 'Menu Color', 'planar' ),
                'section'    => 'colors',
                'settings'   => 'planar_menu_color'
            )
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'submenu_color',
            array(
                'label'      => __( 'Sub Menu Color', 'planar' ),
                'section'    => 'colors',
                'settings'   => 'planar_submenu_color'
            )
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'submenu_bgcolor',
            array(
                'label'      => __( 'Sub Menu Background', 'planar' ),
                'section'    => 'colors',
                'settings'   => 'planar_submenu_bgcolor'
            )
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'footer_color',
            array(
                'label'      => __( 'Footer Text Color', 'planar' ),
                'section'    => 'colors',
                'settings'   => 'planar_footer_color'
            )
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'secondary_color',
            array(
                'label'      => __( 'Secondary Color', 'planar' ),
                'section'    => 'colors',
                'settings'   => 'planar_secondary_color'
            )
        )
    );

	/*-----------------------------------------------------------
	 * Headline section
	 *-----------------------------------------------------------*/
	$wp_customize->add_section(
		'planar_headline',
		array(
			'title'     => __( 'Headline', 'planar' ),
      			'description' => __( 'Enter text using the tags, sample: &#60;h1&#62;Headline&#60;/h1&#62;. You can also use shortcode to insert into the Home Headline.', 'planar' ),
			'priority'  => 100
		)
	);
		$wp_customize->add_setting(
			'planar_home_headline',
			array(
			'default' => 'Home Headline',
			'sanitize_callback' => 'planar_sanitize_textarea',
			'transport'   => 'postMessage'
			)
		);
		$wp_customize->add_setting(
			'planar_blog_headline',
			array(
			'default' => 'Blog Headline',
			'sanitize_callback' => 'planar_sanitize_textarea',
			'transport'   => 'postMessage'
			)
		);

	// Headline CONTROL
		$wp_customize->add_control( new planar_Textarea_Control( $wp_customize, 'planar_home_headline', array(
			'label' => __( 'Home Headline', 'planar' ),
			'section' => 'planar_headline',
			'settings' => 'planar_home_headline',
			'type' => 'text',
		) ) );
		$wp_customize->add_control( new planar_Textarea_Control( $wp_customize, 'planar_blog_headline', array(
			'label' => __( 'Blog Headline', 'planar' ),
			'section' => 'planar_headline',
			'settings' => 'planar_blog_headline',
			'type' => 'text',
		) ) );

	/*-----------------------------------------------------------*
	 * Home Sections Page
	 *-----------------------------------------------------------*/
	$wp_customize->add_section(
		'planar_home_sections',
		array(
			'title'     => __( 'Sections Front Page', 'planar' ),
      			'description' => __( 'Sections Front page (default template). Click to edit the content of the section. Drag to sort.', 'planar' ),
			'priority'  => 200
		)
	);
	$wp_customize->add_setting( 'planar_front_page_section', array(
		'sanitize_callback' => 'planar_sanitize_textarea',
		'default' => ''

	));
	$wp_customize->add_control( new Planar_Section_Repeater( $wp_customize, 'planar_front_page_section', array(
		'label'   => esc_html__( 'Add new section', 'planar' ),
		'section' => 'planar_home_sections',
		//'priority' => 3,
        		'planar_image_control' => true,
        		'planar_text_control' => true,
        		'planar_link_control' => true,
        		'planar_title_control' => true,
        		'planar_subtitle_control' => true
	) ) );

	/*-----------------------------------------------------------*
	 * Display Options section
	 *-----------------------------------------------------------*/
	$wp_customize->add_section(
		'planar_single_options',
		array(
			'title'     => __( 'Single Post Options', 'planar' ),
			'priority'  => 300
		)
	);
	/* Header Image Single */
	$wp_customize->add_setting( 
		'planar_header_single',
		array(
			'sanitize_callback' => 'planar_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'planar_header_single',
		array(
			'section'   => 'planar_single_options',
			'label'     => __( 'Hide Header Image', 'planar' ),
			'description' => __( 'Display Featured Image before the content', 'planar' ),
			'type'      => 'checkbox'
		)
	);
	/* Meta info on top single post */
	$wp_customize->add_setting( 
		'top_single_display',
		array(
			'sanitize_callback' => 'planar_sanitize_checkbox',
            			'transport'   => 'refresh'
		)
	);
	$wp_customize->add_control(
		'top_single_display',
		array(
			'section'   => 'planar_single_options',
			'label'     => __( 'Hide author/date meta top', 'planar' ),
			'type'      => 'checkbox'
		)
	);
	$wp_customize->add_setting( 
		'meta_single_display',
		array(
			'sanitize_callback' => 'planar_sanitize_checkbox',
            			'transport'   => 'refresh'
		)
	);
	$wp_customize->add_control(
		'meta_single_display',
		array(
			'section'   => 'planar_single_options',
			'label'     => __( 'Hide author/date meta bottom', 'planar' ),
			'description' => __( 'If checked hide author/date meta top', 'planar' ),
			'type'      => 'checkbox'
		)
	);

	/*-----------------------------------------------------------*
	 * Display Options section
	 *-----------------------------------------------------------*/
	$wp_customize->add_section(
		'planar_display_options',
		array(
			'title'     => __( 'Display Options', 'planar' ),
			'priority'  => 310
		)
	);
	/* Header */
	$wp_customize->add_setting( 
		'planar_display_title',
		array(
			'sanitize_callback' => 'planar_sanitize_checkbox',
            			//'transport'   => 'refresh'
		)
	);
	$wp_customize->add_control(
		'planar_display_title',
		array(
			'section'   => 'planar_display_options',
			'label'     => __( 'Hide Site Title', 'planar' ),
			'type'      => 'checkbox'
		)
	);
	$wp_customize->add_setting( 
		'planar_display_subtitle',
		array(
			'sanitize_callback' => 'planar_sanitize_checkbox',
            			//'transport'   => 'refresh'
		)
	);
	$wp_customize->add_control(
		'planar_display_subtitle',
		array(
			'section'   => 'planar_display_options',
			'label'     => __( 'Hide Site SubTitle', 'planar' ),
			'type'      => 'checkbox'
		)
	);
	/* Hide Home Headline */
	$wp_customize->add_setting( 
		'planar_display_headline',
		array(
			'sanitize_callback' => 'planar_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'planar_display_headline',
		array(
			'section'   => 'planar_display_options',
			'label'     => __( 'Hide Home Headline', 'planar' ),
			'description' => __( 'Header Image and Header Front Page will be hidden', 'planar' ),
			'type'      => 'checkbox'
		)
	);
	/* Right Align Sidebar */
	$wp_customize->add_setting( 
		'right_align_sidebar',
		array(
			'sanitize_callback' => 'planar_sanitize_checkbox',
            			'transport'   => 'refresh'
		)
	);
	$wp_customize->add_control(
		'right_align_sidebar',
		array(
			'section'   => 'planar_display_options',
			'label'     => __( 'Right aligned sidebar', 'planar' ),
			'type'      => 'checkbox'
		)
	);
	/* Sub Menu Page */
	$wp_customize->add_setting( 
		'planar_submenu_pages',
		array(
			'sanitize_callback' => 'planar_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'planar_submenu_pages',
		array(
			'section'   => 'planar_display_options',
			'label'     => __( 'Hide Submenu pages', 'planar' ),
			'type'      => 'checkbox'
		)
	);
	/* Logo Image Upload */
	$wp_customize->add_setting(
		'logo_upload',
		array(
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo_upload', array(
		'label' => __( 'Logo Image', 'planar' ),
		'section' =>  'planar_display_options',
		'settings' => 'logo_upload'
	) ) );
	/* Custom Avatar Image Upload */
	$wp_customize->add_setting(
		'avatar_upload',
		array(
			'sanitize_callback' => 'esc_url_raw',
		)
	);

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'avatar_upload', array(
		'label' => __( 'Avatar Image', 'planar' ),
		'section' =>  'planar_display_options',
		'settings' => 'avatar_upload'
	) ) );
	/* Copyright */
	$wp_customize->add_setting(
		'planar_footer_copyright_text',
		array(
			'default'            => 'All Rights Reserved',
			'sanitize_callback'  => 'planar_sanitize_txt',
			'transport'          => 'postMessage'
		)
	);

	$wp_customize->add_control(
		'planar_footer_copyright_text',
		array(
			'section'  => 'planar_display_options',
			'label'    => __( 'Copyright Message', 'planar' ),
			'type'     => 'text'
		)
	);


}
add_action( 'customize_register', 'planar_register_theme_customizer' );

	/*-----------------------------------------------------------*
	 * Sanitize
	 *-----------------------------------------------------------*/
function planar_sanitize_textarea( $input ) {
	return wp_kses_post(force_balance_tags($input));
}
function planar_sanitize_txt( $input ) {
	return strip_tags( stripslashes( $input ) );
}
function planar_sanitize_checkbox( $value ) {
        if ( 'on' != $value )
            $value = false;

        return $value;
    }

	/*-----------------------------------------------------------*
	 * Styles print
	 *-----------------------------------------------------------*/
function planar_customizer_css() {
?>
	 <style type="text/css">
#menu-top a, #menu-top .fa { color: <?php echo get_theme_mod( 'planar_topmenu_color' ); ?>; }
.top-bar { background-color: <?php echo get_theme_mod( 'planar_topbar_bgcolor'); ?>; }
.site-content, .entry-content, .archive .entry-title a, .search-results .entry-title a, #menu-topic a, #respond, .comment #respond,
#contactform, .wp-caption-text { color: <?php echo get_theme_mod( 'planar_main_color' ); ?>; }
figure.tile, input[type="submit"], input[type="reset"], input[type="button"], button, .btn, tfoot, .widget_calendar tbody, #wp-calendar tbody, .widget_calendar tbody, #infinite-handle span { background: <?php echo get_theme_mod( 'planar_additional_color'); ?>; }
.navigation-main-mobile ul, .navigation-main-mobile ul li ul, .navigation-main-mobile ul li ul ul, tfoot, .navigation-main ul ul, .navigation-main ul ul ul { background: <?php echo get_theme_mod( 'planar_submenu_bgcolor'); ?>; }
.widget_calendar thead, #wp-calendar thead, #wp-calendar tfoot tr { background: <?php echo get_theme_mod( 'planar_main_color' ); ?>; }
.site-footer { background: <?php echo get_theme_mod( 'planar_footer_bgcolor' ); ?>; }
a, .content-left .entry-meta p, .sticky-post-content .entry-title a, .sticky-post-content-2 .entry-title a, .brick-post-content .entry-title a, .brick-post-content-2 .entry-title a, .fa-reply:before { color: <?php echo get_theme_mod( 'planar_additional_color' ); ?>; }
#header-title, #header-title a, .navigation-main li a, .navigation-main-mobile ul li a, .menu-toggle::before, #menu-topic a:hover, .toggle-top::before, .tagline-txt h1, .headline .entry-title, .headline p { color: <?php echo get_theme_mod( 'planar_menu_color', '#398ece' ); ?>; }
.navigation-main-mobile ul li a, .navigation-main li ul a { color: <?php echo get_theme_mod( 'planar_submenu_color' ); ?>; }
.navigation-main ul li:hover > a,.navigation-main ul li.current_page_item > a,.navigation-main ul li.current-menu-item > a,.navigation-main ul li.current-menu-ancestor > a,.navigation-main ul li.current_page_ancestor > a,.navigation-main-mobile ul li:hover > a,.navigation-main-mobile ul li.current_page_item > a,.navigation-main-mobile ul li.current-menu-item > a,.navigation-main-mobile ul li.current-menu-ancestor > a,.navigation-main-mobile ul li.current_page_ancestor > a, .footer-widget a, .site-footer, #menu-social li a::before { color: <?php echo get_theme_mod( 'planar_secondary_color' ); ?>; }
.footer-widget a, .site-footer{ color: <?php echo get_theme_mod( 'planar_footer_color' ); ?>; }
.top-wrapper, #wp-calendar td a, .widget_calendar td a { background: <?php echo get_theme_mod( 'planar_main_color' ); ?>; }

<?php if( true === get_theme_mod( 'right_align_sidebar' ) ) { ?>
	.content-primary { float: left; }
	.content-secondary .widget-area { margin-right: 0; margin-left: 72px; }
<?php } ?>
	 </style>
<?php
}
add_action( 'wp_head', 'planar_customizer_css', 999 );

	/*-----------------------------------------------------------*
	 * Live Preview
	 *-----------------------------------------------------------*/
function planar_customizer_live_preview() {

	wp_enqueue_script(
		'theme-customizer',
		get_template_directory_uri() . '/js/theme-customizer.js',
		array( 'jquery', 'customize-preview' ),
		'15092015',
		true
	);

}
add_action( 'customize_preview_init', 'planar_customizer_live_preview' );

/**
 * Script Customizer Control
 */
function planar_control_customizer_script() {
	wp_enqueue_script( 'planar_control_customizer_script', get_template_directory_uri() . '/js/planar_control_customizer.js', array("jquery","jquery-ui-draggable"),'1.0', true  );

}
add_action( 'customize_controls_enqueue_scripts', 'planar_control_customizer_script' );