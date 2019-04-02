// jQuery Document

$(function(){
	/* Section ID setting */
	var wrapId = "#contents";
	var secId = [
  "#sec01",
  "#sec02",
  "#sec03",
  "#sec04",
  "#sec05"
 ];
	var footerArea = "#common-footer";
	/* /Section ID setting */

	/* other variable setting */
	var navId = "mainMenu"; // navi block
	var speed = 500; // smooth scroll speed
	/* /other variable setting */
	var boxWrap = $(wrapId),
     navi = $(navId),
     win = $(window),
     footer = $(footerArea),
     winWidth, winHeight,
     posArr = new Array(),
     posX = new Array();
 $("html, body").animate({opacity: 0}, speed, 'swing');
	/* position check */
	function posCheck(){
		winWidth = win.width(), winHeight = win.height();
  var limit = winHeight/3*2,
      limit2 = -limit,
      offsetY = 0;
		for(var i=0; i<secId.length; i++) {
			posArr[i] = $(secId[i]).offset().top;
   if((posArr[i] < limit)&&(posArr[i] > limit2)){
    $(secId[i]).find('.layer').removeClass('fade-out').addClass("fade-in");
   } else {
    $(secId[i]).find('.layer').removeClass('fade-in').addClass("fade-out");
   }
		}
		if(posArr[0] < 0){ offsetY -= posArr[0]; }
  for(var i=0; i<secId.length; i++) {
			posArr[i] += offsetY;
   posX[i] = $(secId[i]).offset().top;
		}
  if(posX[0] < 0){
   footer.css({"display": "flex"});
   footer.removeClass('fade-out').addClass("fade-in");
   footer.css({"opacity": 1});
  } else {
   footer.removeClass('fade-in').addClass("fade-out");
   footer.css({"display": "none"});
   footer.css({"opacity": 0});
  }
		return winWidth, winHeight, posArr;
 }
	/* /position check */
 
	/* event set */
	win.load(function(){
  posCheck();
  $("html, body").animate({opacity: 1}, speed, 'swing');
 });
	win.resize(function(){ posCheck(); });
 boxWrap.scroll(function() {
  posCheck();
		$("#mainMenu").prop("checked", false);
 });
	/* /event set */

	/* smooth scroll */
	$('a[href^="#"]').click(function(){
		var href = $(this).attr("href");
		var target = $(href == "#" || href == "" ? 'html' : href);
		var targetID = target.selector;
		var position = 0;
		for(var i=0; i<secId.length; i++) {
			if(targetID == secId[i]){
    position = posArr[i];
    break;
			}
		}
		boxWrap.animate({scrollTop:position}, speed, 'swing');
		return false;
	});
	/* /smooth scroll */
});
