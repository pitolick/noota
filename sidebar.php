<aside id="sidebar">
	<?php if (is_active_sidebar('primary-widget-area')) : ?>
	<div id="primary" class="widget-area">
		<ul class="widget-wrap">
			<?php dynamic_sidebar('primary-widget-area'); ?>
		</ul>
	</div>
	<?php endif; ?>
	<div class="sidebar_index mq-dn-lg">
		<h3 class="index-title">目次</h3>
		<?php echo add_index();?>
	</div>
</aside>