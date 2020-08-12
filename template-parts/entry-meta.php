<?php $users = count_users();?>
<div class="entry-meta">
	<span class="entry-meta-start">
		<?php if($users["total_users"] > 1): // ユーザー数が1以上のとき?>
			<span class="author vcard"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" class="avatar"><?php echo get_avatar(get_the_author_meta( 'ID' )); ?></a><?php the_author_posts_link(); ?></span>
		<?php endif; ?>
		<span class="entry-cat"><i class="fas fa-tags"></i><?php the_category('&nbsp;'); ?>&nbsp;<?php the_tags('','&nbsp;'); ?></span>
	</span>
	<span class="entry-date"><i class="fas fa-calendar-alt"></i><?php the_time(get_option('date_format')); ?>&emsp;<i class="fas fa-sync-alt"></i><?php the_modified_date(get_option('date_format')); ?></span>
</div>