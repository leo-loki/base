<?php /*
基本的に投稿内容（.entry_content）ブロックの殆どが遅延表示されますが、
そのまま表示されるブロックを遅延表示したい場合は、
そのブロックに「delay」を含めた追加クラスをつけてください。
*/ ?>
<!-- ScrollReveal setting. -->
<script src="https://unpkg.com/scrollreveal"></script>
<script type="text/javascript">
<?php
 $var_delay = 500;
 $var_duration = 800;
 $optionPlus = $var_duration;
 if($scroll_delay_reverse){
  $optionPlus .= ", reset: true";
 }
?>
 var sr = ScrollReveal();
 <?php /* 遅延表示を反復させないブロック */ ?>
 sr.reveal('.page_header', { delay: <?=$var_delay?>, origin: 'right', duration: <?=$var_duration?> });
 sr.reveal('.entry_header', { delay: <?=$var_delay?>, origin: 'right', duration: <?=$var_duration?> });
 sr.reveal('#bottom-section', { delay: <?=$var_delay?>, duration: <?=$var_duration?> });
 <?php /* 以下、遅延表示を反復させるブロック */ ?>
 sr.reveal('.entry_content div', { delay: <?=$var_delay?>, duration: <?=$optionPlus?> });
 sr.reveal('.entry_content [class*="delay"]', { delay: <?=$var_delay?>, duration: <?=$optionPlus?> });
 sr.reveal('.entry_content [class*="wp-block"]', { delay: <?=$var_delay?>, duration: <?=$optionPlus?> });
 sr.reveal('.entry_content h1', { delay: <?=$var_delay?>, origin: 'left', distance: '50px', duration: <?=$optionPlus?> });
 sr.reveal('.entry_content h2', { delay: <?=$var_delay?>, origin: 'left', distance: '50px', duration: <?=$optionPlus?> });
 sr.reveal('.entry_content h3', { delay: <?=$var_delay?>, origin: 'left', distance: '50px', duration: <?=$optionPlus?> });
 sr.reveal('.entry_content h4', { delay: <?=$var_delay?>, origin: 'left', distance: '50px', duration: <?=$optionPlus?> });
 sr.reveal('.entry_content h5', { delay: <?=$var_delay?>, origin: 'left', distance: '50px', duration: <?=$optionPlus?> });
 sr.reveal('.entry_content h6', { delay: <?=$var_delay?>, origin: 'left', distance: '50px', duration: <?=$optionPlus?> });
 sr.reveal('.entry_content p', { delay: <?=$var_delay?>, origin: 'right', distance: '50px', duration: <?=$optionPlus?> });
 sr.reveal('.entry_content ul', { delay: <?=$var_delay?>, origin: 'right', distance: '50px', duration: <?=$optionPlus?> });
 sr.reveal('.entry_content ol', { delay: <?=$var_delay?>, origin: 'right', distance: '50px', duration: <?=$optionPlus?> });
 sr.reveal('.entry_content nav', { delay: <?=$var_delay?>, origin: 'left', distance: '50px', duration: <?=$optionPlus?> });
 sr.reveal('.entry_content figure', { delay: <?=$var_delay?>, scale: 0.8, duration: <?=$optionPlus?> });
 sr.reveal('.entry_content iframe', { delay: <?=$var_delay?>, origin: 'bottom', distance: '50px', duration: <?=$optionPlus?> });
 sr.reveal('.entry_content .has-text-align-center', { delay: <?=$var_delay?>, origin: 'bottom', distance: '50px', duration: <?=$optionPlus?> });
 sr.reveal('.entry_content .has-text-align-right', { delay: <?=$var_delay?>, origin: 'left', duration: <?=$optionPlus?> });
 sr.reveal('.entry_content .has-background-dim', { delay: <?=$var_delay?>, duration: <?=$optionPlus?> });
 sr.reveal('#comments', { delay: <?=$var_delay?>, origin: 'left', distance: '50px', duration: <?=$optionPlus?> });
 sr.reveal('.commentlist', { delay: <?=$var_delay?>, origin: 'right', distance: '50px', duration: <?=$optionPlus?> });
 sr.reveal('.comment-respond', { delay: <?=$var_delay?>, origin: 'bottom', distance: '50px', duration: <?=$optionPlus?> });
</script>
<!-- /ScrollReveal setting. -->
