<?php include Kohana::find_file('views','header'); ?>


<div id="vk_api_transport"></div>
<div id="fb-root"></div>


<div class="wrap">
	<div class="b_new_registr">    
		<?php include Kohana::find_file('views','register_form_only'); ?>
	</div>				
	<div class="clear"></div>
</div><!-- end wrap -->	

<!--
    <div class="registration_page">
      <h1><?php echo $lang['register_title']; ?></h1>
      <?php 
			if(!empty($errors)){
				echo "<ul style='padding:10px;margin:10px;background:#ffebe8;color:#dd3c10;border:1px solid #dd3c10;'>";
				foreach($errors as $error){
					echo "<li>{$error}</li>";
				}
				echo "</ul>";
			}
	  ?>
	  <?php echo form::open('user/register', array('class'=>'regform','method' => 'post', 'id' => 'reg-form')); ?>
      
          <div class="social_registration">
			<div class="social_registration_ins">
			    <em class="l"></em><em class="r"></em>
			    <label>Упрости регистрацию одним кликом</label>
			    <ul class="connect_with">
				<li class="vkontakte"><a href="javascript: void(0);"  onclick="doVKLogin()" ><img src="/img/vkontakte_b.gif" alt="VKontakte" /></a></li>
				<li class="twitter"><a href=""><img align="left" src="/img/twitter_b.gif" alt="Twitter" /></a></li>
				<li class="facebook"><a href="javascript: void(0);" onclick="doFbLogin()"><img align="left" src="/img/facebook_b.gif" alt="Facebook" /></a></li>
			    </ul>				
			</div>
		  </div>	
          
          <label><?php echo $lang['email']; ?>:<span>*</span></label>
          <input type="text" class="text_input" name="email" id="email" value="<?php echo $fields['email']; ?>"/>
          <label><?php echo $lang['login']; ?>:<span>*</span></label>
          <input type="text" class="text_input" name="username" id="username" value="<?php echo $fields['username']; ?>"/>
          <label><?php echo $lang['password']; ?>:<span>*</span></label>
          <input type="password" class="text_input" name="password" id="pass" value="" />
          <label><?php echo $lang['verify']; ?>:<span>*</span></label>
          <input type="password" class="text_input" name="confirm_password" id="confirm_password" value=""/>														
          <div class="accept"><span><input type="checkbox" name="user_agreement" id="user_agreement" <?php if (!empty($fields['user_agreement'])) echo 'checked="checked"'; ?>/></span><span  class="remember_txt"><strong><?php echo $lang['user_agreement']; ?></strong> <a href="#"><strong><?php echo $lang['user_agreement2']; ?></strong></a></span></div>
          <label><?php echo $lang['captcha_text'] ?></label>
          <div class="captcha"></div>
          
          <label><?php echo $lang['captcha']; ?>:<span>*</span></label>
          <input type="text" class="code" name="code" id="code" />
          <input type="hidden" name="token" id="token" value="<?php echo $token; ?>" />
          <input type="submit" class="registrate" name="register" id="sbtn" value="11<?php echo $lang['next']; ?>" />
        </fieldset>
      </form>  
      <div class="obligatory_fields"><span>*</span> - <?php echo $lang['required'] ?></div>
    </div>
-->


<script type="text/javascript">

login_callback.push( function (user_id){
	showRegLoading('Вы успешно вошли на сайт. Перенаправление на страницу профайла...');
	window.location.href = '/user/profile/'+user_id;
});

		$(document).ready(function() {
					prepareForm();

                    $.validator.addMethod("unique_email", function(value, element){
                        var status = false;
                        $.ajax({
                            async: false,
                            type: "POST",
                            url: "/user/unique_email/",
                            dataType: 'json',
                            data: {"email": value},
                            success: function(msg){
                                status = msg;
                            },
                            error: function(msg){
								status = false;
                            }
                        });
                        return status;
                    }, "Такой Email уже зарегистрирован");

                    $.validator.addMethod("valid_phone", function(value, element){
                        if(value.length == 0)
                            return false;
                        return /^[0-9_\-'" \(\)]+$/.test(value);
                    }, "Номер телефона не валиден");

                    init_social_login();



                    $("#form1").validate({
				rules: {
					username: {
						required: true,
						minlength: 3
					},
					password: {
						required: true,
						minlength: 4
					},
					confirm_password: {
						required: true,
						minlength: 4,
						equalTo: "#pass"
					},
					email: {
						required: true,
						email: true,
                                                unique_email: true
					},
					agency: {
						required: true
					},
					phone: {
						required: true,
                                                valid_phone: true
					},
					code: {
						required: true
					}
				}
			});

                    $("#form2").validate({
				rules: {
					username: {
						required: true,
						minlength: 2
					},
					email: {
						required: true,
						email: true,
                                                unique_email: true
					},
					agency: {
						required: true
					},
					phone: {
						required: true,
                                                valid_phone: true
					}
				}
			});



		});

	</script>   
<?php include Kohana::find_file('views','footer'); ?>