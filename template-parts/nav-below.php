<?php $args = array(
	'prev_text' => sprintf(esc_html('%s older'), '<span class="meta-nav">&larr;</span>'),
	'next_text' => sprintf(esc_html('newer %s'), '<span class="meta-nav">&rarr;</span>')
);
the_posts_navigation($args);