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
	// 検索フォーム設定
	add_theme_support( 'html5', array( 'search-form' ) );
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
	wp_enqueue_script('bundle', get_stylesheet_directory_uri() . '/js/bundle.js', array('jquery'));
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
 * 管理画面に設定項目追加
 * 参考：https://www.nxworld.net/wordpress/wp-add-settings-field.html
 */
function search_field() {
	// 検索機能無効化
  add_settings_field( 'search_disable', '検索機能', 'search_option', 'discussion' );
	register_setting( 'discussion', 'search_disable' );
}
add_filter( 'admin_init', 'search_field' );
/* 管理画面設定項目DOM */
function search_option() {
	// 検索機能無効化
  ?>
	<fieldset>
  	<p class="description">検索フォームの機能を以下のパターンから選択できます。</p>
		<label><input name="search_disable" type="radio" value="enable" <?php checked( 'enable', get_option( 'search_disable' ) ); ?> />検索機能を有効にする</label><br>
		<label><input name="search_disable" type="radio" value="disable" <?php checked( 'disable', get_option( 'search_disable' ) ); ?> />検索機能を無効にする</label><br>
		<label><input name="search_disable" type="radio" value="shifter_algolia" <?php checked( 'shifter_algolia', get_option( 'search_disable' ) ); ?> />ShifterWordPressとAlgoliaを併用する</label>
	</fieldset>
  <?php
}

/* SNSシェアボタン設定 */
function share_field() {
  add_settings_field( 'share_option', 'SNSシェアボタン設定', 'share_options', 'discussion' );
  register_setting( 'discussion', 'twitter_via' );
  register_setting( 'discussion', 'twitter_related' );
  register_setting( 'discussion', 'twitter_hashtags' );
}
add_filter( 'admin_init', 'share_field' );
function share_options() {
	// Twitterシェアボタン設定
  ?>
	<fieldset>
		<p class="description">【Twitterシェアボタン】</p>
		<p class="description">ツイート内に含むユーザ名</p>
		@<input name="twitter_via" id="twitter_via" type="text" value="<?php echo esc_html( get_option( 'twitter_via' ) ); ?>" maxlength="15" class="regular-text" />
		<p class="description">ツイート後に表示されるユーザー</p>
		@<input name="twitter_related" id="twitter_related" type="text" value="<?php echo esc_html( get_option( 'twitter_related' ) ); ?>" maxlength="15" class="regular-text" />
		<p class="description">ハッシュタグ</p>
		#<input name="twitter_hashtags" id="twitter_hashtags" type="text" value="<?php echo esc_html( get_option( 'twitter_hashtags' ) ); ?>" maxlength="100" class="regular-text" />
	</fieldset>
  <?php
}

/**
 * 検索機能を無効化
 * 参考：https://www.lancork.net/2015/04/how-to-disable-wordpress-search-function/
 */
function fb_filter_query( $query, $error = true ) {
	if ( is_search() && get_option( 'search_disable' ) === 'disable' ) {
			$query->is_search = false;
			$query->query_vars['s'] = false;
			$query->query['s'] = false;
			// to error
			if ( $error == true ) {
				$query->is_404 = true;
			}
	}
}

add_action( 'parse_query', 'fb_filter_query' );
add_filter( 'get_search_form', function($a){return null;} );

/**
 * 記事内最初の画像を取得
 * $get_size: 取得する画像のサイズ
 * $altimg_id: 代替画像のID。（画像はあらかじめメディアライブラリからアップロードしておく）
 *             nullの場合、投稿内に画像が無ければ何も出力しない
 * 参考：https://qiita.com/ryujisanagi/items/96d5d67bb9fc4cf8315a
 */
function catch_thumbnail_image($get_size = 'full', $altimg_id = null) {
	global $post;
	$image = '';
	$image_id = '';
	$image_get = preg_match_all( '/<img.+class=[\'"].*wp-image-([0-9]+).*[\'"].*>/i', $post->post_content, $matches );
	if( isset($matches[1][0]) ) {
		$image_id = $matches[1][0];
	}
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
 * 使い方：[bloginfo info='name']
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

/**
 * 目次を追加
 * add_filter('the_content', 'add_index');
 * 上記を追加することでthe_content()内に自動追加
 * 参考：https://u-web-nana.com/function-table-of-contents/
 */
/* 目次に合わせて見出しにID付与 */
function generate_index($content) {
	// 目次用コンテンツを生成
	if (is_single()) {
		$elements = search_index($content);

		// 1つ以上該当の要素があったら
		if (count($elements) >= 1) {
			// 初期化
			$toc = '';
			$i = 0;
			$currentlevel = 0;
			$id = 'chapter-';

			foreach ($elements as $element) {
				// 順番に応じてid属性を付与
				$id .= $i + 1;
				$replace_title = preg_replace('/<(h[1-6])>(.+?)<\/(h[1-6])>/s', '<$1 id="' . $id . '" class="js-index-heading">$2</$3>', $element[0]);
				$content = str_replace($element[0], $replace_title, $content);
				$i++;
				$id = 'chapter-';
			} // end foreach

			$h2 = '/<h2.*?>/i';
			if (preg_match($h2, $content, $h2s)) {
				$content = preg_replace($h2, $h2s[0], $content, 1);
			}
		}
	}
	return $content;
}
/* 見出しの数検索 */
function search_index($content = ''){
	$elements = false;
	if (is_single()) {
		if(!$content){$content = get_the_content();}
		// 正規表現で属性を持たないh1～h6を検索
		$pattern = '/<h[1-6]>(.+?)<\/h[1-6]>/s';
		preg_match_all($pattern, $content, $elements, PREG_SET_ORDER);
	}
	return $elements;
}
add_filter('the_content', 'generate_index');
/* 目次DOM生成 */
function add_index($content = ''){
	if (is_single()) {
		if(!$content){$content = get_the_content();}
		// id付与済みのcontentを取得
		$elements = search_index($content);

		// 1つ以上該当の要素があったら
		if (count($elements) >= 1) {
			// 初期化
			$toc = '';
			$i = 0;
			$currentlevel = 0;
			$id = 'chapter-';

			foreach ($elements as $element) {
				$id .= $i + 1;
				// ネストを計算
				if (strpos($element[0], '<h2') !== false) {
					$level = 1;
				} elseif (strpos($element[0], '<h3') !== false) {
					$level = 2;
				} elseif (strpos($element[0], '<h4') !== false) {
					$level = 3;
				} elseif (strpos($element[0], '<h5') !== false) {
					$level = 4;
				} elseif (strpos($element[0], '<h6') !== false) {
					$level = 5;
				}

				// ネスト用に要素を追加
				while ($currentlevel < $level) {
					if ($currentlevel === 0) {
						$toc .= '<ul class="index-list">';
					} else {
						$toc .= '<ul class="index-list_child">';
					}
					$currentlevel++;
				}
				while ($currentlevel > $level) {
					$toc .= '</li></ul>';
					$currentlevel--;
				}

				// 目次の項目で使用する要素を指定
				$toc .= '<li class="index-item"><a href="#' . $id . '" class="index-link js-index">' . $element[1] . '</a>';
				$i++;
				$id = 'chapter-';
			} // end foreach

			// 目次の最後の項目をどの要素から作成したかによりタグの閉じ方を変更
			while ($currentlevel > 0) {
				$toc .= '</li></ul>';
				$currentlevel--;
			}

			// 目次出力用に最終整形
			$index = '<div class="single-index index">' . $toc . '</div>';
		}
	}
	return $index;
}
add_shortcode( 'add_index', 'add_index' );