<?php get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'content' ); ?>

		<?php ksh_content_nav( 'nav-below' ); ?>

	<?php endwhile; ?>

<?php get_footer(); ?>