<?php if(get_option( 'search_disable' ) === 'shifter_algolia') : ?>
<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
	<div class="search-form-wrap">
		<input type="search" class="search-field" placeholder="検索キーワードを入力" value="<?php echo get_search_query() ?>" name="s" title="このフィールドを入力してください。" />
		<div class="search-submit">
			<i class="fas fa-search"></i>
		</div>
	</div>
</form>
<?php elseif(get_option( 'search_disable' ) !== 'disable'): ?>
<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
	<div class="search-form-wrap">
		<input type="search" class="search-field" placeholder="検索キーワードを入力" value="<?php echo get_search_query() ?>" name="s" title="このフィールドを入力してください。" />
		<button type='submit' class="search-submit"><i class="fas fa-search"></i></button>
	</div>
</form>
<?php endif; ?>