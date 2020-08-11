<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="wrapper" class="hfeed">
		<header id="header">
			<div class="header-wrap container">
				<div id="branding">
					<div id="site-title">
						<?php if (is_front_page() || is_home() || is_front_page() && is_home()) {
								echo '<h1>';
						} ?>
							<?php if(has_custom_logo()) : ?>
								<?php the_custom_logo(); ?>
							<?php else: ?>
								<a href="<?php echo esc_url(home_url('/')); ?>"
									title="<?php echo esc_html(get_bloginfo('name')); ?>"
									rel="home"><?php echo esc_html(get_bloginfo('name')); ?></a>
							<?php endif; ?>
						<?php if (is_front_page() || is_home() || is_front_page() && is_home()) {
								echo '</h1>';
						} ?>
					</div>
				</div>
				<!-- <div id="search"><?php get_search_form(); ?>
				</div> -->
				<input id="nav-input" type="checkbox" class="nav-unshown">
				<label id="nav-open" for="nav-input" class="nav-unshown"><i class="fas fa-bars fa-lg"></i></label>
				<label class="nav-unshown" id="nav-close" for="nav-input"></label>
				<nav id="menu">
					<?php wp_nav_menu(array( 'theme_location' => 'main-menu' )); ?>
				</nav>
			</div>
		</header>
		<div id="container" class="container">