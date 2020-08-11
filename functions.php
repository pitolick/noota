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