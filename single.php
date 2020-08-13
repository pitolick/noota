<?php get_header(); ?>
<div id="sns" class="mq-dn-xl">
	<?php get_template_part('template-parts/entry-sns'); ?>
</div>
<main id="content">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<?php get_template_part('template-parts/entry'); ?>
	<?php if (comments_open() && ! post_password_required()) {
			comments_template('', true);
	} ?>
	<?php endwhile; endif; ?>
	<footer class="footer">
		<?php get_template_part('template-parts/nav', 'below-single'); ?>
	</footer>
</main>
<?php get_sidebar(); ?>
<?php get_footer();
