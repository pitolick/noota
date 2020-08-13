<?php get_header(); ?>
<main id="content">
	<article id="post-0" class="post not-found">
		<header class="header">
			<h1 class="entry-title">404 Not Found</h1>
		</header>
		<div class="entry-content">
			<h2>ページが見つかりませんでした。</h2>
			<h3>お探しのページはいずれかの理由により見つかりませんでした。</h3>
			<ol>
				<li>ページのURLが変更された可能性があります。</li>
				<li>ページが削除された可能性があります。</li>
				<li>アドレス（URL）をタイプミスしている可能性があります。</li>
			</ol>
			<h3>解決方法</h3>
			<ol>
				<li>URLが正しく入力されているかご確認ください。</li>
				<li><a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_html(get_bloginfo('name')); ?>" rel="home">ホームに戻る</a>。</li>
			</ol>
		</div>
	</article>
</main>
<?php get_sidebar(); ?>
<?php get_footer();
