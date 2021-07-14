/* jQuery Document */
//
/* Smooth scroll */
$(function(){
 $('a[href^="#"]').click(function(){
  var globalHeight = $('.site-header').outerHeight();
  var adminbarHeight = $('#wpadminbar').outerHeight();
  var speed = 500;
  var href = $(this).attr("href");
  var target = $(href == "#" || href == "" ? 'html' : href);
		var position;
		if(adminbarHeight){
			if(globalHeight){
				position = target.offset().top - globalHeight - adminbarHeight;
			} else {
				position = target.offset().top - adminbarHeight;
			}
		} else if(globalHeight) {
			position = target.offset().top - globalHeight;
		} else {
			position = target.offset().top;
		}
		$("html, body").animate({scrollTop:position}, speed, "swing");
  return false;
 });
});
/* eof Smooth scroll */
/* display switching */
 $(function() {
		$(document).ready(function(){
			/* 対象1の処理 */
   var target = $('.scroll_disp'); // 対象1
			target.hide(); // 対象1をいったん非表示
			var basis = $('#site-header'); // 対象処理の基準となるブロック
			var headerHeight = basis.outerHeight(); // 基準ブロック1の高さを算出
   var dispPosition = headerHeight + 32; // 切替位置を設定（余裕：32px加算）
			if ($(window).scrollTop() > dispPosition) {
				target.addClass('disp').show();
			} else {
				target.removeClass('disp').show();
			}
			var showFlag = false;
			/**/
			/* 対象2の処理 */
   var target2 = $('.admin_bar_relation'); // 対象2
			var basis2 = $('#wpadminbar'); // 対象処理の基準となるブロック
			var basis2Height = 0; // 基準ブロック高さ変数を初期化
			if(basis2){
				basis2Height = basis2.outerHeight(); // 基準ブロックの高さを算出
				if ($(window).scrollTop() > basis2Height) {
					target2.addClass('related');
				} else {
					target2.removeClass('related');
				}
				var relationFlag = true;
			}
			/**/
			/* スクロール処理 */
   $(window).scroll(function () {
				/* 対象1 */
    if ($(this).scrollTop() > dispPosition) {
					target.addClass('disp');
     if (showFlag == false) { showFlag = true; }
    } else {
					target.removeClass('disp');
     if (showFlag) { showFlag = false; }
    }
				/* 対象2 */
				if (($(this).scrollTop() > basis2Height)&&(relationFlag)) {
					target2.addClass('related');
    } else {
					target2.removeClass('related');
    }
   });
   /**/
   /* main navi switching */
   $(window).on('load resize', function(){
    var minWindowSize = 1024;
    var ww = $(window).innerWidth();
    if(ww >= minWindowSize){
     var targetMenu = $('.menu-item-has-children');
     var childMenu = $('.sub-menu');
     //var msg = 'OK';
     targetMenu.each(function(e){
      var pos = targetMenu.eq(e).offset();
      //var childPos = targetMenu.eq(e).children(childMenu).offset();
      var w = targetMenu.eq(e).innerWidth();
      var childW = targetMenu.eq(e).children(childMenu).innerWidth();
      var maxWidth = pos.left + w + childW;
      if(maxWidth>=ww){
       targetMenu.eq(e).addClass('left_side');
      } else {
       targetMenu.eq(e).removeClass('left_side');
      }
     });
    }
   });
   /**/
			/* リサイズ処理 */
   $(window).resize(function () {
				/* 対象1 */
    if ($(this).scrollTop() > dispPosition) {
					target.addClass('disp');
     if (showFlag == false) { showFlag = true; }
    } else {
					target.removeClass('disp');
     if (showFlag) { showFlag = false; }
    }
				/* 対象2 */
				if (($(this).scrollTop() > basis2Height)&&(relationFlag)) {
					target2.addClass('related');
    } else {
					target2.removeClass('related');
    }
   });
  });
 });
/* eof display switching */
//
/* WP RSSリンクに「target="_blank"」を追加 */
$(function() {
 $('a.rsswidget').each(function(){
  $(this).attr('target','_blank');
 });
});
//
/* WP カレンダーの処理 */
$(function() {
 var targetCal = $('#wp-calendar');
 targetCal.each(function(){
  var titleCheck = $('th:first-child', this).attr('title');
  var childName = 'tr td';
  var wk_array;
  var wk_array_class = ['sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat'];
  var wk_limit = wk_array_class.length;
  var start_child_num = 0;
  var cols = Number( $( 'tr td:first-child').attr('colspan') );
  if(titleCheck.indexOf("曜") > -1){
   wk_array = ['日曜', '月曜', '火曜', '水曜', '木曜', '金曜', '土曜'];
  } else {
   wk_array = wk_array_class;
  }
  // 開始曜日チェック
  $.each(wk_array, function(index, value){
   var wk_name = wk_array_class[index];
   var className = 'start_' + wk_name;
   // 開始曜日を判定してターゲット（テーブル）にクラス名を付与
   if(titleCheck.toLowerCase().indexOf(value) > -1){
    targetCal.addClass(className);
    start_child_num = Number( index - 1 );
   }
   // 開始曜日を判定してターゲット（テーブル）にクラス名を付与 終了
  });
  // 開始曜日チェック 終了
  // ターゲットの子要素（td）にクラス名を付与
  if(cols > 0){
   start_child_num = cols + start_child_num;
   if(start_child_num >= wk_limit){
    start_child_num = start_child_num - wk_limit;
   }
  }
  var childClass;
  var child_num = start_child_num;
  $(childName).each(function(){
   if(child_num >= wk_limit){
    child_num = 0;
   }
   childClass = wk_array_class[child_num];
   $(this).addClass(childClass);
   child_num ++ ;
  });
  // ターゲットの子要素（td）にクラス名を付与 終了
 });
});
/* WP カレンダーの処理 終了 */
//
/* eof */