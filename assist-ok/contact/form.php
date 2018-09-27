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
?>
<!-- #form -->
<div id="form">

<!--[if IE]>
<script src="../js/form/jquery.formtips.1.2.5.packed.js" charset="UTF-8"></script>
<link rel="stylesheet" href="css/placeholder.css" type="text/css" media="screen" />
<script type="text/javascript">
$(function(){
 $("input.tipped").formtips({tippedClass:"tipped"});
});
</script>
<![endif]-->
<!-- jQuery $ JS lib -->
<script type="text/javascript">
$(function(){
 $("form").exValidation({
  rules: {
  name: "required",
  kana: "required katakana",
  email: "required email hankaku group",
  texts: "required"
  }
 });

	maxMonth = 3;
 dd = new Date();
 yy = dd.getFullYear();
 yyyy = yy;
 mm = dd.getMonth() + 1;
 mmmm = mm + maxMonth;
 dd = dd.getDate();
 dddd = dd - 1;
 if (mmmm > 12) { yyyy += 1; mmmm -= 12; }

 $("#trf").datepicker({minDate: new Date(yy, mm - 1, dd), maxDate: new Date(yyyy, mmmm - 1, dddd)});

 $("input.tipped").formtips({tippedClass:"tipped"});

});
</script>
<script type="text/javascript">
$(function(){
	var validation = $("#form1").exValidation();
});
</script>
<!-- /jQuery & JS lib -->

<!-- form -->
<form action="./?mode=check" method="post" id="form1" class="h-adr">
<fieldset>
<p><em class="ak">*</em>印は必須項目です。</p>
<p>特にメールアドレスはお間違えのないようご注意ください。<br>
以下のフォームより送信後、ご入力いただいたアドレス宛に確認メールが自動で届きます。<br>
スマートフォン等でPCからのメール着信を拒否されている場合は、当サイト（assist-ok.jp）からのメール受信を許可してからご応募ください。<br>
１時間程度経過しても確認メール届かない場合は、もう一度メールアドレスなどをご確認いただき、再度お試しください。<br>
上手くいかない場合は、お手数ですがお電話でお問合せください。
</p>
<p>
本講座のご応募は<a href="../entry/" class="attention">こちらのページ</a>またはお電話で。
</p>
<h3><?=$subject?>フォーム</h3>
<table>
<tbody>
<tr>
<th>お名前<span>*</span></th>
<td><input type="text" id="name" name="name" size="25" value="" autofocus placeholder="（例）鈴木花子" class="tipped" title="（例）鈴木花子" style="ime-mode: active;"></td>
</tr>
<tr>
<th>フリガナ<span>*</span></th>
<td><input type="text" id="kana" name="kana" size="30" value="" placeholder="（例）スズキハナコ" class="tipped" title="空白は入れないでください" style="ime-mode: active;"></td>
</tr>
<tr>
<th>e-mail<span>*</span></th>
<td><span id="email">
<input type="text" id="email" name="email" value="" style="ime-mode: disabled;">
@
<input type="text" name="email2" value="" style="ime-mode: disabled;">
</span></td>
</tr>
<tr>
<th>お問合せ内容<span>*</span></th>
<td><textarea id="texts" name="texts" cols="80" rows="10" style="ime-mode: active;"></textarea></td>
</tr>
</tbody>
</table>
</fieldset>
<p class="submit">
<input type="submit" value="確　認" class="button" />
</p>
<input type="hidden" name="send" value="send" />
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
</div>
<!-- /#form -->
