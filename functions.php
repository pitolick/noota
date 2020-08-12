<?php
/**
 * 初期セットアップ
 */
add_action('after_setup_theme', 'noota_setup');
function noota_setup() {
	// titleタグ設定
	add_theme_support('title-tag');
	// フィードのリンクタグ設定
	add_theme_support('automatic-feed-links');
	// アイキャッチ画像設定
	add_theme_support('post-thumbnails');
	// カスタムロゴ設定
	add_theme_support( 'custom-logo' );
	// カスタムメニュー有効化
	register_nav_menus(array(
		'main-menu' => esc_html('Main Menu'),
		'footer-menu' => esc_html('Footer Menu')
	));
}

/**
 * titleタグセパレート文字設定
 */
add_filter('document_title_separator', 'noota_document_title_separator');
function noota_document_title_separator($sep)
{
	$sep = '|';
	return $sep;
}

/**
 * 記事中の続きを読む設定
 */
add_filter( 'the_content_more_link', 'blankslate_read_more_link' );
function blankslate_read_more_link() {
	if ( ! is_admin() ) {
		return ' ...';
	}
}

/**
 * 抜粋文の続きを読む設定
 */
add_filter( 'excerpt_more', 'blankslate_excerpt_read_more_link' );
function blankslate_excerpt_read_more_link( $more ) {
	if ( ! is_admin() ) {
		global $post;
		return ' ...';
	}
}

/**
 * CSS・Javascript読み込み設定
 */
add_action('wp_enqueue_scripts', 'noota_load_scripts');
function noota_load_scripts()
{
	wp_enqueue_style('noota-style', get_stylesheet_uri());
	wp_enqueue_style('noota-common', get_template_directory_uri().'/css/common.css');
	wp_enqueue_script('jquery');
}

/**
 * 画像生成制御
 */
add_filter('intermediate_image_sizes_advanced', 'noota_image_insert_override');
function noota_image_insert_override($sizes)
{
	unset($sizes['medium_large']);
	return $sizes;
}

/**
 * ウィジェット設定
 */
add_action('widgets_init', 'noota_widgets_init');
function noota_widgets_init()
{
	register_sidebar(array(
		'name' => esc_html('Sidebar Widget Area'),
		'id' => 'primary-widget-area',
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
}

/**
 * 記事内最初の画像を取得
 * $get_size: 取得する画像のサイズ
 * $altimg_id: 代替画像のID。（画像はあらかじめメディアライブラリからアップロードしておく）
 *             nullの場合、投稿内に画像が無ければ何も出力しない
 */
function catch_thumbnail_image($get_size = 'thumbnail', $altimg_id = null) {
	global $post;
	$image = '';
	$image_get = preg_match_all( '/<img.+class=[\'"].*wp-image-([0-9]+).*[\'"].*>/i', $post->post_content, $matches );
	$image_id = $matches[1][0];
	if( !$image_id && $altimg_id ){
			$image_id = $altimg_id;
	}
	$image = wp_get_attachment_image( $image_id, $get_size, false, array(
			'class' => 'thumbnail-image',
			'srcset' => wp_get_attachment_image_srcset( $image_id, $get_size ),
			'sizes' => wp_get_attachment_image_sizes( $image_id, $get_size )
	) );
	if( empty($image) ) {
			$image = false;
	}
	return $image;
}