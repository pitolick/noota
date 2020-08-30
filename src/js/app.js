var $ = require('jQuery');

/**
 * アンカーリンクへスムーズスクロール
 * 参考：https://techacademy.jp/magazine/9532
 */
$(function(){
  $('a[href^="#"]').click(function(){
    var speed = 300;
    var href= $(this).attr("href");
    var target = $(href == "#" || href == "" ? 'html' : href);
    var position = target.offset().top;
    $("html, body").animate({scrollTop:position}, speed, "swing");
    return false;
  });
});

/**
 * 目次フォーカス機能
 */
$(function() {
	/**
	 * 発火
	 */
	add_class_index();
	$(window).scroll(function() {
		add_class_index();
	});

	/**
	 * 全見出しの位置を取得
	 */
	function search_index() {
		var heading = [];
		$('.js-index-heading').each(function() {
			heading.push($(this).offset().top);
		});
		return heading;
	};

	/**
	 * 目次にクラスを追加
	 */
	function add_class_index() {
		var scroll_top = $(window).scrollTop();
		var heading = search_index();
		var heading_length = search_index().length - 1;
		var index_item = [];
		var index_wrap = [];

		// 目次の数を取得
		$('.single-index').each(function() {
			index_wrap.push($(this));
		});

		$.each(index_wrap, function(i, val) {
			// 目次内のaタグを取得
			val.find('.js-index').each(function() {
				index_item.push($(this));
				$(this).removeClass('focus');
			});

			// 目次内のaタグに.focusを付与
			$.each(heading, function(index, value) {
				if((value >= scroll_top) && index > 0) {
					index_item[index - 1].addClass('focus');
					return false;
				} else if(index == heading_length) {
					index_item[index].addClass('focus');
				}
			});

			// 配列初期化
			index_item = [];
		});

	}
})