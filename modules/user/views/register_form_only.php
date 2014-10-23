<div>
       <h3>Регистрация нового пользователя</h3>
			<div id="errors_block" style="color: red;"></div>
			<div id="social_networks">
				<a href="javascript: void(0);" onclick="doFbLogin();"><img src="/img/soc_reg_1.png" alt="Facebook" /></a>
				<a href="javascript: void(0);" onclick="doVKLogin();"><img src="/img/soc_reg_2.png" alt="Vkontate" /></a>
				<a href="javascript: void(0);" onclick="doTwitterLogin();"><img src="/img/soc_reg_3.png" alt="Twitter" /></a>
			</div>
			<ul class="errors_list" style="display: none;">
			</ul>
			<form id="register_form" class="jNice" method="POST" action="/user/register">
					<ul class="form_list">
					  <li>
					  	<label>Выбор типа аккаунта</label>
					  	<select class="form-select" name="usertype" onchange="prepare_register_form(this.value)">
                                                    <option value="tenant">Арендатор</option>
                                                    <option value="owner">Владелец квартиры</option>
                                                    <option value="realtor">Риэлтор</option>
                                                    <option value="agency">Агентство</option>
				  		</select>	
					  </li>
					  <li>
					  	<label>ФИО</label>
					  	<input type="text" class="form-text" name="username" value="<?php echo $fields['username']; ?>" />
                                                <!--<span htmlfor="username" class="error"><?php if (isset($errors['username'])) echo $errors['username']; ?></span>-->
					  </li>
					  <li>
					  	<label>E-mail</label>
					  	<input type="text" class="form-text" name="email" value="<?php echo $fields['email']; ?>" />
                                                <!--<span htmlfor="email" class="error"><?php if (isset($errors['email'])) echo $errors['email']; ?></span>-->
					  </li>
					  <li  class="standart_register_fields">
					  	<label>Пароль</label>
					  	<input type="password" class="form-text" name="password" id="pass" value="<?php echo $fields['password']; ?>" />
					  </li>
					  <li class="standart_register_fields">
					  	<label>Подтверждение пароля</label>
					  	<input type="password" class="form-text" name="confirm_password" value="<?php echo $fields['password']; ?>" />
					  </li>
					  <li>
					  	<label>Номер телефона</label>
					  	<input type="text" class="form-text" name="phone" value="<?php echo $fields['phone']; ?>" />
					  </li>
					  <li id="agency_name_block" >
					  	<label>Название компании</label>
					  	<input type="text" class="form-text" name="agency_name" value="<?php echo $fields['agency']; ?>" />
					  </li>
					  <li id="agency_descr_block" >
					  	<label>Описание</label>
					  	<textarea class="form-textarea" name="description"><?php echo $fields['description']; ?></textarea>
					  </li>
					  <li class="capcha_item standart_register_fields">
					  	<label>Капча</label>
					  	<div class="b_capcha"><?php echo $captcha; ?></div>
					  	<input type="text" class="form-text" name="code" id="code" value="" />
                                                <div class="refresh captcha-reload"><a href="#">Обновить</a></div>
					  </li>
					</ul>
                                        <input type="hidden" name="token" id="token" value="<?php echo $token; ?>" />


					<a href="javascript: void(0);" onclick="$('#register_form').submit();" class="btn"  >
						зарегистрироваться
						<em class="b_left"></em>
						<em class="b_right"></em>
					</a>
						
					
                     <input type="hidden" name="token" id="token" value="<?php echo $token; ?>" />
                     <input type="hidden" name="facebook" value="" />
                     <input type="hidden" name="vkontakte" value="" />
                     <input type="hidden" name="twitter" value="" />
                     <input type="hidden" name="picture" value="" />
			</form>
</div>
<script type="text/javascript">

$('.captcha-reload').click(function(){
	var d = new Date();
	var t = d.getTime();
	$('[alt="Captcha"]').attr('src','<?php echo url::base(); ?>captcha' + '?' + t);

});

$('#register_form').ajaxForm({
  	url: '/user/register',
  	method: 'POST',
  	dataType: "json",
	success: function(resp){ 
		hideRegLoading()
		if(resp.success){
			showLoader('Вы успешно вошли на сайт.');
			setTimeout( registerCallback + '(\'' + resp.user_id + '\')',1);
		}else {		
			showErrors	(resp.errors);	
			$('.captcha-reload').click();
			
		}	
	},
	error: function(){
		hideRegLoading();
		alert('Server error'); 
	},
	beforeSubmit: function(){		
		showRegLoading('Регистрация...');
	}
});

function prepareForm(){
	prepare_register_form( $('#register_form [name="usertype"]').val() );
	
}

function prepare_register_form(type) {
	switch(type){
		case 'owner':
			$('#agency_name_block').hide('fast');
			$('#agency_descr_block').hide('fast');
		break;
		case 'agency':
			$('#agency_name_block').show('fast');
			$('#agency_descr_block').show('fast');
		break;
		case 'realtor':
			$('#agency_name_block').show('fast');
			$('#agency_descr_block').hide('fast');
		break;
		default:
			$('#agency_name_block').hide();
			$('#agency_descr_block').hide();
	}
	
}
</script>