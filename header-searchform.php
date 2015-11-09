<div id="search-global">
	<form method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
		<h4>Enter search terms below <a id="search-close-trigger" href="#"><img class="svg" src="<?php echo get_template_directory_uri(); ?>/img/close.svg" alt="Close"></a></h4>
		<input type="search" class="field" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" id="s" placeholder="<?php echo esc_attr_x( 'Search', 'placeholder', 'ksh' ); ?>" />
	</form>
	<div id="search-overlay"></div>
</div>