<?php
/* ++++++++++ PHP form system ++++++++++ */
//
// include file - form division.
//
/* ++++++++++++++++++++++++++++++++++++++ */
?>
<!-- Ubinbango JS Loading -->
<script src="https://yubinbango.github.io/yubinbango/yubinbango.js" charset="UTF-8"></script>
<!-- jQuery UI Datepicker japanese set Loading -->
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js"></script>
<!-- Form Check (exValidation) and Calender (Datepicker) setting -->
<script type="text/javascript">
$(function(){
 /* exValidation setting */
 var validation = $("#form1");
 validation.exValidation({
  rules: {
  name: "required",
  kana: "required katakana",
  email: "required email hankaku group",
  zip: "required numonly group",
  add: "required",
  tel: "required min10 max18",
  pass: "chkrequired chkmin6 chkmax12",
  repass: "chkrequired chkretype-pass",
  days: "required min8 max10",
  rb: "radio",
  cb: "checkbox",
  texts: "required"
  }
 });
 /* Datepicker setting */
 var days = $("#days"); //カレンダーを表示したい入力項目のIDを設定
 days.datepicker();
 days.datepicker("option", "dateFormat", 'yy-mm-dd'); /* カレンダーから入力される日付フォーマットを指定 */
 // 'yy/mm/dd' => 2018/01/25（日本語化した場合の初期設定）// 'y/m/d' => 18/1/25 // 'yy-mm-dd' => 2018-01-25
 /* 予め入力項目に日付を指定して表示させたい場合は、以下コメント記号「//」を外して日付を指定する（但し、上で指定した日付フォーマットに合わせる） */
 // days.datepicker("setDate","2020-01-25");
});
</script>
<h3><?=$pageTitle?></h3>
<form id="form1" class="h-adr" method="post" action="./?mode=check">
<p>
<fieldset>
<legend>お名前</legend>
<input type="text" id="name" name="name" size="25" value="" autofocus placeholder="（例）鈴木一郎" title="（例）鈴木一郎" style="ime-mode: active;"><br>
<label for="kana">フリガナ：</label><input type="text" id="kana" name="kana" size="30" value="" placeholder="（例）スズキイチロー" title="苗字と名前の間に空白は入れないでください" style="ime-mode: active;">
</fieldset>
</p>
<p>
<fieldset>
<legend>e-mail</legend>
<span id="email">
<input type="text" id="email1" name="email[]" value="" style="ime-mode: disabled;">
＠<input type="hidden" name="email[]" value="@">
<input type="text" id="email2" name="email[]" value="" style="ime-mode: disabled;">
</span>
</fieldset>
</p>

<p>
<fieldset>
<legend>ご住所</legend>
<span class="p-country-name" style="display:none;">Japan</span>
<span id="zip">
<label for="zip1">郵便番号：〒</label>
<input type="hidden" name="address[]" value="〒">
<input type="text" class="p-postal-code" id="zip1" name="address[]" size="6" maxlength="3" pattern="^[0-9]+$" style="ime-mode: disabled;">
<input type="hidden" name="address[]" value="-">
<label for="zip2"> - </label><input type="text" class="p-postal-code" id="zip2" name="address[]" size="8" maxlength="4" pattern="^[0-9]+$" style="ime-mode: disabled;">
</span>
<input type="hidden" name="address[]" value=" ">
<label for="add">ご住所：</label>
<input type="text" id="add" name="address[]" size="40" class="p-region p-locality p-street-address p-extended-address" placeholder="郵便番号を入力すると候補が表示されます" title="郵便番号から検索されます" style="ime-mode: active;">
</fieldset>
</p>
<p>
<fieldset>
<legend>ご連絡先</legend>
<label for="tel">電話番号（携帯可）：</label>
<input type="text" id="tel" name="tel" size="20" style="ime-mode: disabled;">
</fieldset>
</p>
<p>
<fieldset>
<legend>ご希望のパスワード</legend>
<label for="pass">※半角英数字（6〜12文字まで）</label><input name="pw" id="pass" type="password">&nbsp;
<label for="repass">再入力：<input name="pw" id="repass" type="password"></label>
</fieldset>
</p>
<p>
<fieldset>
<legend>参加希望日</legend>
<input type="text" id="days" name="days" size="20" placeholder="（例）2020-01-01" title="クリックするとカレンダーが開きます。" style="ime-mode: disabled;">
</fieldset>
</p>
<p>
<fieldset>
<legend>ラジオボタン</legend>
<span id="rb">
<label for="rb01"><input type="radio" id="rb01" name="course" value="・Aコース"> Aコース</label>
<label for="rb02"><input type="radio" id="rb02" name="course" value="・Bコース"> Bコース</label>
<label for="rb03"><input type="radio" id="rb03" name="course" value="・Cコース"> Cコース</label>
</span>
</fieldset>
</p>
<p>
<fieldset>
<legend>チェックボックス（複数選択可）</legend>
<span id="cb">
<label for="cat01"><input type="checkbox" id="cat01" name="cat[]" value="・カテゴリ01"> カテゴリ01</label>
<label for="cat02"><input type="checkbox" id="cat02" name="cat[]" value="・カテゴリ02"> カテゴリ02</label>
<label for="cat03"><input type="checkbox" id="cat03" name="cat[]" value="・カテゴリ03"> カテゴリ03</label>
<label for="cat04"><input type="checkbox" id="cat04" name="cat[]" value="・カテゴリ04"> カテゴリ04</label>
<label for="cat05"><input type="checkbox" id="cat05" name="cat[]" value="・カテゴリ05"> カテゴリ05</label>
<label for="cat06"><input type="checkbox" id="cat06" name="cat[]" value="・カテゴリ06"> カテゴリ06</label>
<label for="cat07"><input type="checkbox" id="cat07" name="cat[]" value="・カテゴリ07"> カテゴリ07</label>
<label for="cat08"><input type="checkbox" id="cat08" name="cat[]" value="・カテゴリ08"> カテゴリ08</label>
</span>
</fieldset>
</p>
<p>
<fieldset>
<legend>連絡事項</legend>
<textarea id="texts" name="texts" cols="40" rows="5" style="ime-mode: active;" placeholder="ご意見・ご質問などございましたらお書き下さい。"></textarea>
</fieldset>
</p>
<input type="hidden" name="mode" value="check">
<p><button type="submit" class="button buttonSlv">確　認</button></p>
</form>
