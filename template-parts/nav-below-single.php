<?php $args = array(
	'prev_text' => '<span class="meta-nav"><i class="fas fa-chevron-left"></i></span> %title',
	'next_text' => '%title <span class="meta-nav"><i class="fas fa-chevron-right"></i></span>'
);
the_post_navigation($args);