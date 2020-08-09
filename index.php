<?php get_header(); ?>
<main id="content">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php get_template_part( 'template-parts/entry' ); ?>
<?php comments_template(); ?>
<?php endwhile; endif; ?>
<?php get_template_part( 'template-parts/nav', 'below' ); ?>
</main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>