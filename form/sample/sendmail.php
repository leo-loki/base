<?php
/* ++++++++++ PHP form system ++++++++++ */
//
// include file - Sendmail division.
//
/* ++++++++++++++++++++++++++++++++++++++ */

/* ＊＊＊＊＊ POSTメソッドでデータが送られてきた場合の処理 ＊＊＊＊＊ */

if((isset($_POST['name']))&&(isset($_POST['email']))&&(isset($_POST['msg']))&&(isset($_POST['admin_msg']))&&($_POST['mode']==="send")){

$success = false;

/* ===== 文字コード環境の設定 ===== */
if(isset($langFlag)){
	mb_language("en");
	$inchr = "UTF-8";
	$outchr = "UTF-8";
} else {
	mb_language("ja");
	$inchr = "UTF-8";
	$outchr = "JIS";
}
/* ===== /文字コード環境の設定 ===== */

/* ===== POST setup ===== */

$name = $_POST['name'];
$email = $_POST['email'];
$msg = "".$_POST['msg'];
$admin_msg = "".$_POST['admin_msg'];

/* ===== /POST setup ===== */

/* ===== mail setup ===== */

/* subject setup */
if(isset($langFlag)){
	$mail_subject = 'Confirmation of '.$subject;
 $add_subject = "[Caution]".$subject;
} else {
 $add_subject = "【重要】お客様からの".$subject;
	$mail_subject = '【'.$subject.'内容のご確認】';
}
/* /subject setup */

/* encode */
$name = mb_convert_encoding($name, $outchr, $inchr);
$mail_subject = mb_convert_encoding($mail_subject, $outchr, $inchr);
$add_subject = mb_convert_encoding($add_subject, $outchr, $inchr);
/* /encode */

/* ----- 利用者への確認メール文（ここから） ----- */

if(isset($langFlag)){
	$body = 'Dear '.$name.' - '.date('j.n.Y')."\r\n";
} else {
	$body = $name.' 様　'.date('Y年n月j日')."\r\n";
}

$body .= "\r\n".
$site_name.'へ'.$subject.'いただき誠に有り難うございます。' . "\r\n".
'下記の内容で承りました。' . "\r\n".
'後日、担当者からご連絡させていただきますので、いましばらくお待ちください。' . "\r\n".
"\r\n";

$body .= '--------------------------------------------------' . "\r\n".
"\r\n";
if(isset($langFlag)){
$body .= '[ SEND MAIL INFORMATION ]'. "\r\n";
} else {
$body .= '【受信内容】'. "\r\n";
}
$body .= "\r\n".$msg.
"\r\n".
"\r\n".
"※本メールへの返信はできません。\r\n".
'ご不明な点がございましたら、下記の代表メールまたは電話番号まで直接ご連絡ください。' . "\r\n".
"\r\n".
'今後とも宜しくお願いいたします。' . "\r\n".
"\r\n".
'==================================================' . "\r\n".
$add_name . "\r\n";
$body .= $address. "\r\n";
$body .= 'TEL : '.$tel.' / FAX : '.$fax. "\r\n";
$body .= 'e-mail < '.$site_mail.' >' . "\r\n";
$body .= 'URL : '.$site_url. "\r\n".
'==================================================' . "\r\n";

/* ----- /利用者への確認メール文（ここまで） ----- */

/* ----- 運営者への受信メール文（ここから） ----- */

if(isset($langFlag)){
	$add_body = 'Dear Administrator.' . "\r\n";
} else {
	$add_body = '担当者 様' . "\r\n";
}
$add_body .= "\r\n".
'【'.$subject.'フォームからの通知】　'.date('Y年n月j日')."\r\n".
"\r\n".
$name.' 様より'.$subject.'を頂きました。' . "\r\n".
'下記の送信内容につきましてご確認、ご対応ください。' . "\r\n".
"\r\n";
$add_body .= '--------------------------------------------------' . "\r\n".
"\r\n";
if(isset($langFlag)){
$add_body .= '[ SEND MAIL INFORMATION ]'. "\r\n";
} else {
$add_body .= '【受信内容】'. "\r\n";
}
$add_body .= "\r\n".$admin_msg.
"\r\n".
'==================================================' . "\r\n".
$send_name . ' - WEB FORM SYSTEM'."\r\n";
$add_body .= ' * e-mail < '.$send_mail.' >' . "\r\n";
$add_body .= ' * address : '.$address. "\r\n";
$add_body .= ' * URL : '.$site_url. "\r\n".
'==================================================' . "\r\n";

/* ----- /運営者への受信メール文（ここまで） ----- */

/* ----- Mail header setup and Send（利用者への確認メール送信）start ----- */

function send_mail($send_mail, $site_mail, $email, $mail_subject, $body, $send_name, $inchr, $outchr){
 //X-Mailerをphpversition等で指定するとHotMailでは迷惑メールとして扱われる
 $send_name = mb_convert_encoding($send_name, $outchr, $inchr);
 $body = mb_convert_encoding($body, $outchr, $inchr);
 if(isset($mail_subject)){ $mail_subject = mime_enc($mail_subject); }
 $body = str_replace("\r\n", "\n", $body);
 $body = str_replace("\r" , "\n", $body);
 if(isset($send_name)){
  $head .= 'From: "'.mime_enc($send_name).'" <'.$send_mail.'>'."\n";
 }else{
  $head .= 'From: "'.$send_mail.'" <'.$send_mail.'>'."\n";
 }
 $head.= "X-Originating-IP: [{$_SERVER['SERVER_ADDR']}]\n";
 $head.= "X-Originating-Email: [{$send_mail}]\n";
 $head.= "X-Sender: {$send_mail}\n";
 $head.= "Mime-Version: 1.0\n";
 if(isset($langFlag)){
  $head.= "Content-Type: text/plain; charset=iso-8859-1\n";
 } else {
  $head.= "Content-Type: text/plain;charset=ISO-2022-JP\n";
 }
 $head .= 'Reply-To: '.$site_mail.'' . "\n";
  #$head.= "X-Mailer: PHP/".phpversion();
  if(!mail($email, $mail_subject, $body, $head)) return FALSE; else return TRUE;
}

/* ----- /Mail header setup and Send（利用者への確認メール送信）end ----- */

/* ----- Mail header setup and Send（運営者へのメール送信）start ----- */

function add_send_mail($send_mail, $name, $email, $get_mail, $add_subject, $add_body, $bcc_mail, $inchr, $outchr){
 //X-Mailerをphpversition等で指定するとHotMailでは迷惑メールとして扱われる
 $add_head = "";
 $add_body = mb_convert_encoding($add_body, $outchr, $inchr);
 if(isset($add_subject)){ $add_subject = mime_enc($add_subject); }
 $add_body = str_replace("\r\n", "\n", $add_body);
 $add_body = str_replace("\r" , "\n", $add_body);
 if(isset($name)){
  $add_head .= 'From: "'.mime_enc($name).'" <'.$email.'>'."\n";
 }else{
  $add_head .= 'From: "'.$email.'" <'.$email.'>'."\n";
 }
 $add_head.= "X-Originating-IP: [{$_SERVER['SERVER_ADDR']}]\n";
 $add_head.= "X-Originating-Email: [{$send_mail}]\n";
 $add_head.= "X-Sender: {$email}\n";
 $add_head.= "Mime-Version: 1.0\n";
 if(isset($langFlag)){
  $add_head.= "Content-Type: text/plain; charset=iso-8859-1\n";
 } else {
  $add_head.= "Content-Type: text/plain;charset=ISO-2022-JP\n";
 }
 if(isset($bcc_mail)){ $add_head .= 'Bcc: '.$bcc_mail.'' . "\n"; }
 $add_head .= 'Reply-To: '.$email.'' . "\n";
  #$head.= "X-Mailer: PHP/".phpversion();
  if(!mail($get_mail, $add_subject, $add_body, $add_head)) return FALSE; else return TRUE;
}

/* ----- /Mail header setup and Send（運営者へのメール送信）end ----- */

/* mime encode function */
function mime_enc($str){
 $encode = "=?iso-2022-jp?B?".base64_encode($str)."?=";
 return $encode;
}
/* /mime encode function */

/* ===== /mail setup ===== */

/* ===== 送信後の画面（ここから） ===== */
?>
<!-- form.back -->
<form action="<?=$back_url?>" class="back">
<fieldset>
<legend>フォーム送信処理</legend>
<?php
if(add_send_mail($send_mail, $name, $email, $get_mail, $add_subject, $add_body, $bcc_mail, $inchr, $outchr)){
 echo "<h2 class=\"send\">";
	if(send_mail($send_mail, $site_mail, $email, $mail_subject, $body, $send_name, $inchr, $outchr)){
  if(isset($langFlag)){ print("Transmission completion."); } else { $success = true; print("送信が完了しました。"); }
	} else {
	 if(isset($langFlag)){ print("ERROR : Send Mail Incomplete."); } else { print("エラー：確認メールの送信失敗"); }
	}
 echo "</h2>";
}else{
 echo "<h2 class=\"send\">";
	if(isset($langFlag)){ print("ERROR : Send Mail Incomplete."); }
	else { print("エラー：送信に失敗しました"); }
 echo "</h2>";
}

?>
</fieldset>
<?php if(isset($success)){ ?>
<p><button type="button" onclick="location.href = '<?=$back_url?>';" class="button buttonSlv">フォームTOPへ戻る</button></p>
<?php } else { ?>
<p><button type="button" onclick="javascript:history.back();" class="button buttonSlv">前画面へ戻る</button></p>
<?php } ?>
</form>
<!-- /form.back -->

<?php
/* ===== /送信後の画面（ここまで） ===== */

} else {

/* ＊＊＊＊＊ POSTメソッドでデータが送られてこなかった場合の処理 ＊＊＊＊＊ */
?>
<!-- form.back -->
<form action="<?=$back_url?>" class="back">
<fieldset>
<legend>フォーム送信処理</legend>
<h2 class="send"><?php	if(isset($langFlag)){ print("ERROR : Send Mail Incomplete."); } else { print("エラー：送信失敗"); } ?></h2>
<p><em><?php if(isset($langFlag)){ print("Please input a necessary matter to the form."); } else { print("各フォームより必要事項を入力してお送りください。"); } ?></em></p>
</fieldset>
<p><button type="button" onclick="javascript:history.back();" class="button buttonSlv">前画面へ戻る</button></p>
</form>
<!-- /form.back -->

<?php } /* ＊＊＊＊＊ /送信処理の終了 ＊＊＊＊＊ */ ?>
