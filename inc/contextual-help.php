<?php
/**
 * Theme Contextual Help
 * @package Planar
 */
add_filter( 'contextual_help', 'planar_admin_contextual_help', 10 );

function planar_admin_contextual_help() {
	$screen = get_current_screen();

if ( $screen->id == 'themes' ) {

  $screen->add_help_tab( array(
      'id' => 'planar_wellcom_tab',
      'title' => __( 'Planar Theme', 'planar' ),
      'content' => '<p><strong>' . __( 'Thank you for choosing this Theme!', 'planar' ) . '</strong></p><p>' . __( 'The Theme has a context help for almost all admin screens (see tab Theme Features). More information, help and customers support you will find on the website <a href="' . esc_url( 'http://www.dinevthemes.com/' ) . '">DinevThemes</a>.', 'planar' ) . '</p><p><strong>' . __( 'Quick Start', 'planar' ) . '</strong></p><p>' . __( 'Using Customizer set your color, upload a background image (or select any color), upload the header image (or select any color) and other settings.', 'planar' ) . '</p><p>' . __( 'The theme has page templates for the Home Page. When create or edit a page, use metabox Page Attributes: dropdown select Template.', 'planar' ) . '</p><p>' . __( 'If you want to display the posts/page without the sidebar just leave blank (no widgets) sidebar posts/page.', 'planar' ) . '</p></p>',
  ) );

}

if ( $screen->id == 'post' ) {

	$screen->add_help_tab( array(
		'id'      => 'planar-post-fimg',
		'title'   => __( 'Theme Features', 'planar' ),
		'content' => '<p><strong>' . __( 'Theme Features', 'planar' ) . '</strong></p><p><strong>' . __( 'Use Featured image', 'planar' ) . '</strong></p><p>' . __( 'Upload the image that will be background header single post.', 'planar' ) . '</p><p><strong>' . __( 'Use Excerpt', 'planar' ) . '</strong></p><p>' . __( 'Enter text in Metabox Excerpt to show announcement or the focus of the post.', 'planar' ) . '</p><p><strong>' . __( 'Button', 'planar' ) . '</strong></p><p>' . __( 'To show the button, use the link class, , for example <code>class="btn blue"</code>. Color options: green, blue, red.', 'planar' ) . '</p><p><strong>' . __( 'Gallery shortcode', 'planar' ) . '</strong></p><p>' . __( 'For a slideshow gallery use the built-in parameter WordPress shortcode Themes <code>type="slider"</code>, sample: <code>[gallery columns="..." ids="..." type="slider"]</code>', 'planar' ) . '</p>',
  ) );

}

if ( $screen->id == 'page' ) {

  $screen->add_help_tab( array(
      'id' => 'planar_page_tab',
      'title' => __( 'Theme Features', 'planar' ),
	'content' =>  '<p><strong>' . __( 'Theme Features', 'planar' ) . '</strong></p><p><strong>' . __( 'Use Featured image', 'planar' ) . '</strong></p><p>' . __( 'Upload the image that will be displayed header on page.', 'planar' ) . '</p><p><strong>' . __( 'Use Excerpt', 'planar' ) . '</strong></p><p>' . __( 'Enter text in Metabox Excerpt to show announcement or the focus of the page.', 'planar' ) . '</p><p><strong>' . __( 'Templates', 'planar' ) . '</strong></p><p>' . __( 'The theme has several page templates. Use metabox Page Attributes > dropdown Template.', 'planar' ) . '</p><p><strong>' . __( 'Button', 'planar' ) . '</strong></p><p>' . __( 'To show the button, use the link class, , for example <code>class="btn blue"</code>. Color options: green, blue, red.', 'planar' ) . '</p><p><strong>' . __( 'Around Title', 'planar' ) . '</strong></p><p>' . __( 'Image (icon .png) above the title and the button under the title.', 'planar' ) . '</p><p><strong>' . __( 'Gallery shortcode', 'planar' ) . '</strong></p><p>' . __( 'For a slideshow gallery use the built-in parameter WordPress shortcode Themes <code>type="slider"</code>, sample: <code>[gallery columns="..." ids="..." type="slider"]</code>', 'planar' ) . '</p>',
  ) );

}

if ( $screen->id == 'widgets' ) {

	$screen->add_help_tab( array(
		'id'      => 'planar-widgets',
		'title'   => __( 'Theme Features', 'planar' ),
		'content' =>  '<p><strong>' . __( 'Custom widgets', 'planar' ) . '</strong></p><p>' . __( 'This theme has several custom widgets are marked with the prefix DT. Some widgets available after activating the plugins.', 'planar' ) . '</p><p>' . __( 'If the name of the widget contains Home Widgets this means that the widget for the home page (e.g. template Home Widgets).', 'planar' ) . '</p>',
	) );
}

if ( $screen->id == 'nav-menus' ) {

	$screen->add_help_tab( array(
		'id'      => 'planar-social-menus',
		'title'   => __( 'Social Menu', 'planar' ),
		'content' =>  '<p><strong>' . __( 'Social Icons Menu', 'planar' ) . '</strong></p><p>' . __( 'Menu icons social media is displayed in the footer. Included all popular icons of social media, and RSS. To create a menu item, use the tab Links (Edit Menus). And select Social Menu as Theme locations.', 'planar' ) . '</p><p>' . __( 'Example:<br />tab <strong>Links</strong><br /><em>URL</em> http://twitter.com/your<br /><em>Navigation Label</em> Twitter', 'planar' ) . '</p>',
	) );
}

/**
* else
*/
      return;
}
?>