<?php
/**
 * @package ksh
 */

if ( ! function_exists( 'ksh_content_nav' ) ) :
function ksh_content_nav( $nav_id ) {
	global $wp_query, $post;

	/*if ( is_single() ) {
		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous )
			return;
	}*/

	if ( $wp_query->max_num_pages < 2 && ( is_archive() || is_search() ) )
		return;

	$nav_class = ( is_single() ) ? 'navigation-post clear' : 'navigation-paging clear';

	?>
	<nav role="navigation" id="<?php echo esc_attr( $nav_id ); ?>" class="<?php echo $nav_class; ?>">
		<div class="wrap">
			<?php previous_post_link( '<div class="nav-previous"><h5 class="screen-reader-text">Previous Post</h5>%link</div>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'ksh' ) . '</span> %title' ); ?>
			<?php next_post_link( '<div class="nav-next"><h5 class="screen-reader-text">Next Post</h5>%link</div>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'ksh' ) . '</span>' ); ?>
		</div>

	</nav><!-- #<?php echo esc_html( $nav_id ); ?> -->
	<?php
}
endif;

if ( ! function_exists( 'ksh_comment' ) ) :
function ksh_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;

	if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<div class="comment-body">
			<?php _e( 'Pingback:', 'ksh' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'ksh' ), '<span class="edit-link">', '</span>' ); ?>
		</div>

	<?php else : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
					<?php printf( __( '%s <span class="says">says:</span>', 'ksh' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
				</div><!-- .comment-author -->

				<div class="comment-metadata">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
						<time datetime="<?php comment_time( 'c' ); ?>">
							<?php printf( _x( '%1$s at %2$s', '1: date, 2: time', 'ksh' ), get_comment_date(), get_comment_time() ); ?>
						</time>
					</a>
					<?php edit_comment_link( __( 'Edit', 'ksh' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .comment-metadata -->

				<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'ksh' ); ?></p>
				<?php endif; ?>
			</footer><!-- .comment-meta -->

			<div class="comment-content">
				<?php comment_text(); ?>
			</div><!-- .comment-content -->

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'add_below' => 'div-comment', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- .comment-body -->

	<?php
	endif;
}
endif;

if ( ! function_exists( 'ksh_posted_on' ) ) :
function ksh_posted_on() {
	printf( __( 'Published on <a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>', 'ksh' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);
}
endif;

function ksh_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so ksh_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so ksh_categorized_blog should return false
		return false;
	}
}

function ksh_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'ksh_category_transient_flusher' );
add_action( 'save_post', 'ksh_category_transient_flusher' );