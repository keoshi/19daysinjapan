<?php get_header(); ?>

<div class="wrap">

<?php if ( have_posts() ) : ?>

		<h2 class="archive-day-title">
			<?php
				if ( is_category() ) :
					printf( __( 'Archive for: %s', 'daysinjapan' ), '<span>' . single_cat_title( '', false ) . '</span>' );

				elseif ( is_tag() ) :
					printf( __( 'Archive for Tag: %s', 'daysinjapan' ), '<span>' . single_tag_title( '', false ) . '</span>' );

				elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
					_e( 'Asides', 'daysinjapan' );

				elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
					_e( 'Images', 'daysinjapan');

				elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
					_e( 'Videos', 'daysinjapan' );

				elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
					_e( 'Quotes', 'daysinjapan' );

				elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
					_e( 'Links', 'daysinjapan' );

				else :
					_e( 'Archives', 'daysinjapan' );

				endif;
			?>
			<a href="/archive" class="more-content-link">See the entire Archive</a>
		</h2>
		<?php
			if ( is_category() ) :
				// show an optional category description
				$category_description = category_description();
				if ( ! empty( $category_description ) ) :
					echo apply_filters( 'category_archive_meta', '<div class="taxonomy-description">' . $category_description . '</div>' );
				endif;

			elseif ( is_tag() ) :
				// show an optional tag description
				$tag_description = tag_description();
				if ( ! empty( $tag_description ) ) :
					echo apply_filters( 'tag_archive_meta', '<div class="taxonomy-description">' . $tag_description . '</div>' );
				endif;

			endif;
		?>
		<ul class="archive-day clear">
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
		</ul>

	<?php // daysinjapan_content_nav( 'nav-below' ); ?>

<?php else : ?>

	<?php get_template_part( 'no-results', 'archive' ); ?>

<?php endif; ?>

</div><!-- .wrap -->

<?php get_footer(); ?>