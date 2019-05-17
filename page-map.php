<?php
/**
 * Template Name: Map
 */

get_header();

//queries

$all_posts = get_posts( 'posts_per_page=-1&order=ASC' );
if ($all_posts) :
	global $post;
	$i = 0;
	// map stuff
	global $markerImg;

?>

<div class="wrap">
	
	<h2 class="map-title">
		Map
		<a href="/archive" class="more-content-link">See the Archive</a>
	</h2>
	
	<script type="text/javascript">
		var maxWait = 2;
		var maxDelay = 400;
		var InfoBox;
		var infobox;
		function initialize() {
			var latlng = new google.maps.LatLng(36.535138,137.056352);
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
				zoom: 6,
				mapTypeId: google.maps.MapTypeId.ROADMAP,
				scrollwheel: false,
				styles: stylesArray,
				zoomControl: true,
				zoomControlOptions: {
					style: google.maps.ZoomControlStyle.SMALL
				}
			};
			var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
			setMarkers(map, locations);
		}
		var locations = [
		<?php
			foreach( $all_posts as $post ) :
				setup_postdata($post);
				$id = get_the_ID();
				$location = get_field('location');
				$map = get_field('map');
				$i++;
		?>
			['<?php echo $location?>',<?php echo $map[lat]; ?>,<?php echo $map[lng]; ?>,<?php echo $i ?>, "<?php the_title(); ?>", "<?php the_permalink(); ?>", '<?php echo get_the_post_thumbnail( $id, 'medium' ); ?>'],
		<?php endforeach; ?>
		];
		function setMarkers(map, locations) {
			var markerImg = new google.maps.MarkerImage("<?php echo $markerImg; ?>", null, null, null, new google.maps.Size(20,27));
			var marker, i;
			for (var i = 0; i < locations.length; i++) {
				var location = locations[i];
				var myLatLng = new google.maps.LatLng(location[1], location[2]);
				var content = '<div class="info-window"><a href="' + location[5] + '">' + location[6] + '</a><h3><a href="' + location[5] + '">' + location[4] + '</h3></a><h4>' + location[0] + '</h4></div>';
				
				(function(i, myLatLng, locations, content) {
					setTimeout(function() {
						var marker = new google.maps.Marker({
						    position: myLatLng,
						    map: map,
							flat: true,
						    icon: markerImg,
							optimized: false,
							animation: google.maps.Animation.DROP,
						    title: location[0],
						    zIndex: location[2],
							html: content
						});
						
						infobox = new google.maps.InfoWindow({
							alignBottom: true,
						    content: content,
						    maxWidth: 260
						});
						AddInfoBox(marker, content);
						
					}, i * Math.min(maxWait * 1000 / locations.length, maxDelay));
				}(i, myLatLng, locations, content));
			}
			function AddInfoBox(myMarker, content) {
                google.maps.event.addListener(myMarker,'click',function() {
                        infobox.setContent(this.html);
                        infobox.open(map, this);
                });

            }
		}
		google.maps.event.addDomListener(window, 'load', initialize);
	</script>
	<section id="map">
		<div class="wrap-map">
			<div id="map-canvas"></div>
		</div>
	</section>

<?php endif; ?>
</div>

<?php get_footer(); ?>