<?php $args = array(
	'prev_text' => sprintf(esc_html('%s'), '<i class="fas fa-chevron-left"></i>'),
	'next_text' => sprintf(esc_html('%s'), '<i class="fas fa-chevron-right"></i>')
);
the_posts_pagination($args);