<?php
/* ++++++++++ PHP mail form system ++++++++++ */
//
// Original PHP form system Ver.1.8.1
//
// author :  Design ofiice IRUYA.
// website : https://iruya.jp/
//
/* ++++++++++++++++++++++++++++++++++++++++++ */

/* FORM DETAIL SETUP */
   $domain = $_SERVER['HTTP_HOST']; // ドメイン名
$ml_domain = "iruya.jp";
$site_name = "サイト名"; // サイト名
$sub_title = "サイト サブタイトル"; // サブタイトル
 $add_name = "○○○○○運営営事務局"; // メールフッタ表記用
$site_mail = "info@".$ml_domain; // サイト代表アドレス（メールフッタ表記用）
$send_name = "○○○○○運営営事務"; // 送信者名（メールヘッダ表記用）
$send_mail = $site_mail; // フォーム送信用アドレス
 $get_mail = "hiro.iruy@gmail.com"; // 管理者受信アドレス
 $bcc_mail = "hiro@iruya.jp,leo.loki8@gmail.com"; // 追加受信アドレス（通常はfalse）
      $zip = "〒107-0062";
     $add1 = "東京都港区南青山2-11-13";
     $add2 = "南青山ビル4F";
  $address = $zip." ".$add1." ".$add2;
      $tel = "050-3791-2496";
      $fax = "03-4333-0304";
 $site_url = "https://".$domain."/";
  $subject = "応募"; // フォームとメールの表題
 $back_url = $site_url."entry/"; // 送信後の遷移画面
$pageTitle = $subject."フォーム"; // ページタイトルの設定
$page_back = "javascript:history.back();"; // 戻るボタンの設定
  $flagMap = "off";
      $now = time();
/* /FORM DETAIL SETUP */

/* ----- 入力データ変数初期化 ----- */
$name = ""; $kana = ""; $email = ""; $msg = "";
$pass = "";
$texts = "";
/* ----- /入力データ変数初期化 ----- */
/* ===== send check ===== */
if((isset($_POST['send']))&&($_POST['send']!="")){	$sendFlag = true; } else {	$sendFlag = false; }
/* ===== /send check ===== */
/* ===== UA check ===== */
$ua = $_SERVER['HTTP_USER_AGENT'];
if((strpos($ua,'iPhone')!==false)||(strpos($ua,'iPod')!==false)||(strpos($ua,'iPad')!==false)||(strpos($ua,'Android')!==false)){
 $mobile = true;
} else {
 $mobile = false;
}
/* ===== /UA check ===== */
?><!DOCTYPE html>
<html lang="ja" class="no-js" style="zoom: 1;" data-text-lang="jp" itemscope itemtype="https://schema.org/CreativeWork">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">

<title><?=$pageTitle?>：<?=$site_name?></title>
<link rel="canonical" href="<?=$site_url?>">
<link rel="alternate" href="<?=$site_url?>" hreflang="ja-JP">
<meta name="robots" content="noindex,noarchive">
<meta name="format-detection" content="telephone=no">
<meta name="description" content="ここにサイトの説明文を。">
<meta name="author" content="<?=$send_name?>">

<link rel="stylesheet" type="text/css" href="./css/html5resetter.css">
<!-- IE set HTML 5 tag -->
<!--[if lt IE 9]>
<script src="./js/html5shiv.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="./css/style.css?mod=<?=$now?>">
<link rel="stylesheet" type="text/css" href="./css/exvalidation.css">
<!-- JS jQuery & lib Loading //-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="./js/scroll.js"></script>
<!-- form Javascript file Loading //-->
	<script type="text/javascript" src="./js/form/jquery.easing.js"></script>
	<script type="text/javascript" src="./js/form/exvalidation.js"></script>
	<script type="text/javascript" src="./js/form/exchecker-ja.js"></script>
	<script type="text/javascript" src="./js/form/jquery-ui-1.8.4.custom.min.js"></script>
	<script type="text/javascript" src="./js/form/jquery.ui.datepicker-ja.js"></script>
<!-- /form Javascript file Loading //-->
</head>

<body id="cont">

<div id="top" class="header">
	<header><h1><?=$sub_title?></h1></header>
</div>

<div id="main" class="wrap">

<main>

<div class="container flexbox">
  <div class="contents">
    <section class="sticky">

			<h2 class="min-jp"><?=$site_name?>へのご応募</h2>
<!-- form -->
<div class="pagebody">
<?php
 if((isset($_GET['mode']))&&($_GET['mode'] == "check")){
	 include("check.php");
	} else if((isset($_GET['mode']))&&($_GET['mode'] == "send")){
	 include("sendmail.php");
	} else {
	 include("form.php");
	} ?>
</div>
<!-- / form -->
    </section>
  </div><!-- /.contents -->

</div><!-- /.container -->
</main>

<nav id="pagetop" class="fade"><a href="#top">TOP</a></nav>

</div><!-- /#main -->

</body>
</html>
