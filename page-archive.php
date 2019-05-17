<?php
/**
 * Template Name: Archive
 */

get_header();
?>

<div class="wrap">
	
	<h2 class="archive-day-title">
		Archive
		<a href="/map" class="more-content-link">See the Map</a>
	</h2>
	<ul class="archive-day clear">
	<?php
	
	$i = 0;

	global $post;
	
	$args = array( 'posts_per_page' => -1, 'order'=> 'ASC', 'orderby' => 'date' );

	$allposts = get_posts( $args );
	foreach ( $allposts as $post ) : setup_postdata( $post );

		$category = get_the_category();
		$id = get_the_ID();
		if ( get_field('location') )  {
			$location = get_field('location');
		}
		$i++;
	?>
		<li class="archive-post archive-post-<?php echo esc_html( $i ); ?>">
			<a href="<?php the_permalink(); ?>" title="Read the full <?php the_title(); ?> post"><?php echo get_the_post_thumbnail( $id, 'large' ); ?></a>
			<h3 class="archive-title"><a href="<?php the_permalink(); ?>" title="Read the full <?php the_title(); ?> post"><?php the_title(); ?></a></h3>
			<h4 class="archive-location"><?php echo esc_html( $category[0]->cat_name ); ?> &middot; <?php echo esc_html( $location ); ?></h4>
			<p class="archive-excerpt"><?php echo get_excerpt(); ?></p>
		</li>
		
	<?php endforeach; ?>

	</ul>

</div>

<?php get_footer(); ?>