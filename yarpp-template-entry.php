<h2 class="yarpp-title">関連記事</h2>
<div class="yarpp-article">
	<?php while (have_posts()) : the_post(); ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-summary">
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?> "rel="bookmark">
		<?php if (has_post_thumbnail()) : ?>
			<?php // アイキャッチを設定 ?>
			<div class="entry-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div>
			<?php elseif(catch_thumbnail_image()): ?>
				<?php // アイキャッチが設定されていないとき記事内の画像を設定 ?>
				<div class="entry-thumbnail">
					<?php echo catch_thumbnail_image(); ?>
				</div>
				<?php else: ?>
					<?php // 記事内の画像すらないときはデフォルトのNo Imageを設定 ?>
					<div class="entry-thumbnail">
						<img width="1280" height="670" src="<?php echo esc_url(get_template_directory_uri()) . "/img/no_image-lg.png"; ?>" class="thumbnail-image" alt="<?php the_title_attribute(); ?>" srcset="<?php echo esc_url(get_template_directory_uri()) . "/img/no_image-lg.png"; ?> 1280w, <?php echo esc_url(get_template_directory_uri()) . "/img/no_image.png"; ?> 600w" sizes="(max-width: 1280px) 100vw, 1280px">
					</div>
					<?php endif; ?>
					<header>
						<h2 class="entry-title"><?php the_title(); ?></h2>
					</header>
				</a>
			</div>
		</article>
		<?php endwhile; ?>
	</div>