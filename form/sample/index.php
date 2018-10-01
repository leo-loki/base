<?php
/* ++++++++++ PHP form system ++++++++++ */
//
// Original PHP form system Ver.2.1.2
//
// author :  Design ofiice IRUYA.
// website : https://iruya.jp/
//
/* ++++++++++++++++++++++++++++++++++++++ */

/* FORM DETAIL SETUP */

$subject_en = "entry"; // 利用者へのメール件名および確認メール内で表示される表題（英文）
$subject_jp = "お申込み"; // 利用者へのメール件名および確認メール内で表示される表題

if($langFlag){
   $subject = $subject_en;
 $pageTitle = $subject." form"; // このフォームのページタイトル（英文）
}else{
   $subject = $subject_jp;
 $pageTitle = $subject."フォーム"; // このフォームのページタイトル
}

$site_name = "サイト名"; // 利用者への確認メール内で表示されるサイト名（通常は正式な企業名や店舗名を記述）
$send_name = "送信者名"; // 確認メールの送信者名（メールヘッダ表記用・上記「サイト名」と同じでも可。なるべく少ない文字数で）
$send_mail = "hiro.iruy@gmail.com"; // 確認メールおよび運営者へのメール送信アドレス
 $get_mail = "leo.loki8@gmail.com"; // 運営者の受信アドレス
 $bcc_mail = false; // 追加受信アドレス（通常はfalse）複数設定するときは「,」で区切って追記（例："info@example.com,admin@example.com"）
 $back_url = "https://www.i-studio.jp/entry/"; // 送信後の画面遷移先
 $add_name = $site_name."お客様窓口"; // メールフッタに記載される運営者名（初期設定：サイト名＋"お客様窓口"）
$site_mail = "info@iruya.jp"; // メールフッタに記載されるサイト代表アドレス
  $address = "〒107-0062	東京都港区南青山2-11-13 南青山ビル4F"; // メールフッタに記載される運営者の所在地
      $tel = "050-3791-2496"; // メールフッタに記載される運営者の電話番号
      $fax = "03-4333-0304"; // メールフッタに記載される運営者のFAX番号
 $site_url = "https://www.iruya.jp/"; // メールフッタに記載される運営者のWebサイトURL

// フォームのチェックページおよび利用者への確認メールで表示させたい項目を配列に設定
      $label_name = array("お名前","e-mail","ご住所","ご連絡先","参加希望日","ご希望コース","カテゴリー","連絡事項"); // この（カッコ）内に確認ページで表示させたい入力項目の「見出し」を「,（カンマ）」で区切って順番に記述。
       $post_name = array("name","email","address","tel","days","course","cat","texts"); // この（カッコ）内に確認ページで表示させたい入力項目の「name属性の値」を「,（カンマ）」で区切って順番に記述（上の見出しと順番を合わせる）。
// 運営者への受信メールで表示させたいフォーム項目を配列に設定
$admin_label_name = array("お名前","フリガナ","e-mail","ご住所","ご連絡先","パスワード","参加希望日","ご希望コース","カテゴリー","連絡事項"); // この（カッコ）内に入力項目の「見出し」を「,（カンマ）」で区切って順番に全て記述。
 $admin_post_name = array("name","kana","email","address","tel","pw","days","course","cat","texts"); // この（カッコ）内に入力項目の「name属性の値」を「,（カンマ）」で区切って順番に全て記述（上の見出しと順番を合わせる）。

/* /FORM DETAIL SETUP */

/* GET and POSTメソッド値 受信処理 */
if($_GET){
 foreach ($_GET as $key => $value){
  $get_method["$key"] = $value;
 }
}
if($_POST){
 foreach ($_POST as $key => $value){
  $post_method["$key"] = $value;
  if(1<count($value)){
   $post_method["$key"] = "";
   foreach ($value as $key2 => $value2){
    $post_method["$key"] .= $value2;
   }
  }
 }
}
/* /GET and POSTメソッド値 受信処理 */
?><!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title><?=$pageTitle?></title>
<!-- CSS Loading //-->
<link rel="stylesheet" type="text/css" href="./css/style.css?id=mod20181001"><!-- form custom css -->
<link rel="stylesheet" type="text/css" href="./css/exvalidation.css"><!-- exValidation css -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"><!-- jQuery UI css -->
<!-- /CSS Loading //-->
<!-- jQuery & JS library Loading //-->
<script
  src="https://code.jquery.com/jquery-1.12.4.min.js"
  integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
  crossorigin="anonymous"></script>
<script
  src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
  integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
  crossorigin="anonymous"></script>
<!-- exValidation js -->
	<script type="text/javascript" src="./js/exvalidation.js"></script>
	<script type="text/javascript" src="./js/exchecker-ja.js"></script>
<!-- /jQuery & JS library Loading //-->
</head>

<body>

<?php /*ここから・・・*/
if($_GET['mode']==="check" && $_POST['mode']==="check"){
 include("check.php");
} else if($_GET['mode']==="send" && $_POST['mode']==="send"){
 include("sendmail.php");
} else {
 include("form.php");
} /*・・・ここまでの間に
  入力フォーム・確認・送信完了ページが表示されます。
  他の部分はご利用されるサイトデザインに合わせてご自由に記述してください。
*/ ?>

</body>
</html>
