<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php get_template_part('template-parts/entry', (is_front_page() || is_home() || is_front_page() && is_home() || is_archive() || is_search() ? 'summary' : 'content')); ?>

	<?php if (is_singular()) {
		get_template_part('template-parts/entry-footer');
	} ?>
</article>