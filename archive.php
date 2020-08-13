<?php get_header(); ?>
<main id="content">
	<header class="header">
		<h1 class="entry-title"><i class="fas fa-tags"></i><?php printf(esc_html('%s：一覧'), single_term_title()); ?></h1>
	</header>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<?php get_template_part('template-parts/entry'); ?>
	<?php endwhile; endif; ?>
	<?php get_template_part('template-parts/nav', 'below'); ?>
</main>
<?php get_sidebar(); ?>
<?php get_footer();
