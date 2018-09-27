<?php
/* ++++++++++ PHP mail form system ++++++++++ */
//
// Original PHP mail form system Ver.2.1.1
//
// author :  Design ofiice IRUYA.
// website : https://iruya.jp/
// contact : info@iruya.jp
//
/* ++++++++++++++++++++++++++++++++++++++++++ */

if($sendFlag){

/* ===== POST setup ===== */
/* ----- POST 処理 ----- */
if((isset($_POST['subject']))&&($_POST['subject']!="")){	$subject = $_POST['subject']; } else {	$subject = "DVDのご注文"; }
if((isset($_POST['site_name']))&&($_POST['site_name']!="")){	$site_name = $_POST['site_name']; }
if((isset($_POST['site_mail']))&&($_POST['site_mail']!="")){	$site_mail = $_POST['site_mail']; }
if((isset($_POST['send_name']))&&($_POST['send_name']!="")){	$send_name = $_POST['send_name']; }
if((isset($_POST['send_mail']))&&($_POST['send_mail']!="")){	$send_mail = $_POST['send_mail']; }
if((isset($_POST['get_mail']))&&($_POST['get_mail']!="")){	$get_mail = $_POST['get_mail']; }
if((isset($_POST['bcc_mail']))&&($_POST['bcc_mail']!="")){	$bcc_mail = $_POST['bcc_mail']; } else {	$bcc_mail = false; }
if((isset($_POST['back_url']))&&($_POST['back_url']!="")){	$back_url = $_POST['back_url']; }

/* 送信内容のセット */
if((isset($_POST['name']))&&($_POST['name']!="")){	$name = $_POST['name']; }
if((isset($_POST['kana']))&&($_POST['kana']!="")){	$kana = $_POST['kana']; }
if((isset($_POST['email']))&&($_POST['email']!="")&&(isset($_POST['email2']))&&($_POST['email2']!="")){	$email = $_POST['email']."@".$_POST['email2']; }
if((isset($_POST['texts']))&&($_POST['texts']!="")){
	$texts = " ".$_POST['texts'];
	$textHtml = str_replace("\n", "<br />", $texts);
}
	$msg = "お名前：".$name."\r\n";
	$price = array(18000,90000);
$msg .= "フリガナ：".$kana."\r\n".
"e-mail：".$email."\r\n";
$msg .= "お問合せ内容：\r\n".$texts."\r\n";
/* /送信内容のセット */

/* ----- POST 処理 ----- */
/* ===== /POST setup ===== */

}
?>

<!-- #form -->
<div id="form">
<h3>お問合せ内容のご確認</h3>

<?php if($sendFlag){ ?>

<!-- form -->
<form action="./?mode=send" method="post" id="form1">
<fieldset>
<table id="stripe" width="100%" cellpadding="0" cellspacing="1" border="0">
<tbody>
<tr>
<th width="20%">お名前</th>
<td><?=$name?></td>
</tr>
<tr>
<th>フリガナ</th>
<td><?=$kana?></td>
</tr>
<tr>
<th>e-mail</th>
<td><?=$email?></td>
</tr>
<tr>
<th>お問合せ内容</th>
<td><?=$textHtml?></td>
</tr>
</tbody>
</table>
</fieldset>
<div class="caption"><em>※</em>以上の内容で宜しければ送信ボタンを押してしてください。</div>
<p class="submit">
<input type="submit" value="送　信" class="buttonRed" /> <input type="button" value="<?php if($langFlag){ ?>BACK<?php } else { ?>戻　る<?php } ?>" onclick="<?=$page_back?>" class="buttonSlv" />
</p>
<input type="hidden" name="send" value="send" />
<input type="hidden" name="name" value="<?=$name?>" />
<input type="hidden" name="email" value="<?=$email?>" />
<input type="hidden" name="msg" value="<?=$msg?>" />
<input type="hidden" name="subject" value="<?=$subject?>" />
<input type="hidden" name="site_name" value="<?=$site_name?>" />
<input type="hidden" name="site_mail" value="<?=$site_mail?>" />
<input type="hidden" name="send_name" value="<?=$send_name?>" />
<input type="hidden" name="send_mail" value="<?=$send_mail?>" />
<input type="hidden" name="get_mail" value="<?=$get_mail?>" />
<?php if($bcc_mail){ ?><input type="hidden" name="bcc_mail" value="<?=$bcc_mail?>" /><?php } ?>
<input type="hidden" name="back_url" value="<?=$back_url?>" />
</form>
<!-- /form -->

<?php } else { ?>

<!-- form.back -->
<form action="<?=$back_url?>" class="back">
<h2 class="send"><?php	if($langFlag){ print("ERROR : Send Mail Incomplete."); } else { print("エラー：チェック失敗"); } ?></h2>
<p><em><?php if($langFlag){ print("Please input a necessary matter to the form."); } else { print("各フォームより必要事項を入力してお送りください。"); } ?></em></p>
<div class="back"><input type="submit" value="TOPへ戻る" onclick="location.href = '<?=$page_back?>';" class="buttonSlv" /></div>
</form>
<!-- /form.back -->

<?php } ?>

</div>
<!-- /#form -->