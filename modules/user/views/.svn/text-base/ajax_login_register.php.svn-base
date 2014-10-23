<div id="user_text" class="autorized">
<form action="/user/login" id="adv_user_login_form">
	<h4>Авторизация</h4>
	<a  onclick="closeLoginForm()" class="b_close">закрыть</a>
	<ul class="form_list jNice">
	  <li>
	  	<label>Ваш email</label>
	  	<input type="text" class="form-text" name="username" value="" id="baloon_username" />	
	  </li>
	  <li>
	  	<label>Пароль</label>
	  	<input type="password" class="form-text" name="password" value="" id="baloon_userpass"/>	
	  </li>
	  <li>
	  	<label><a onclick="showRegisterForm()" class="reg">Зарегистрироваться</a></label>
	  	<input type="checkbox" class="form-checkbox" id="baloon_remember_me" /><span>Запомнить меня</span>
	  	<a onclick="showReminderForm()" class="pass">забыли пароль?</a>
	  </li>
	</ul>
	<a class="btn btn_01">
		<input type="submit" class="form-submit" value="войти" onclick="return doLogin();" />					
		<em class="b_left"></em>
		<em class="b_right"></em>
	</a>
	<div class="clear"></div>
	<div class="b_enter_soc" >
		<a href="javascript: void(0);" onclick="doFbLogin();"><img src="/img/soc_reg_1.png" alt="" /></a>
		<a href="javascript: void(0);" onclick="doVKLogin();"><img src="/img/soc_reg_2.png" alt="" /></a>
		<a href="javascript: void(0);" onclick="doTwitterLogin();"><img src="/img/soc_reg_3.png" alt="" /></a>
	</div>
</form>
</div>

<div class="b_new_registr" id="user_register_form" style="display: none;">
	<a  onclick="closeLoginForm()" class="b_close">закрыть</a>
	<?php include Kohana::find_file('views','register_form_only'); ?>
</div>

<div class="b_new_registr" id="user_reminder_form" style="display: none;">
	<a  onclick="closeLoginForm()" class="b_close">закрыть</a>
	<?php include Kohana::find_file('views','reminder_form_only'); ?>
</div>


<script>
function closeLoginForm(){
	$(".b_loader_text").hide();
	$(".bg_loader").hide();
}

function showRegisterForm(){

	$('#user_text').hide();
	$('#user_register_form').show();
	
	prepareForm();
	centerLoader();
	$('#register_form').jNice();
}

function showReminderForm(){
	$('#user_text').hide();
	$('#user_reminder_form').show();

	prepareForm();
	centerLoader();
	$('#reminder_form').jNice();

}

</script>
