<?php get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<div class="wrap">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

				<div id="social">
					<div class="wrap">
						<div id="comments">
							<?php
							// @todo: add comments
							?>
						</div>
					</div>
				</div>

			<?php endwhile; ?>
			</div>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>
