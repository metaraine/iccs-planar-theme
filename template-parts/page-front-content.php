<?php
/**
 * @package Planar
 * Display Default Page
 */
?>

	<div id="content" class="site-content clearfix" <?php planar_bg_content(); ?>>

		<div class="wrap-inner">

		<?php if ( is_active_sidebar( 'front-page-before' ) ) { ?>
			<div class="widgets-page-section clearfix">
				<?php dynamic_sidebar( 'front-page-before' ); ?>
			</div>
		<?php } ?>

			<?php while ( have_posts() ) : the_post(); ?>
				<?php if ( '' != get_the_content() ) : ?>
					<?php get_template_part( 'content', 'page' ); ?>
				<?php endif; ?>
			<?php endwhile; // end of the loop. ?>

		</div><!-- .wrap-inner -->

<?php
$sections = get_theme_mod('planar_front_page_section');
$sections_decode = json_decode($sections);

	if( !empty( $sections ) && !empty( $sections_decode ) ){
		foreach( $sections_decode as $sections ){ ?>
<section class="customizer-set">
	<div class="section-page clearfix">

<?php
if( $sections->image_url ) {
	echo '<div class="section-img"><img src="'.esc_attr($sections->image_url).'" /></div>';
}
?>
		<div class="wrap-inner">
<?php
if( $sections->title ) {
	echo '<h3>'.esc_attr($sections->title).'</h3>';
}
if( $sections->subtitle ) {
	echo '<h4>'.esc_attr($sections->subtitle).'</h4>';
}
if( $sections->text ) {
	echo '<p class="intro-section">'.wp_kses_post($sections->text).'</p>';
}
?>
		</div><!-- .wrap-inner -->
<?php
if( $sections->link ) {
	echo '<a class="btn" href="'.esc_attr($sections->link).'">' . __( 'Learn More', 'planar' ) . '</a>';
}
?>
	</div><!-- .section-page -->
</section>
<?php
		}
	}
// end front page Customizer section
?>

		<div class="wrap-inner">

		<?php if ( is_active_sidebar( 'front-page-after' ) ) { ?>
			<div class="widgets-page-section clearfix">
				<?php dynamic_sidebar( 'front-page-after' ); ?>
			</div>
		<?php } ?>

		</div><!-- .wrap-inner -->

	</div><!-- #content -->