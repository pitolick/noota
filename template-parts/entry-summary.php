<div class="entry-summary">
	<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?> "rel="bookmark">
		<?php if (has_post_thumbnail()) : ?>
			<?php // アイキャッチを設定 ?>
			<div class="entry-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div>
		<?php elseif(catch_thumbnail_image($catch_thumbnail_size)): ?>
			<?php // アイキャッチが設定されていないとき記事内の画像を設定 ?>
			<div class="entry-thumbnail">
				<?php echo catch_thumbnail_image($catch_thumbnail_size); ?>
			</div>
		<?php else: ?>
			<?php // 記事内の画像すらないときはデフォルトのNo Imageを設定 ?>
			<div class="entry-thumbnail">
				<img width="1280" height="670" src="<?php echo esc_url(get_template_directory_uri()) . "/img/no_image-lg.png"; ?>" class="thumbnail-image" alt="<?php the_title_attribute(); ?>" srcset="<?php echo esc_url(get_template_directory_uri()) . "/img/no_image-lg.png"; ?> 1280w, <?php echo esc_url(get_template_directory_uri()) . "/img/no_image.png"; ?> 600w" sizes="(max-width: 1280px) 100vw, 1280px">
			</div>
		<?php endif; ?>

		<header>
			<?php if (is_singular()) {
					echo '<h1 class="entry-title">';
				} else {
					echo '<h2 class="entry-title">';
			} ?>
			<?php the_title(); ?>
			<?php if (is_singular()) {
					echo '</h1>';
				} else {
					echo '</h2>';
			} ?> <?php edit_post_link(); ?>
		</header>
		<div class="entry-excerpt">
			<?php the_excerpt(); ?>
		</div>
	</a>
	<?php if (! is_search()) {
		get_template_part('template-parts/entry', 'meta');
	} ?>

	<?php if (is_search()) { ?>
		<div class="entry-links"><?php wp_link_pages(); ?></div>
	<?php } ?>
</div>