<div class="entry-meta">
	<span class="entry-meta-start">
		<span class="entry-cat"><i class="fas fa-tags"></i><?php the_category('&nbsp;'); ?>&nbsp;<?php the_tags('','&nbsp;'); ?></span>
	</span>
	<span class="entry-date"><i class="fas fa-calendar-alt"></i><?php the_time(get_option('date_format')); ?>&emsp;<i class="fas fa-sync-alt"></i><?php the_modified_date(get_option('date_format')); ?></span>
</div>