<?php $users = count_users();?>
<?php if($users["total_users"] > 1): // ユーザー数が1以上のとき?>
	<div class="entry-user">
		<span class="author vcard"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" class="avatar"><?php echo get_avatar(get_the_author_meta( 'ID' )); ?></a><?php the_author_posts_link(); ?></span>
	</div>
<?php endif; ?>
