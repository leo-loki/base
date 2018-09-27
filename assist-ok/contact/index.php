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

/* FORM DETAIL SETUP */
$pageTitle_en = "contact form";
$pageTitle_jp = "お問合せフォーム";
if($langFlag){ $pageTitle = $pageTitle_en; }else{ $pageTitle = $pageTitle_jp; }
$flagMap = "off";

$subject = "お問合せ"; // フォームとメールの表題
$site_name = "再就職アシスト講座"; // サイト名
$add_name = $site_name."運営事務局"; // メール表記用
$site_mail = "assist-ok@athuman.com"; // サイト代表アドレス（メール文中表記用）
$send_name = "再就職アシスト講座運営事務局"; // 送信者名（メールヘッダ表記用）
$send_mail = "assist-ok@athuman.com"; // フォーム送信用アドレス
$get_mail = "assist-ok@athuman.com"; // 管理者受信アドレス
$bcc_mail = "leo.loki8@gmail.com"; // 追加受信アドレス（通常はfalse）
$back_url = "https://assist-ok.jp/"; // 送信後の遷移画面
$address = "〒700-0821 岡山市北区中山下1-8-45 NTTｸﾚﾄﾞ岡山ﾋﾞﾙ15階";
$tel = "086-225-9115";
$fax = "086-221-9648";
$site_url = "https://assist-ok.jp/";
$page_back = "javascript:history.back();";
/* /FORM DETAIL SETUP */

/* ----- 入力データ変数初期化 ----- */
$name = ""; $kana = ""; $email = ""; $msg = "";
$pass = "";
$texts = "";
/* ----- /入力データ変数初期化 ----- */
/* ===== send check ===== */
if((isset($_POST['send']))&&($_POST['send']!="")){	$sendFlag = true; } else {	$sendFlag = false; }
/* ===== /send check ===== */

?><!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="ie6" lang="ja"><![endif]-->
<!--[if IE 7 ]> <html class="ie7" lang="ja"><![endif]-->
<!--[if IE 8 ]> <html class="ie8" lang="ja"><![endif]-->
<!--[if IE 9 ]> <html class="ie9" lang="ja"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="ja" class="no-js" style="zoom: 1;" data-text-lang="jp" itemscope itemtype="https://schema.org/CreativeWork"><!--<![endif]-->
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">

<title><?=$pageTitle?>：<?=$site_name?></title>
<link rel="canonical" href="<?=$site_url?>">
<link rel="alternate" href="<?=$site_url?>?lang=en" hreflang="en-US"><link rel="alternate" href="<?=$site_url?>" hreflang="ja-JP">
<meta name="robots" content="noindex,noarchive">
<meta name="format-detection" content="telephone=no">
<meta name="description" content="Let's Work Again! in OKAYAMA もう一度、働きたい女性のために 〜再就職アシスト講座〜">
<meta name="author" content="<?=$send_name?>">

<link rel="stylesheet" type="text/css" href="../css/lib/html5resetter.css">
<!-- IE set HTML 5 tag -->
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="../css/style2018.css?id=201806222330">
<link rel="stylesheet" type="text/css" href="./css/style.css?id=cnt20180622">
<link rel="stylesheet" type="text/css" href="./css/exvalidation.css">
<!-- <link rel="stylesheet" type="text/css" href="css/start/jquery-ui-1.8.4.custom.css">
JS jQuery & lib Loading //-->
<script src="../sw.js"></script>
	<!-- JS jQuery & lib Loading //-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="../sw.js"></script>
<!-- form Javascript file Loading //-->
	<script type="text/javascript" src="../js/form/jquery.easing.js"></script>
	<script type="text/javascript" src="../js/form/exvalidation.js"></script>
	<script type="text/javascript" src="../js/form/exchecker-ja.js"></script>
	<script type="text/javascript" src="../js/form/jquery-ui-1.8.4.custom.min.js"></script>
	<script type="text/javascript" src="../js/form/jquery.ui.datepicker-ja.js"></script>
<!-- /form Javascript file Loading //-->

<!-- favorite icons (PC and other) -->
<link rel="shortcut icon" href="../img/icons/favicon64.png">
<link rel="icon" href="../img/icons/favicon.ico" sizes="16x16 32x32 48x48">
<!-- mobile setting (Android) -->
<link rel="icon" href="../img/icons/android-chrome192.png" sizes="192x192">
<!-- iPhone iPad setting -->
<link rel="apple-touch-icon-precomposed" href="../img/icons/apple-touch-icon152.png">

</head>

<body id="cont">

<div id="top">
	<header>平成30年度 岡山市女性の再就職支援事業</header>
</div>

<div id="main" class="wrap">

<header id="header">
<h1><a href="../"><img src="../img/logo.svg" alt="<?=$site_name?> - Let's Work Again! in OKAYAMA"></a></h1>
</header>

<main>

<div class="container flexbox">
  <div class="contents">
    <section class="sticky">

			<h2 class="min-jp"><?=$site_name?>へのお問合せ</h2>
<!-- form -->
<div class="paggebody">
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

<div id="footer">
	<footer class="wrap">Copyright &copy; 2018 <a href="../"><?=$site_name?></a>運営事務局.</footer>
</div>

<nav id="pagetop" class="fade"><a href="#top">TOP</a></nav>

<div id="global">
	<header id="global-subtitle" class="fade pc"><a href="../"><?=$site_name?></a></header>
	<nav id="nav-main" class="toggle">
		<input type="checkbox" id="mainMenu" class="switch">
		<ul class="menu1 fade">
			<li><a href="../">HOME</a></li>
			<li><a href="../#date">日程・募集要項</a></li>
			<li><a href="../#schedule">講座内容</a></li>
			<li><a href="../#childcare">託児サービス</a></li>
			<li><a href="../#about">会場案内</a></li>
			<li><a href="../entry/">お申し込み</a></li>
			<li><a href="../contact/">お問合わせ</a></li>
		</ul>
		<label for="mainMenu"><span></span><span></span><span></span></label>
	</nav>
</div>

</div><!-- /#main -->

</body>
</html>
