<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title><?php wp_title( '&middot;', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<header id="header">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
			<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
			<h2 class="site-description"> &middot; <?php bloginfo( 'description' ); ?></h2>
		</a>
		<nav id="menu">
			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
		</nav>
		<a id="nav-trigger" href="#">Menu</a>
		<?php if ( is_home() || is_single() ) : ?>
		<div id="scroll-progress"></div>
		<?php endif; ?>
	</header>
	
	<?php get_template_part( 'header-searchform' ); ?>

	<div id="main" class="site site-main">
		<?php do_action( 'before' ); ?>
		