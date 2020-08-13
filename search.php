<?php get_header(); ?>
<main id="content">
	<?php if (have_posts()) : ?>
	<header class="header">
		<h1 class="entry-title"><i class="fas fa-search"></i>「<?php echo esc_html(get_search_query()); ?>」の検索結果 <?php echo $wp_query->found_posts; ?>件</h1>
	</header>
	<?php while (have_posts()) : the_post(); ?>
	<?php get_template_part('template-parts/entry'); ?>
	<?php endwhile; ?>
	<?php get_template_part('template-parts/nav', 'below'); ?>
	<?php else : ?>
	<article id="post-0" class="post no-results not-found">
		<header class="header">
			<h1 class="entry-title"><i class="fas fa-search"></i>「<?php echo esc_html(get_search_query()); ?>」の検索結果 <?php echo $wp_query->found_posts; ?>件</h1>
		</header>
		<div class="entry-content">
			<p>検索に一致するものはありません。 キーワードを変更してもう一度検索してください。</p>
		</div>
	</article>
	<?php endif; ?>
</main>
<?php get_sidebar(); ?>
<?php get_footer();
