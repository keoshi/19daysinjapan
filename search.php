<?php get_header(); ?>

<div class="wrap">
	
	<h2 class="archive-day-title">
		<?php printf( __( 'Search Results for: %s', 'ksh' ), '<span>' . get_search_query() . '</span>' ); ?>
	</h2>
	
	<ul class="archive-day clear">

		<?php if ( have_posts() ) : ?>

			<?php
			$i = 0;
				while ( have_posts() ) :
				the_post();
				$id = get_the_ID();
				$location = get_field('location');
				$i++;
				$clearClass = ($i % 3  == 0) ? " last"  : "";
			?>

			<li class="archive-post archive-post-<?php echo $i; ?><?php echo $clearClass; ?>">
				<a href="<?php the_permalink(); ?>" title="Read the full <?php the_title(); ?> post"><?php echo get_the_post_thumbnail( $id, 'large' ); ?></a>
				<h3 class="archive-title"><a href="<?php the_permalink(); ?>" title="Read the full <?php the_title(); ?> post"><?php the_title(); ?></a></h3>
				<h4 class="archive-location"><?php echo $location; ?></h4>
				<p class="archive-excerpt"><?php echo get_excerpt(); ?></p>
			</li>

			<?php endwhile; ?>

			<?php ksh_content_nav( 'nav-below' ); ?>

		<?php else : ?>

			<?php get_template_part( 'no-results', 'search' ); ?>

		<?php endif; ?>

	</ul>
</div><!-- .wrap -->
<?php get_footer(); ?>