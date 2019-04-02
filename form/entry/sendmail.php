<?php
/* ++++++++++ PHP mail form system ++++++++++ */
//
// Original PHP form system Ver.1.8.1
//
// author :  Design ofiice IRUYA.
// website : https://iruya.jp/
//
/* ++++++++++++++++++++++++++++++++++++++++++ */
?>

<!-- form -->
<div id="form">

<?php

/* ＊＊＊＊＊ POST でデータが送られてきたら ＊＊＊＊＊ */

if($sendFlag){

/* ===== 環境設定 ===== */
if($langFlag){
	mb_language("en");
	$inchr = "UTF-8";
	$outchr = "UTF-8";
} else {
	mb_language("ja");
	$inchr = "UTF-8";
	$outchr = "JIS";
}

/* ===== POST setup ===== */

if((isset($_POST['subject']))&&($_POST['subject']!="")){	$subject = $_POST['subject']; }
if((isset($_POST['site_name']))&&($_POST['site_name']!="")){	$site_name = $_POST['site_name']; }
if((isset($_POST['site_mail']))&&($_POST['site_mail']!="")){	$site_mail = $_POST['site_mail']; }
if((isset($_POST['send_name']))&&($_POST['send_name']!="")){	$send_name = $_POST['send_name']; }
if((isset($_POST['send_mail']))&&($_POST['send_mail']!="")){	$send_mail = $_POST['send_mail']; }
if((isset($_POST['get_mail']))&&($_POST['get_mail']!="")){	$get_mail = $_POST['get_mail']; }
if((isset($_POST['bcc_mail']))&&($_POST['bcc_mail']!="")){	$bcc_mail = $_POST['bcc_mail']; }
if((isset($_POST['back_url']))&&($_POST['back_url']!="")){	$back_url = $_POST['back_url']; }

if((isset($_POST['name']))&&($_POST['name']!="")){	$name = $_POST['name']; }
if((isset($_POST['email']))&&($_POST['email']!="")){	$email = $_POST['email']; }
if((isset($_POST['msg']))&&($_POST['msg']!="")){ $msg = " ".$_POST['msg']; }

$add_subject = "【重要】WEBフォームからの".$subject;

/* ===== /POST setup ===== */

/* ===== mail setup ===== */

/* subject setup */
if($langFlag){
	$subject = 'Confirmation of '.$subject;
} else {
	$subject = '【'.$subject.'内容のご確認】';
}
/* /subject setup */

/* encode */
$name = mb_convert_encoding($name, $outchr, $inchr);
$subject = mb_convert_encoding($subject, $outchr, $inchr);
$add_subject = mb_convert_encoding($add_subject, $outchr, $inchr);
/* /encode */

/* ----- user mail body ----- */

if($langFlag){
	$body = 'Dear '.$name.' - '.date('j.n.Y')."\r\n";
} else {
	$body = $name.' 様　'.date('Y年n月j日')."\r\n";
}

$body .= "\r\n".
$site_name.'へご応募いただき誠に有り難うございます。' . "\r\n".
'下記の内容で承りました。' . "\r\n".
'後日、担当者からご連絡させていただきますので、いましばらくお待ちください。' . "\r\n".
"\r\n";

$body .= '--------------------------------------------------' . "\r\n".
"\r\n";
if($langFlag){
$body .= '[ SEND MAIL INFORMATION ]'. "\r\n";
} else {
$body .= '【受信内容】'. "\r\n";
}
$body .= "\r\n".$msg.
"\r\n".
"\r\n".
'～ご参加いただくにあたってのお願い～' . "\r\n".
"\r\n".
'◇持参物' . "\r\n".
'　筆記用具' . "\r\n".
"\r\n".
'◇キャンセルについて' . "\r\n".
'講座開始日前にキャンセルされる場合は、必ず事務局までご連絡ください。' . "\r\n".
"\r\n".
'ご不明な点がございましたら、下記の代表メールまたは電話番号まで直接ご連絡ください。' . "\r\n".
"\r\n".
'宜しくお願いいたします。' . "\r\n".
"\r\n".
'==================================================' . "\r\n".
$add_name . "\r\n";
$body .= $address. "\r\n";
$body .= 'TEL : '.$tel.' / FAX : '.$fax. "\r\n";
$body .= 'e-mail < '.$site_mail.' >' . "\r\n";
$body .= 'URL : '.$site_url. "\r\n".
'==================================================' . "\r\n";

/* ----- / user mail body ----- */

/* ----- admin mail body ----- */

if($langFlag){
	$add_body = 'Dear Administrator.' . "\r\n";
} else {
	$add_body = '担当者 様' . "\r\n";
}
$add_body .= "\r\n".
'【WEBフォームシステムからの通知】　'.date('Y年n月j日')."\r\n".
"\r\n".
$name.' 様よりご応募を頂きました。' . "\r\n".
'下記の送信内容につきましてご確認、ご対応ください。' . "\r\n".
"\r\n";
$add_body .= '--------------------------------------------------' . "\r\n".
"\r\n";
if($langFlag){
$add_body .= '[ SEND MAIL INFORMATION ]'. "\r\n";
} else {
$add_body .= '【受信内容】'. "\r\n";
}
$add_body .= "\r\n".$msg.
"\r\n".
'==================================================' . "\r\n".
$send_name . ' - WEB FORM SYSTEM'."\r\n";
$add_body .= ' * e-mail < '.$send_mail.' >' . "\r\n";
$add_body .= ' * address : '.$address. "\r\n";
$add_body .= ' * URL : '.$site_url. "\r\n".
'==================================================' . "\r\n";

/* ----- / admin mail body ----- */

/* ----- user header setup ----- */

function send_mail($send_mail, $site_mail, $email, $subject, $body, $send_name, $inchr, $outchr){
 //X-Mailerをphpversition等で指定するとHotMailでは迷惑メールとして扱われる
 $send_name = mb_convert_encoding($send_name, $outchr, $inchr);
 $body = mb_convert_encoding($body, $outchr, $inchr);
 if($subject){ $subject = mime_enc($subject); }
 $body = str_replace("\r\n", "\n", $body);
 $body = str_replace("\r" , "\n", $body);
 if($send_name){
  $head .= 'From: "'.mime_enc($send_name).'" <'.$send_mail.'>'."\n";
 }else{
  $head .= 'From: "'.$send_mail.'" <'.$send_mail.'>'."\n";
 }
 $head.= "X-Originating-IP: [{$_SERVER['SERVER_ADDR']}]\n";
 $head.= "X-Originating-Email: [{$send_mail}]\n";
 $head.= "X-Sender: {$send_mail}\n";
 $head.= "Mime-Version: 1.0\n";
 if($langFlag){
  $head.= "Content-Type: text/plain; charset=iso-8859-1\n";
 } else {
  $head.= "Content-Type: text/plain;charset=ISO-2022-JP\n";
 }
 $head .= 'Reply-To: '.$site_mail.'' . "\n";
  #$head.= "X-Mailer: PHP/".phpversion();
  if(!mail($email, $subject, $body, $head)) return FALSE; else return TRUE;
}

/* ----- /user header setup ----- */

/* ----- admin header setup ----- */

function add_send_mail($send_mail, $name, $email, $get_mail, $add_subject, $add_body, $bcc_mail, $inchr, $outchr){
 //X-Mailerをphpversition等で指定するとHotMailでは迷惑メールとして扱われる
 $add_body = mb_convert_encoding($add_body, $outchr, $inchr);
 if($add_subject){ $add_subject = mime_enc($add_subject); }
 $add_body = str_replace("\r\n", "\n", $add_body);
 $add_body = str_replace("\r" , "\n", $add_body);
 if($name){
  $add_head .= 'From: "'.mime_enc($name).'" <'.$email.'>'."\n";
 }else{
  $add_head .= 'From: "'.$email.'" <'.$email.'>'."\n";
 }
 $add_head.= "X-Originating-IP: [{$_SERVER['SERVER_ADDR']}]\n";
 $add_head.= "X-Originating-Email: [{$send_mail}]\n";
 $add_head.= "X-Sender: {$email}\n";
 $add_head.= "Mime-Version: 1.0\n";
 if($langFlag){
  $add_head.= "Content-Type: text/plain; charset=iso-8859-1\n";
 } else {
  $add_head.= "Content-Type: text/plain;charset=ISO-2022-JP\n";
 }
 if($bcc_mail){ $add_head .= 'Bcc: '.$bcc_mail.'' . "\n"; }
 $add_head .= 'Reply-To: '.$email.'' . "\n";
  #$head.= "X-Mailer: PHP/".phpversion();
  if(!mail($get_mail, $add_subject, $add_body, $add_head)) return FALSE; else return TRUE;
}

/* ----- /admin header setup ----- */

/* mime encode function */
function mime_enc($str){
 $encode = "=?iso-2022-jp?B?".base64_encode($str)."?=";
 return $encode;
}
/* /mime encode function */

/* ===== /mail setup ===== */

/* ===== send mail ===== */
?>

<h3>フォーム送信処理</h3>
<!-- form.back -->
<form action="<?=$back_url?>" class="back">
<?php
if(add_send_mail($send_mail, $name, $email, $get_mail, $add_subject, $add_body, $bcc_mail, $inchr, $outchr)){
 echo "<h2 class=\"send\">";
	if(send_mail($send_mail, $site_mail, $email, $subject, $body, $send_name, $inchr, $outchr)){
  if($langFlag){ print("Transmission completion."); } else { print("送信が完了しました。"); }
	} else {
	 if($langFlag){ print("ERROR : Send Mail Incomplete."); } else { print("エラー：確認メールの送信失敗"); }
	}
 echo "</h2>";
}else{
 echo "<h2 class=\"send\">";
	if($langFlag){ print("ERROR : Send Mail Incomplete."); } else { print("エラー：送信に失敗しました"); }
 echo "</h2>";
}

?>
<div class="back"><input type="submit" value="TOPへ戻る" onclick="location.href = '<?=$back_url?>';" class="buttonSlv" /></div>
</form>
<!-- /form.back -->

<?php
/* ===== /send mail ===== */

} else {

/* ＊＊＊＊＊ POST でデータが送られなかったら ＊＊＊＊＊ */
?>

<h3>フォーム送信エラー</h3>
<!-- form.back -->
<form action="<?=$back_url?>" class="back">
<h2 class="send"><?php	if($langFlag){ print("ERROR : Send Mail Incomplete."); } else { print("エラー：送信失敗"); } ?></h2>
<p><em><?php if($langFlag){ print("Please input a necessary matter to the form."); } else { print("各フォームより必要事項を入力してお送りください。"); } ?></em></p>
<div class="back"><input type="submit" value="前画面へ戻る" onclick="location.href = '<?=$page_back?>';" class="buttonSlv" /></div>
</form>
<!-- /form.back -->

<?php } ?>

</div>
<!-- /#form -->