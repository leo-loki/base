$(function() {
	var vid ='K_xTet06SUo';
    var player;
    
    $('body').append('<script src="https://www.youtube.com/iframe_api">');
    
    function resizeMovie () {
        var $w = $(window),
              bw = 1200,
              bh = (bw/16) * 9,
              w = $w.width(),
              h = $w.height(),
              mw = w,
              mh =  Math.round(bh * (mw/bw));
        
        if ( mh < h ) {
            mh = h;
            mw = Math.round(bw * (mh/bh));
        }
        
        console.log(w, h, mw, mh);
        
        $('#player').css({
            width: mw,
            height: mh,
            marginTop: (h - mh)/2, 
            marginLeft: (w - mw)/2
        });
            
    }
    
    resizeMovie();
    
    $(window).resize(resizeMovie);
    
    $('#player_cover').click(function() {
        switch(player.getPlayerState()) {
            case 1:
                player.pauseVideo();
                break;
            default:
                player.playVideo();
        
        }
    });
    
    function onPlayerReady(event) {
        $('#loader').delay(2500).animate({"opacity":0}, 800, "swing", function() {
            $(this).css('display', 'none');
        });
        event.target.mute();
    }
    
    function onPlayerStateChange(event) {
        if (event.data == YT.PlayerState.ENDED) {
            player.playVideo();
        }
    }
    
    var onYouTubeIframeAPIReady = function () {
        player = new YT.Player('player', {
            videoId: vid,
            playerVars: { 
                'autoplay': 1,
                'controls': 0,
                'enablejsapi': 1,
                'iv_load_policy': 3,
                'disablekb':1,
                'showinfo':0,
                'rel':0,
                'start': 5
            },
            events: {
                'onReady': onPlayerReady,
                'onStateChange': onPlayerStateChange
            }
        });
    };
    
    window.onYouTubeIframeAPIReady = onYouTubeIframeAPIReady;

});
