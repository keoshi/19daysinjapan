<?php get_header(); ?>

<article id="post-0" class="post not-found">
	<div class="wrap">
		<header class="entry-header">
			<h1 class="entry-title"><?php _e( 'The sun hasn\'t risen yet...', 'daysinjapan' ); ?></h1>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<p><?php _e( 'Don\'t worry, we just couldn\'t found the page you\'re looking for. Try one of the links below or a search.', 'daysinjapan' ); ?></p>

			<?php // get_search_form(); ?>

			<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>

			<?php if ( daysinjapan_categorized_blog() ) : ?>
			<div class="widget widget_categories">
				<h2 class="widgettitle"><?php _e( 'Explore by Day', 'daysinjapan' ); ?></h2>
				<ul>
				<?php
					wp_list_categories( array(
						'orderby'    => 'count',
						'order'      => 'DESC',
						'show_count' => 1,
						'title_li'   => '',
						'number'     => 10,
					) );
				?>
				</ul>
			</div><!-- .widget -->
			<?php endif; ?>


			<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>

		</div><!-- .entry-content -->
		
		<ul class="archive-day clear">
		<?php
	
		$i = 0;

		global $post;
	
		$args = array( 'posts_per_page' => -1, 'order'=> ASC, 'orderby' => 'date' );

		$allposts = get_posts( $args );
		foreach ( $allposts as $post ) : setup_postdata( $post );

			$category = get_the_category();
			$id = get_the_ID();
			$location = get_field('location');
			$i++;
			$clearClass = ($i % 3  == 0) ? " last"  : "";
		?>
			<li class="archive-post archive-post-<?php echo $i; ?><?php echo $clearClass; ?>">
				<a href="<?php the_permalink(); ?>" title="Read the full <?php the_title(); ?> post"><?php echo get_the_post_thumbnail( $id, 'large' ); ?></a>
				<h3 class="archive-title"><a href="<?php the_permalink(); ?>" title="Read the full <?php the_title(); ?> post"><?php the_title(); ?></a></h3>
				<h4 class="archive-location"><?php echo $category[0]->cat_name; ?> &middot; <?php echo $location; ?></h4>
				<p class="archive-excerpt"><?php echo get_excerpt(); ?></p>
			</li>
		
		<?php endforeach; ?>

		</ul>
		
	</div><!-- .wrap -->
</article><!-- #post-0 .post .not-found -->

<?php get_footer(); ?>