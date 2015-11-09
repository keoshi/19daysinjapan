<?php

// Global Variable
$markerImg = get_template_directory_uri() . "/img/marker.png";
$arrowImg = get_template_directory_uri() . "/img/arrow.png";

if ( ! isset( $content_width ) )
	$content_width = 1100;

update_option('image_default_link_type', 'none');

if ( ! function_exists( 'daysinjapan_setup' ) ) :
function daysinjapan_setup() {

	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'post-thumbnails' );

	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'daysinjapan' ),
		'secondary' => __( 'Footer Menu', 'daysinjapan' ),
	) );

}
endif;
add_action( 'after_setup_theme', 'daysinjapan_setup' );

function daysinjapan_custom_menu_item ( $items, $args ) {
	$theme_uri = get_template_directory_uri();
    if ( $args->theme_location == 'primary' ) {
        $items .= '<li class="menu-item menu-item-search"><a href="#" id="search-trigger"><img class="svg search-icon" src="' . esc_url( $theme_uri ) . '/img/search.svg" alt="Search"></a></li>';
    }
    return $items;
}
add_filter( 'wp_nav_menu_items', 'daysinjapan_custom_menu_item', 10, 2 );

function daysinjapan_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Footer - About', 'daysinjapan' ),
		'id'            => 'footer-about',
		'before_widget' => '<aside id="%1$s" class="widget %2$s about">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'daysinjapan_widgets_init' );

/* Style & Scripts */
function daysinjapan_scripts() {
	wp_enqueue_style( 'daysinjapan-style', get_stylesheet_uri() );
	wp_enqueue_style( 'daysinjpan-googlefonts', 'https://fonts.googleapis.com/css?family=Lato:400,400italic,700,700italic');
	if ( get_option( 'gmaps_key' ) ) :
	wp_enqueue_script( 'daysinjapan-gm', 'https://maps.googleapis.com/maps/api/js?key=' . esc_attr( get_option( 'gmaps_key' ) ) . '&sensor=false', array(), '20151109', false );
	wp_enqueue_script( 'daysinjapan-infobox', 'http://google-maps-utility-library-v3.googlecode.com/svn/trunk/infobox/src/infobox.js', array( 'daysinjapan-gm' ), '20151109', false );
	endif;
	wp_enqueue_script( 'daysinjapan-app', get_template_directory_uri() . '/js/app.js', array( 'jquery' ), '20151109', false );
}
add_action( 'wp_enqueue_scripts', 'daysinjapan_scripts' );

/* Analytics */
function daysinjapan_analytics() {

	$analytics_ref = get_option( 'analytics_ref' );

	?>
	<script type="text/javascript">
		var _gaq = _gaq || [];
			_gaq.push(['_setAccount', <?php echo esc_attr( $analytics_ref ); ?>]);
			_gaq.push(['_trackPageview']);

		(function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();
	
		function trackOutboundLink(link, category, action) {  
			try { 
				_gaq.push(['_trackEvent', category , action]); 
			} catch(err){}

			setTimeout(function() {
				document.location.href = link.href;
			}, 200);
		}
	</script>
	<?php
}
if ( get_option( 'analytics_ref' ) ) :
	add_action( 'wp_head', 'daysinjapan_analytics' );
endif;

/* Open Graphs Tags */
function daysinjapan_ogtags() {
	if ( !is_page() ) :
		global $post;
		$the_title = get_bloginfo('name') . ' &middot; ' . get_the_title();
		$imageID = get_post_thumbnail_id( $post->ID );
		$image = wp_get_attachment_url( $imageID );
		if ( !$image && $image = "" ) :
			$image = "http://mutelife.s3.amazonaws.com/wp-content/uploads/2013/06/flashbacks-paris-06.jpg";
		endif;
	?>
	<meta property="og:title" content="<?php echo esc_html( $the_title ); ?>" />
	<meta property="og:description" content="<?php echo bloginfo('description'); ?>" />
	<meta property="og:type" content="website" />       
	<meta property="og:image" content="<?php echo esc_html( $image ); ?>" />
	<meta property="og:url" content="<?php echo the_permalink(); ?>" />
	<?php
	else :
	?>
	<meta property="og:title" content="<?php bloginfo('name'); ?>" />
	<meta property="og:description" content="<?php bloginfo('description'); ?>" />
	<meta property="og:type" content="website" />       
	<meta property="og:image" content="<?php echo esc_html( $image ); ?>" />
	<meta property="og:url" content="<?php bloginfo('url'); ?>" />
	<?php
	endif;
}
add_action( 'wp_head', 'daysinjapan_ogtags' );

/* Add extra tag to image captions */
add_shortcode('wp_caption', 'daysinjapan_fixed_img_caption_shortcode');
add_shortcode('caption', 'daysinjapan_fixed_img_caption_shortcode');
function daysinjapan_fixed_img_caption_shortcode($attr, $content = null) {
    $caption = img_caption_shortcode( $attr, $content );
    $caption = str_replace( 'class="wp-caption', 'class="wp-caption entry-image', $caption );
    return $caption;
}

/* Strip <p> tag on images */
function daysinjapan_strip_p_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
add_filter('the_content', 'daysinjapan_strip_p_on_images');

/* Cut the excerpt */
function get_excerpt(){
	$excerpt = get_the_content();
	$excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
	$excerpt = strip_shortcodes($excerpt);
	$excerpt = strip_tags($excerpt);
	$excerpt = substr($excerpt, 0, 140);
	$excerpt = substr($excerpt, 0, strripos($excerpt, " "));
	$excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
	$excerpt = $excerpt.'&hellip;';
	return $excerpt;
}

/* Add CSS styles to TinyMCE */
function daysinjapan_add_editor_styles() {
    add_editor_style( 'style-editor.css' );
}
add_action( 'init', 'daysinjapan_add_editor_styles' );

/* Add extra styles to TinyMCE */
function daysinjapan_custom_tinymce( $init ) {
	$init['theme_advanced_buttons2_add_before'] = 'styleselect';
	$init['theme_advanced_styles'] = 'Intro=intro,Big=big';
	return $init;
}
add_filter( 'tiny_mce_before_init', 'daysinjapan_custom_tinymce' );

/* ACF */
define( 'ACF_LITE', true );

function daysinjapan_acf_settings_path( $path ) {
    $path = get_stylesheet_directory() . '/inc/acf/';
    return $path;
}
add_filter( 'acf/settings/path', 'daysinjapan_acf_settings_path' );
 
function daysinjapan_acf_settings_dir( $dir ) {
    $dir = get_stylesheet_directory_uri() . '/inc/acf/';
    return $dir;
}
add_filter( 'acf/settings/dir', 'daysinjapan_acf_settings_dir' );

include_once( get_stylesheet_directory() . '/inc/acf/acf.php' );

if( function_exists( 'register_field_group' ) ) {
	register_field_group(array (
		'id' => 'acf_additional-post-info',
		'title' => 'Additional Post Info',
		'fields' => array (
			array (
				'key' => 'field_51e339ebf85e5',
				'label' => 'Location',
				'name' => 'location',
				'type' => 'text',
				'instructions' => 'Location text (eg: <em>Shibuya, Tokyo</em>)',
				'required' => 1,
				'default_value' => '',
				'formatting' => 'html',
				'maxlength' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
			),
			array (
				'key' => 'field_51d8dda45338d',
				'label' => 'Map',
				'name' => 'map',
				'type' => 'google_map',
				'instructions' => 'Enter a specific address or click the map to define the location',
				'center_lat' => '35.6730185',
				'center_lng' => '139.4302008',
				'zoom' => 5,
				'height' => '',
			),
			array (
				'key' => 'field_51ddba555a8a9',
				'label' => 'Zoom',
				'name' => 'zoom',
				'type' => 'select',
				'instructions' => 'Map zoom level',
				'choices' => array (
					15 => 'Microscopic (15)',
					12 => 'Close up (12)',
					9 => 'Medium (9)',
					6 => 'High up (6)',
				),
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}

/* Theme options */
function daysinjapan_settings_page() {
	?>
	<div class="wrap">
		<h1>Theme Settings</h1>
		<form method="post" action="options.php">
			<?php
				settings_fields("section");
				do_settings_sections("theme-options");      
				submit_button(); 
			?>          
		</form>
	</div>
	<?php
}

function daysinjapan_setting_googlemapskey() {
	?>
		<input type="text" name="gmaps_key" id="gmaps_key" value="<?php echo get_option( 'gmaps_key' ); ?>" />
	<?php
}

function daysinjapan_setting_analytics() {
	?>
		<input type="text" name="analytics_ref" id="analytics_ref" value="<?php echo get_option( 'analytics_ref' ); ?>" />
	<?php
}

function daysinjapan_layout_element() {
	?>
		<input type="checkbox" name="theme_layout" value="1" <?php checked(1, get_option( 'theme_layout' ), true); ?> /> 
	<?php
}


function daysinjapan_theme_panel_fields() {
	add_settings_section("section", "Customize the theme to your needs and liking", null, "theme-options");

	add_settings_field("gmaps_key", "Google Maps API Key", "daysinjapan_setting_googlemapskey", "theme-options", "section");
	add_settings_field("analytics_ref", "Analytics Tracking Code", "daysinjapan_setting_analytics", "theme-options", "section");
	//add_settings_field("theme_layout", "Theme Layout", "daysinjapan_layout_element", "theme-options", "section");

	register_setting("section", "gmaps_key");
	register_setting("section", "analytics_ref");
	//register_setting("section", "theme_layout");
}
add_action("admin_init", "daysinjapan_theme_panel_fields");

function daysinjapan_theme_menu_item() {
	add_menu_page( 'Theme Settings', 'Theme Settings', 'manage_options', 'theme-panel', 'daysinjapan_settings_page', null, 99 );
}
add_action( 'admin_menu', 'daysinjapan_theme_menu_item' );


/* Extras */

// add_filter('show_admin_bar', '__return_false');

require get_template_directory() . '/inc/template-tags.php';

require get_template_directory() . '/inc/extras.php';

require get_template_directory() . '/inc/jetpack.php';