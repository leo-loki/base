<?php
/* ++++++++++ PHP form system ++++++++++ */
//
// include file - Check division.
//
/* ++++++++++++++++++++++++++++++++++++++ */

if(isset($post_method)){
?>
<form method="post" action="./?mode=send">
<fieldset>
<legend>送信内容のご確認</legend>
<?php
  $msg = ""; $admin_msg = "";
  for($i=0; $i<count($post_method); $i++){
   if((isset($admin_label_name[$i]))&&(isset($admin_post_name[$i]))){
    if($admin_post_name[$i]==="texts"){
     $admin_msg .= "●".$admin_label_name[$i]."：\n".$post_method["$admin_post_name[$i]"]."\n";
    }else{
     $admin_msg .= "●".$admin_label_name[$i]."：".$post_method["$admin_post_name[$i]"]."\n";
    }
   }
   if((isset($label_name[$i]))&&(isset($post_name[$i]))){
    if($post_name[$i]==="texts"){
     $msg .= "●".$label_name[$i]."：\n".$post_method["$post_name[$i]"]."\n";
    }else{
     $msg .= "●".$label_name[$i]."：".$post_method["$post_name[$i]"]."\n";
    }
?>
<p class="<?=$post_name[$i]?>"><strong><?=$label_name[$i]?>：</strong>
<?php echo nl2br($post_method["$post_name[$i]"]); ?></p>
<?php }} ?>
</fieldset>
<?php if(isset($post_method['name'])){ ?>
<input name="name" type="hidden" value="<?=$post_method['name']?>">
<?php } ?>
<?php if(isset($post_method['email'])){ ?>
<input name="email" type="hidden" value="<?=$post_method['email']?>">
<?php } ?>
<input name="admin_msg" type="hidden" value="<?=$admin_msg?>">
<input name="msg" type="hidden" value="<?=$msg?>">
<input name="mode" type="hidden" value="send">
<p><button type="submit" class="button buttonRed">送　信</button>&nbsp;<button type="button" onclick="javascript:history.back();" class="button buttonSlv">戻　る</button></p>
</form>

<?php } ?>
