<footer class="entry-footer">
	<?php get_template_part('template-parts/entry-meta', 'user'); ?>
	<?php get_template_part('template-parts/entry-sns'); ?>
	<?php if (comments_open()) {
		echo '<span class="meta-sep">|</span> <span class="comments-link"><a href="' . esc_url(get_comments_link()) . '">' . sprintf(esc_html('Comments')) . '</a></span>';
} ?>
</footer>