<?php
/* ++++++++++ PHP mail form system ++++++++++ */
//
// Original PHP contact form system Ver.1.8.1
//
// author :  Design ofiice IRUYA.
// website : https://iruya.jp/
//
/* ++++++++++++++++++++++++++++++++++++++++++ */
?>
<!-- #form -->
<div id="form">
<!-- jQuery $ JS lib -->
<script src="https://yubinbango.github.io/yubinbango/yubinbango.js" charset="UTF-8"></script>
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
<p>
本セミナーに関するお問合せは、お電話（<?=$tel?>）または下記のフォームよりお寄せください。
</p>
<p><em class="ak">*</em>印は必須項目です。</p>
<p class="just">特にメールアドレスはお間違えのないようご注意ください。<br>
以下のフォームより送信後、ご入力いただいたアドレス宛に確認メールが自動で届きます。<br>
スマートフォン等でPCからのメール着信を拒否されている場合は、運営事務局（<?=$ml_domain?>）からのメール受信を許可してからご応募ください。<br>
１時間程度経過しても確認メール届かない場合は、もう一度メールアドレスなどをご確認いただき、再度お試しください。<br>
上手くいかない場合は、お手数ですがお電話でお問合せください。
</p>
<p>
お申込みは<a href="../entry/" class="attention">こちらのページ</a>またはお電話で。
</p>
<h3><?=$subject?>フォーム</h3>


<h4>お名前<span class="ak">*</span></h4>
<p><input type="text" id="name" name="name" size="25" value="" autofocus placeholder="（例）鈴木一郎" class="tipped" title="（例）鈴木一郎" style="ime-mode: active;"></p>

<h4>フリガナ<span class="ak">*</span></h4>
<p><input type="text" id="kana" name="kana" size="30" value="" placeholder="（例）スズキイチロウ" class="tipped" title="空白は入れないでください" style="ime-mode: active;"></p>

<h4>e-mail<span class="ak">*</span></h4>
<p><span id="email">
<input type="text" id="email" name="email" size="14" value="" style="ime-mode: disabled;">
@
<input type="text" name="email2" value="" size="16" style="ime-mode: disabled;">
</span></p>

<h4>お問合せ内容<span class="ak">*</span></h4>
<p><textarea id="texts" name="texts" cols="48" rows="10" style="ime-mode: active;"></textarea></p>

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
