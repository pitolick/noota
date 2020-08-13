<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
	<div class="search-form-wrap">
		<input type="search" class="search-field" placeholder="キーワードを入力" value="<?php echo get_search_query() ?>" name="s" title="このフィールドを入力してください。" />
		<button type='submit' class="search-submit"><i class="fas fa-search"></i></button>
	</div>
</form>