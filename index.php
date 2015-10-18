<?php
/**
 * @package Planar
 */
get_header(); ?>


		<?php
			$headline = get_theme_mod( 'planar_blog_headline' );
		if( $headline ) { ?>
<!-- Blog Headline -->
<div id="blog-tagline">
	<div class="tagline-txt wrap-inner">
		<?php echo wp_kses_post( get_theme_mod( 'planar_blog_headline', '<h1>Headline</h1>' ) ); ?>
	</div>
</div><!--#home-tagline-->
		<?php } ?>

		<div id="planar-scroll" class="clearfix" <?php do_action( 'background_content' ); ?>>

	<div id="content" class="site-content" role="main">

		<?php
		$sticky_posts = get_option('sticky_posts');

			if ( !empty( $sticky_posts ) ) :
			$args = array(
			    'post__in' => get_option('sticky_posts'),
				'post_status' => 'publish'
			);

			$sticky_query = new WP_Query( $args ); ?>

		<?php if ( $sticky_query->have_posts() ) : ?>

			<div class="sticky-posts clearfix">
				<?php while ( $sticky_query->have_posts() ) : $sticky_query->the_post(); ?>

					<?php get_template_part( 'content', 'sticky' ); ?>

				<?php endwhile; wp_reset_postdata(); ?>
			</div><!-- .sticky-posts -->

		<?php endif; ?>

			<?php endif; //!empty ?>

		<?php

		$args = array(
		    'posts_per_page' => get_option('posts_per_page'),
		    'paged' => get_query_var('paged'),
		    'post__not_in' => get_option('sticky_posts'),
		    'post_status' => 'publish'
		);

		$wp_query = new WP_Query( $args ); ?>

		<?php get_template_part( 'content', 'blog-tiles' ); ?>

	</div><!-- #content -->

<?php
	if ( class_exists( 'Jetpack' ) && ! Jetpack::is_module_active( 'infinite-scroll' ) ) {
planar_content_nav( 'nav-below' );
	}
?>
		</div><!-- #planar-scroll -->

<?php get_footer(); ?>