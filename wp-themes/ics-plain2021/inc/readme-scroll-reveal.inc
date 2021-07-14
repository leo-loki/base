<?php
/***
Scroll Reveal に関する情報は、
Scroll Reveal 等でご確認ください。
https://scrollrevealjs.org/
***/
/*
Scroll Reveal - オプション設定例
 origin: 'left', // アニメーション開始位置（'top', 'bottom', 'left', 'right'）
 distance: '0px', // 移動距離（%, em, vw, px 等）
 scale: 1, // 拡大比率（１＝等倍）縮小状態から通常サイズへの拡大表示なら「opacity: 0〜1」でも可
 rotate: { x: 0, y: 0, z: 0 }, // 回転（x：縦回転、y：横回転、z：傾き）
 delay: 500, // 要素が表示されるまでの待機時間（ミリ秒）
 duration: 800 // アニメーション速度（ミリ秒）
*/
/**/
/*
【注意点】
画面全幅表示の要素に対して
遅延の反復オプション「reset: true」を設定した場合、
「origin」オプションで左右いずれかを開始とし、
「distance」オプションで移動距離を設定した場合、
その要素が非表示の時、サイト全体に移動距離分の余白ができてしまう。
その場合、Scroll Revealを適用している要素の親要素に
「overflow-x: hidden;」を設定すると余白を無くすことができる。

「overflow-x: hidden;」を設定した親要素が一瞬スクロールできない（縦スクロールバーが表示される）状態になる場合、
親要素のプロパティを「overflow-x: hidden;」ではなく「height: 100%; overflow: hidden;」に設定すると回避できる。
※ただし、親要素はブロック要素であること。
*/
/**/
?>