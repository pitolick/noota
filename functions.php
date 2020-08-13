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
 * ピンバックタグ設定
 */
add_action( 'wp_head', 'pingback_header' );
	function pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s" />' . "\n", esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}

/**
 * コメント返信用js設定
 */
add_action( 'comment_form_before', 'enqueue_comment_reply_script' );
	function enqueue_comment_reply_script() {
	if ( get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

/**
 * トラックバック・ピンバックDOM設定
 * comments.php内wp_list_comments()のコールバックとして使用
 */
function custom_pings( $comment ) {
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
	<?php
}

/**
 * コメント数カウント設定
 * wp_list_comments()からトラックバック・ピンバックのカウントを除外
 */
add_filter( 'get_comments_number', 'comment_count', 0 );
function comment_count( $count ) {
	if ( ! is_admin() ) {
		global $id;
		$get_comments = get_comments( 'status=approve&post_id=' . $id );
		$comments_by_type = separate_comments( $get_comments );
		return count( $comments_by_type['comment'] );
	} else {
		return $count;
	}
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

/**
 * bloginfo()をショートコード化
 * Plugin Name: Bloginfo Shortcode
 * Description: Allows bloginfo() as a shortcode.
 * Author: Giuseppe Mazzapica
 * Author URI: http://gm.zoomlab.it
 * License: MIT
 */
add_shortcode('bloginfo', function($atts) {

	$atts = shortcode_atts(array('filter'=>'', 'info'=>''), $atts, 'bloginfo');

	$infos = array(
		'name', 'description',
		'wpurl', 'url', 'pingback_url',
		'admin_email', 'charset', 'version', 'html_type', 'language',
		'atom_url', 'rdf_url','rss_url', 'rss2_url',
		'comments_atom_url', 'comments_rss2_url',
	);

	$filter = in_array(strtolower($atts['filter']), array('raw', 'display'), true)
		? strtolower($atts['filter'])
		: 'display';

	return in_array($atts['info'], $infos, true) ? get_bloginfo($atts['info'], $filter) : '';
});