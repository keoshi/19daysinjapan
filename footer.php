
	</div><!-- #main -->

	<footer id="colophon" class="site-footer clear" role="contentinfo">
		<div class="wrap">
			<?php do_action( 'ksh_credits' ); ?>
			<?php if ( is_active_sidebar( 'footer-about' ) ) : ?>
				<?php dynamic_sidebar( 'footer-about' ); ?>
			<?php endif; ?>
			
			<div class="menu-bottom">
				<h4><?php esc_attr_e( 'Menu' ); ?></h4>
				<?php wp_nav_menu( array( 'theme_location' => 'secondary', 'container_class' => '' ) ); ?>
			</div>
			
			<div class="credits">
				<h4><?php esc_attr_e( 'Credits' ); ?></h4>
				<p><?php bloginfo( 'name' ); ?> — <?php echo date('Y'); ?></p>
				<p><a href="http://19daysinjapan.com/" title="<?php esc_attr_e( '19 Days in Japan Theme' ); ?>"><?php printf( __( 'Theme: %s', 'ksh' ), '19 Days in Japan' ); ?></a></p>
			</div>
		</div>
	</footer>

<?php wp_footer(); ?>

</body>
</html>