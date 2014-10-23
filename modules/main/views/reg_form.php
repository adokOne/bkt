<div class="b_shadow" style="display: block;" data-auto-controller="OnLineRegController">
  <div class="b_popup" style="top:0">
    <div class="b_text_content" style="text-align: center;">
      <p><?php echo $lang["zap_na_kurs"]?> "<?php echo $course->where('id_lang',$cur_lang)->courses_langs->current()->name?>"</p>
      <div class="b_text_center">
      	<form action="/do_online_reg">
      		<p><?php echo $lang["phone"]?></p>
      		<input required="required" type="text" name="phone">
      		<p><?php echo $lang["fio"]?></p>
      		<input required="required" type="text" name="name">
          <p>E-mail</p>
          <input required="required" type="email" name="email">
          <p><?php echo $lang["sale_code"]?></p>
          <input  type="text" name="disc_code">
          <input value="<?php echo $group?>" type="hidden" name="group">
          <input value="<?php echo $is_group?>" type="hidden" name="is_group">
          <input value="<?php echo $course->id?>" type="hidden" name="course_id">
		<input required="required" type="hidden" name="token" value="<?php echo $token ?>">
		<p><?php echo $lang["captcha"]?></p>
		<div class="b_capcha"><?php echo $captcha; ?></div>
		<div class="refresh captcha-reload"><a href="#"><?php echo $lang["captha_reload"]?></a></div>
		<input type="text" required="required" class="form-text" name="code" id="code"  />
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
