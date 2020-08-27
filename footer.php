</div>
<footer id="footer">
	<div class="container">
		<nav id="footer-menu">
			<?php if ( has_nav_menu('footer-menu') ) {
							wp_nav_menu(array( 'theme_location' => 'footer-menu' ));
						} ?>
		</nav>
		<div id="copyright">
			&copy; <?php echo esc_html(date_i18n('Y')); ?>
			<?php echo esc_html(get_bloginfo('name')); ?>
		</div>
	</div>
</footer>
</div>
<?php wp_footer(); ?>
</body>

</html>