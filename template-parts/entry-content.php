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
			<a href="<?php the_permalink(); ?>"
			title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail(); ?></a>
		</div>
	<?php endif; ?>

	<?php the_content(); ?>
	<?php $args = array(
	'before'      => '<div class="entry-links">',
	'after'       => '</div>',
	'next_or_number'   => 'next',
	'nextpagelink'     => '<span class="meta-nav-test">次のページへ</span><span class="meta-nav"><i class="fas fa-chevron-right"></i></span>',
	'previouspagelink' => '<span class="meta-nav"><i class="fas fa-chevron-left"></i></span><span class="meta-nav-test">前のページへ</span>',
	);?>
	<div class="navigation"><?php wp_link_pages($args); ?></div>
</div>