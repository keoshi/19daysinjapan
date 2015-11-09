<?php
	/*
	 * 19 Days in Japan theme
	 * Main Content
	 */

	/*
	 * Hero Image
	 */
	$id = get_the_ID();
	$heroImgID = get_post_thumbnail_id( $id );
	$heroImg = wp_get_attachment_url( $heroImgID );
	if ( !$heroImg ) {
		$heroImg = "http://mutelife.s3.amazonaws.com/wp-content/uploads/2013/06/flashbacks-paris-06.jpg";
	}
	
	/*
	 * Category / Day
	 */
	$category = get_the_category(); 
	$categoryName = $category[0]->cat_name;
	
	/*
	 * Location / Map
	 */
	if ( get_field( 'location' ) ) {
		$location = get_field( 'location' );
	}
	if ( get_field( 'map' ) ) {
		$map = get_field( 'map' );
		$latlng = $map['lat'] . ',' . $map['lng'];
	}
	if ( get_field( 'zoom' ) ) {
		$zoom = get_field( 'zoom' );
	}
	if( !$zoom ) { $zoom = "7"; }
	global $markerImg;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header id="hero" class="header" style="background-image: url('<?php echo esc_html( $heroImg ); ?>');">
		<div class="inner wrap">
			<div class="title">
				<h1><?php the_title(); ?></h1>
				<span class="meta"><?php echo $categoryName; ?> &middot; <?php echo esc_html( $location ); ?></span>
				<span class="hint-scroll meta">Scroll down</span>
			</div>
		</div>
	</header>
	
	<div class="wrap">
		<?php if ( is_search() ) : ?>
		<section id="content" class="summary">
			<?php the_excerpt(); ?>
		</section>
		<?php else : ?>
		<section id="content" class="content">
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'ksh' ) ); ?>
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'ksh' ),
					'after'  => '</div>',
				) );
			?>
		</section>
		<?php endif; ?>
	</div>
	
	<div id="social">
		<div class="wrap">
			<div id="shares">
				<h4>Spread the love</h4>
				<ul>
					<li>
						<div class="twitter-share"><a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink(); ?>" data-text="<?php the_title(); ?>">Tweet</a>
						<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
						</div>
					</li>
					<li>
						<div class="tumblr-share">
							<a href="http://www.tumblr.com/share/link?url=<?php echo urlencode( the_permalink() ) ?>&name=<?php echo urlencode( bloginfo('name') . ' - ' . the_title() ) ?>&description=<?php echo urlencode( bloginfo('description') ) ?>" title="Share on Tumblr" style="display:inline-block; text-indent:-9999px; overflow:hidden; width:61px; height:20px; background:url('http://platform.tumblr.com/v1/share_2.png') top left no-repeat transparent;">Share on Tumblr</a>
						</div>
					</li>
					<li>
						<div class="pinterest-share">
							<a href="//pinterest.com/pin/create/button/" data-pin-do="buttonBookmark" ><img src="//assets.pinterest.com/images/pidgets/pin_it_button.png" /></a><script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
						</div>
					</li>
				</ul>
			</div>
			<?php
			// @todo: add comments
			?>
		</div>
	</div>
	
	<?php if( $latlng !== null ) : ?>
	<script type="text/javascript">
		function initialize() {
			var latlng = new google.maps.LatLng(<?php echo esc_html( $latlng ); ?>);
			var markerImg = new google.maps.MarkerImage("<?php echo esc_html( $markerImg ); ?>", null, null, null, new google.maps.Size(20,27));
			var stylesArray = [
			  {
			    "elementType": "geometry",
			    "stylers": [
			      { "visibility": "simplified" }
			    ]
			  },{
			    "elementType": "labels.icon",
			    "stylers": [
			      { "visibility": "off" }
			    ]
			  }
			]
			var mapOptions = {
				center: latlng,
				zoom: <?php echo esc_html( $zoom ); ?>,
				mapTypeId: google.maps.MapTypeId.ROADMAP,
				scrollwheel: false,
				styles: stylesArray,
				zoomControl: true,
				zoomControlOptions: {
					style: google.maps.ZoomControlStyle.SMALL
				}
			};
			var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
			var marker = new google.maps.Marker({
				position: latlng,
				map: map,
				flat: true,
				animation: google.maps.Animation.BOUNCE,
				icon: markerImg,
	            optimized: false,
				title:"<?php echo the_title(); ?>"
			});
		}	
		google.maps.event.addDomListener(window, 'load', initialize);
	</script>
	<aside id="map">
		<div class="wrap-map">
			<div id="map-canvas"></div>
		</div>
	</aside>
	<?php endif; ?>
	

	<?php if ( 'post' == get_post_type() ) : ?>
	<footer class="meta footer-meta clear">
		<div class="wrap">
			<?php
				$categories_list = get_the_category_list( __( ', ', 'ksh' ) );
			?>
			<span class="day-links">
				<?php printf( __( 'Part of %1$s', 'ksh' ), $categories_list ); ?>
			</span>
			
			&middot;
			
			<?php ksh_posted_on(); ?>

			<?php
				$tags_list = get_the_tag_list( '', __( ', ', 'ksh' ) );
				if ( $tags_list ) :
			?>
			
			&middot;
			
			<span class="tags-links">
				<?php printf( __( 'Tags: %1$s', 'ksh' ), $tags_list ); ?>
			</span>
			<?php endif; // End if $tags_list ?>
			
			<?php edit_post_link( __( '[Edit]', 'ksh' ), '<span class="edit-link">', '</span>' ); ?>
			
		</div>
	</footer>
	<?php endif; ?>
	
</article>
