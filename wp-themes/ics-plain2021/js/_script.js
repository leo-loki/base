/* Smooth scroll */
//var $1124 = $.noConflict(true);

//(function($){
	$(function(){
  $('a[href^="#"]').click(function(){
   var speed = 500;
   var href= $(this).attr("href");
   var target = $(href == "#" || href == "" ? 'html' : href);
   var position = target.offset().top;
   $("html, body").animate({scrollTop:position}, speed, "swing");
   return false;
  });
  //$(function() {});
  /* [TOP] Button animation */
  $(document).ready(function(){
   var mainContainer = $('#container');
   var siteFooter = $('#site-footer');
   var conPallax = $('.entry_content');
   var consulPallax = $('#consul .entry_content');
   var contactPallax = $('#contact .entry_content');
   var topBtn = $('#totop');
   var toggle = $('#toggle-pc');
   var toggleCheck = $('#toggle-check');
   $('.top_bottom.contact').addClass('disp_none');
   $('#menu-bottom-menu').addClass('disp_none');
   //$('.bottom_about_policy').addClass('disp_none');
   $('.content_group').addClass('disp_none');
   $('.item_table').addClass('disp_none');
   var dispOn = $('.disp_on');
   var dispOff = $('.disp_off');
   var dispNone = $('.disp_none');
   var showFlag = false;
   var fadeSpeed = 500; // アニメーションの速度（ミリ秒）
   var dispPosition = 300; // ボタン表示開始位置（px）
   var pallaxSpeed = 1000;
   var pxPos = 80;
   var pallaxPosition, winHeight, winPos, posTop, thisPos;
   mainContainer.hide().css('opacity',0);
   conPallax.hide().css('opacity',0);
   siteFooter.hide().css('opacity',0);
   //conPallaxDiv.addClass("disp_none");
   //before.hide().fadeIn(fadeSpeed);
   //after.hide();
   $(window).load(function(){
    winHeight = $(window).height();
    pallaxPosition = winHeight - pxPos;
    winPos = $(window).scrollTop();
    mainContainer.show().animate({ opacity: 1 }, pallaxSpeed, 'swing');
    conPallax.show().css('opacity',0);
    consulPallax.show().css('opacity',1);
    contactPallax.show().css('opacity',1);
    //$('#results .entry_content').show().animate({ opacity: 1 }, pallaxSpeed, 'swing');
    siteFooter.show().css('opacity',1);
    if (conPallax.length) {
     posTop = conPallax.offset().top;
     posTop = posTop - winPos;
     if (posTop < pallaxPosition) {
      conPallax.show().animate({ opacity: 1 }, pallaxSpeed, 'swing');
     }
    }
    if (dispNone.length) {
     $(dispNone).each(function() {
      if($(this).length){
       thisPos = $(this).offset().top;
       thisPos = thisPos - winPos;
        if (thisPos < pallaxPosition) {
         $(this).removeClass('disp_none').addClass('disp_block');
        }
       }
      });
     }
    /* リサイズ時の動作 */
    $(window).resize(function() {
     winHeight = $(window).height();
     pallaxPosition = winHeight - pxPos;
     winPos = $(window).scrollTop();
     toggleCheck.prop("checked", false);
     if ($(this).scrollTop() < dispPosition) {
      showFlag = false;
      toggle.stop().animate({ opacity: 0 }, fadeSpeed, 'swing');
     }
    });
    /* スクロール時の動作 */
    $(window).scroll(function () {
     winHeight = $(window).height();
     pallaxPosition = winHeight - pxPos;
     winPos = $(this).scrollTop();
     toggleCheck.prop("checked", false);
     if (conPallax.length) {
      posTop = conPallax.offset().top;
      posTop = posTop - winPos;
      if (posTop < pallaxPosition) {
       conPallax.show().animate({ opacity: 1 }, pallaxSpeed, 'swing');
      }
     }
     if (dispNone.length) {
      //var i = 1;
      $(dispNone).each(function() {
       if($(this).length){
        thisPos = $(this).offset().top;
        thisPos = thisPos - winPos;
        //console.log('div' + i + '：' + thisPos);
        if (thisPos < pallaxPosition) {
         $(this).removeClass('disp_none').addClass('disp_block');
        }
        //i ++;
       }
      });
     }
     if ($(this).scrollTop() > dispPosition) {
      if (showFlag == false) {
       showFlag = true;
       topBtn.stop().animate({ bottom: "0.5em", opacity: 1 }, fadeSpeed, 'swing');
       toggle.stop().animate({ opacity: 1 }, fadeSpeed, 'swing');
       dispOn.removeClass('disp_on').addClass('disp_off');
       dispOff.removeClass('disp_off').addClass('disp_on');
      }
     } else {
      if (showFlag) {
       showFlag = false;
       topBtn.stop().animate({ bottom: "-3em", opacity: 0 }, fadeSpeed, 'swing');
       toggle.stop().animate({ opacity: 0 }, fadeSpeed, 'swing');
       dispOn.removeClass('disp_off').addClass('disp_on');
       dispOff.removeClass('disp_on').addClass('disp_off');
      }
     }
    });
    /* 外部からアンカーリンク処理 */
    var headerHeight = $('#site-header').outerHeight() + 40;
    var urlHash = location.hash;
    if(urlHash) {
     $('body,html').stop().scrollTop(0);
     setTimeout(function(){
      var target = $(urlHash);
      var position = target.offset().top - headerHeight;
      $('body,html').stop().animate({scrollTop:position}, 500);
     }, 1000);
    }
    /*$('a[href^="#"]').click(function() {
     var href= $(this).attr("href");
     var target = $(href);
     var position = target.offset().top - headerHeight;
     $('body,html').stop().animate({scrollTop:position}, 500);
    });*/
    });
  });
 });
//})($1124);
