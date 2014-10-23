<div class="b_shadow" style="display: block;" data-auto-controller="CallBackController">
  <div class="b_popup">
    <div class="b_text_content" style="text-align: center;">
      <p><?php echo $lang["vkaz_nom_tel"]?></p>
      <div class="b_text_center">
      	<form action="/callback">
      		<p><?php echo $lang['phone']?></p>
      		<input required="required" type="text" name="phone">
      		<p><?php echo $lang['name']?></p>
      		<input required="required" type="text" name="name">
		<input required="required" type="hidden" name="token" value="<?php echo $token ?>">
		<p><?php echo $lang['captcha']?></p>
		<div class="b_capcha"><?php echo $captcha; ?></div>
		<div class="refresh captcha-reload"><a href="#"><?php echo $lang["captha_reload"]?></a></div>
		<input type="text" class="form-text" name="code" id="code"  />
      	</form>
        <a href="#" class="button"><em class="b_rs"></em>Ок</a>
      </div><!-- b_text_center -->
    </div><!-- b_text_content -->
  </div><!-- b_popup -->
</div>
<script type="text/javascript">

$('.captcha-reload').click(function(){
	var d = new Date();
	var t = d.getTime();
	$('[alt="Captcha"]').attr('src','<?php echo url::base(); ?>captcha/kcaptcha' + '?' + t);

});

</script>
