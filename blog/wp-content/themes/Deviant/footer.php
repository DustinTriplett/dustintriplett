            <div class="extender"></div>
			<div class="footer">
				<p><?php esc_html_e('Powered by ','Deviant'); ?> <a href="http://www.wordpress.com">WordPress</a> | <?php esc_html_e('Designed by ','Deviant'); ?> <a href="http://www.elegantthemes.com">Elegant Themes</a></p>
			</div>
		</div>

        <script src="<?php echo get_template_directory_uri(); ?>/js/superfish.js" type="text/javascript"></script>
        <script src="<?php echo get_template_directory_uri(); ?>/js/custom.js" type="text/javascript"></script>
		<script type="text/javascript">
			jQuery(function(){
				jQuery('ul.superfish').superfish();
				<?php if (get_option('deviant_disable_toptier') == 'on') echo('jQuery("ul.nav_links > li > a > span.sf-sub-indicator").parent().attr("href","#");'); ?>
			});
		</script>

		<?php wp_footer(); ?>
	</body>
</html>