<?php get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<div class="wrap">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

				<div id="social">
					<div class="wrap">
						<div id="comments">
							<h4>Leave your thoughts</h4>
							<div id="disqus_thread"></div>
						    <script type="text/javascript">
						        var disqus_shortname = '19daysinjapan';
								var disqus_identifier = '19daysinjapan-about';
								var disqus_title = '19 Days in Japan &middot; <?php echo the_title(); ?>';
								var disqus_url = '<?php echo the_permalink(); ?>';

						        (function() {
						            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
						            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
						            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
						        })();
						    </script>
						    <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
						</div>
					</div>
				</div>

			<?php endwhile; ?>
			</div>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>
