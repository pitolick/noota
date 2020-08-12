<header>
	<?php if (is_singular()) {
			echo '<h1 class="entry-title">';
		} else {
			echo '<h2 class="entry-title">';
	} ?>
	<a href="<?php the_permalink(); ?>"	title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a>
	<?php if (is_singular()) {
			echo '</h1>';
		} else {
			echo '</h2>';
	} ?> <?php edit_post_link(); ?>

	<?php if (! is_search()) {
		get_template_part('template-parts/entry', 'meta');
	} ?>
</header>
<div class="entry-content">
	<?php if (has_post_thumbnail()) : ?>
		<div class="entry-thumbnail">
			<a href="<?php $src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full', false); echo esc_url($src[0]); ?>"
			title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail(); ?></a>
		</div>
	<?php elseif(catch_thumbnail_image($catch_thumbnail_size)): ?>
		<?php // アイキャッチが設定されていないとき記事内の画像を設定 ?>
		<div class="entry-thumbnail">
			<a href="<?php the_permalink(); ?>"
			title="<?php the_title_attribute(); ?>"><?php echo catch_thumbnail_image($catch_thumbnail_size); ?></a>
		</div>
	<?php else: ?>
		<?php // 記事内の画像すらないときはデフォルトのNo Imageを設定 ?>
		<div class="entry-thumbnail">
			<a href="<?php the_permalink(); ?>"
			title="<?php the_title_attribute(); ?>">
			<img width="1280" height="670" src="<?php echo esc_url(get_template_directory_uri()) . "/img/no_image-lg.png"; ?>" class="thumbnail-image" alt="<?php the_title_attribute(); ?>" srcset="<?php echo esc_url(get_template_directory_uri()) . "/img/no_image-lg.png"; ?> 1280w, <?php echo esc_url(get_template_directory_uri()) . "/img/no_image.png"; ?> 600w" sizes="(max-width: 1280px) 100vw, 1280px">
		</div>
		</a>
	<?php endif; ?>

	<?php the_content(); ?>

	<div class="entry-links"><?php wp_link_pages(); ?></div>
</div>