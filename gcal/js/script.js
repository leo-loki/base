// JavaScript Document

$(document).ready(function() {

 $('#calendar').fullCalendar({
  header: {
   left: 'prev,next today',
   center: 'title',
   right: 'month,listYear'
  },
  timezone: 'Asia/Tokyo', // タイムゾーン設定
  displayEventTime: false, // リストビューに時間列を表示しない設定
  // Google API KEY の設定
  googleCalendarApiKey: 'AIzaSyD0kAaYTT64iz2BjCgOjsl4D2iLvN3Bhrk',
  eventSources: [
   { // Googleカレンダー１（日本の休日カレンダー）IDの設定
    googleCalendarId: 'ja.japanese#holiday@group.v.calendar.google.com',
    rendering: 'background',color: '#FCC', // 文字を非表示にして背景色を変える設定
    className: 'jp-holiday' // クラス名を付加
   }
   ,{ // Googleカレンダー２（定休日用サンプル）IDの設定
    googleCalendarId: 'b343fpde769ggqpe2jcm8j2d88@group.calendar.google.com',
    rendering: 'background',color: '#FCC', // 文字を非表示にして背景色を変える設定
    className: 'holiday' // クラス名を付加
   }
   ,{ // Googleカレンダー３（イベント用サンプル）IDの設定
    googleCalendarId: '26q4rn51itffiti31ahv9efdrc@group.calendar.google.com',
    backgroundColor: '#C99', // 背景色を変える設定
    borderColor: '#C99',
    textColor: '#FFF',
    className: 'event' // クラス名を付加
   }
   ,{ // Googleカレンダー４（特別イベント用サンプル）IDの設定
    googleCalendarId: 'fh2anld1dvivcrmhd2b1q58hbs@group.calendar.google.com',
    backgroundColor: '#533', // 背景色を変える設定
    borderColor: '#533',
    textColor: '#FFF',
    className: 's-event' // クラス名を付加
   }
  ],
  eventClick: function(event) { // イベントリストをクリックしたら別窓で開く設定
   // opens events in a popup window
   window.open(event.url, 'gcalevent', 'width=640,height=360');
   return false;
  },
  loading: function(bool) {
   $('#loading').toggle(bool);
  }
 });

});
