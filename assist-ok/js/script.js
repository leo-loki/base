/* jQuery Document */

	$(function(){
	 $('a[href^=#]').click(function(){
		 var speed = 500; // スクロールの速度（ミリ秒）
		 var href = $(this).attr("href");
		 var target = $(href == "#" || href == "" ? 'html' : href);
		 var position = target.offset().top;
		 $('body,html').animate({scrollTop:position}, speed, 'swing');
		 return false;
	 });
	});

	$(function() {
		var pm1 = 1024;	// 背景画像の最大幅（px）を定義
		var pm2 = 54;	// 表示場所の幅（％）PC用を定義
		
		// IDセット
		var boxWrap = $('#headline');
		var box01 = $('#header');
		var box02 = $('#catch-lead');
		var box03 = $('#date-place');
		var box04 = $('#feature');
		var subtitle = $('#global-subtitle');
		var title = $('#global-title');
		var pgtop = $('#pagetop');
		
		// オフセット値セット
		var boxWrapSet = boxWrap.offset();
		
		// アニメーション要素の初期状態を設定
		subtitle.css('display', 'block').css('opacity', 1);
		title.css('display', 'none').css('opacity', 0);
		pgtop.css('display', 'none').css('opacity', 0);
		
		// Window 調整の関数定義
		function winResize(pm1, pm2){
			// レスポンシブ用ブレークポントの定義
			var bp1 = 600; // モバイル用
			var bp2 = 960; // タブレット用
			var bp3 = bp2 / pm2 * 100; // 左右に余白が取れるまでのサイズ
			var bp4 = 1280 // PCとタブレットのランドスケープ
			// ブロック要素（ID）の定義
			var boxWrap = $('#headline');
			var box01 = $('#header');
			var box02 = $('#catch-lead');
			var box03 = $('#date-place');
			var box04 = $('#feature');
			var wrap = $('.wrap');
			var img1 = document.getElementById("img1");
			var img2 = document.getElementById("img2");
			// Windowサイズの取得
			var winWidth = $(window).width(); // 幅
			var winHeight = $(window).height(); // 高
			// 背景画像の処理
			var bgImg = boxWrap.css("background-image"); // CSSから背景画像の情報を取得
			var bgImgFile = bgImg.substring(4, bgImg.length -1); // 背景画像の情報からファイルパスを取得
			var imageObj = new Image(); // 背景画像用のオブジェクトを生成
			imageObj.src = bgImgFile.match(/[-_.!~*'()a-zA-Z0-9;\/?:@&=+$,%#]+[a-z]/g); // 画像オブジェクトに背景画像のファイルパスを設定
			var oriWidth = imageObj.width; // 背景画像（元画像）の幅を取得
			var oriHeight = imageObj.height; // 背景画像（元画像）の高を取得
			// 表示場所の幅を調整
			var maxWidth = pm1;	// 背景画像の最大幅（px）を引数から代入
			var defWidth = winWidth * pm2 / 100; // Window幅の初期値をWindow幅と引数で算出
			var boxWidth = defWidth; // 表示場所の幅を仮設定
			if(winWidth < bp1){ // Windowがモバイル用ブレイクポイントよりもを小さい場合の調整
				img1.src = "img/top/scds.jpg";
				img2.src = "img/top/takujis.jpg";
			} else {
				img1.src = "img/top/scd.jpg";
				img2.src = "img/top/takuji.jpg";
			}
			if(winWidth < bp2){ boxWidth = winWidth; } // Windowがタブレット用ブレイクポイントよりもを小さい場合の調整
			else if(winWidth < bp3){ boxWidth = bp2; } // Windowが余白を取れるブレイクポイントよりもを小さい場合の調整
			var reWidth = boxWidth; // リサイズ用の変数定義
			if(reWidth >= maxWidth){ reWidth = maxWidth; } // リサイズ値が背景画像の最大幅を超えた場合の調整
			// 表示場所の高さを調整
			var boxHeight = winHeight; // 表示場所の高さをWindowサイズで仮設定
			var ratio = oriHeight / oriWidth; // 背景画像の縦比率を算出
			var reHeight = boxWidth * ratio; // 横幅に背景画像の縦比率をかけて高さを算出
			// 表示場所の高さがWindowサイズを超えた場合の調整
			if(reHeight >= winHeight){
				reHeight = winHeight; // 表示場所の高さをWindowサイズに合わせて
				reWidth = reHeight / ratio; // 表示場所の幅を再調整
			}
			// 表示場所をリサイズ
			boxWrap.css('width', reWidth);
			boxWrap.css('height', reHeight);
			// 全体の横幅もリサイズ
			wrap.css('width', reWidth);
		}

		$(document).ready(function() {
			$('body').css('opacity', '0').css('display', 'none');
		});
		$(window).load(function() {
			winResize(pm1, pm2);
			$('body').css('display', 'block').animate({opacity: "1"}, 600);
		});
		
		// Windowリサイズ処理
		var timer = false;
		$(window).resize(function() {
			if (timer !== false) {
				clearTimeout(timer);
			}
			timer = setTimeout(function() {
				// リサイズ処理
				winResize(pm1, pm2);
			}, 200);
		});

		//スクロール時の処理
		$(window).scroll(function() {
			var value = $(this).scrollTop(); //スクロールの値を取得
			box01.css('top', boxWrapSet.top + value / 2);
			box02.css('top', boxWrapSet.top + value / 4);
			box03.css('top', boxWrapSet.top - value / 2);
			box04.css('top', boxWrapSet.top - value);
			
			subtitle.each(function() {
				if (value > 80) {
					$(this).stop().animate({opacity: "0"}, 1500).css('display', 'none');
				} else {
					$(this).stop().css('display', 'block').animate({opacity: "1"}, 1500);
				}
			});
			title.each(function() {
				if (value > 80) {
					$(this).stop().css('display', 'block').animate({opacity: "1"}, 1500);
				} else {
					$(this).stop().animate({opacity: "0"}, 1500).css('display', 'none');
				}
			});
			pgtop.each(function() {
				if (value > 80) {
					$(this).stop().css('display', 'block').animate({opacity: "0.75"}, 1500);
				} else {
					$(this).stop().animate({opacity: "0"}, 1500).css('display', 'none');
				}
			});
			
			/* スクロール時にトグルメニューを閉じる設定 */
			$("#mainMenu").prop("checked", false);
		});
	});
