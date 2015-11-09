<?php if ( function_exists( 'get_header' ) ) {
	get_header();
} else {
	header("Location: http://" . $_SERVER['HTTP_HOST'] . "");
	exit;
}; ?>

	<?php if ( have_posts() ) : ?>

		<?php $i = 0; while ( have_posts() && $i < 1 ) : the_post(); ?>

			<?php get_template_part( 'content', get_post_format() ); ?>

		<?php $i++; endwhile; ?>
		
		<?php daysinjapan_content_nav( 'nav-below' ); ?>

	<?php else : ?>

		<?php get_template_part( 'no-results', 'index' ); ?>

	<?php endif; ?>

<?php get_footer(); ?>