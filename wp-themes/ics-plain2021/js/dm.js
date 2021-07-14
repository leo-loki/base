/* jQuery Dark mode. */
//
/* Dark mode check */
$(function(){
 if($('body').hasClass('is_dark_theme')){
  $.cookie.json = false;
  var darkMode = $.cookie("DarkMode");
  var modeCheck = $('#mode-change');
		//console.log(darkMode);
  // ページ再読み込み時のスイッチ状態判定
  if (darkMode){
   if (darkMode == "Active") {
    if(modeCheck){ modeCheck.prop('checked', true); }
   } else if (darkMode == "notActive") {
    if(modeCheck){ modeCheck.prop('checked', false); }
   }
  } else {
			if(modeCheck){ modeCheck.prop('checked', false); }
		}
  // スイッチ切り替え時の動作
		$('#mode-change').change(function() {
   $.cookie.json = false;
   var darkMode = $.cookie("DarkMode");
   if (darkMode){
    if (darkMode == "Active") {
     $('body').toggleClass('lightmode');
					$('body').removeClass('darkmode');
     $.cookie("DarkMode", "notActive", {expires:30, path:'/'});
					this.checked = false;
				} else {
     $('body').toggleClass('darkmode');
					$('body').removeClass('lightmode');
     $.cookie("DarkMode", "Active", {expires:30, path:'/'});
     this.checked = true;
    }
  } else {
   $('body').toggleClass('lightmode');
   $.cookie("DarkMode", "notActive", {expires:30, path:'/'});
   this.checked = true;
  }
  });
 }
});
/* eof */