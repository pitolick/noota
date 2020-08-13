<?php $args = array(
	'prev_text' => '<span class="meta-nav"><i class="fas fa-chevron-left"></i></span> <span class="meta-nav-test">%title</span>',
	'next_text' => '<span class="meta-nav-test">%title</span> <span class="meta-nav"><i class="fas fa-chevron-right"></i></span>'
);
the_post_navigation($args);