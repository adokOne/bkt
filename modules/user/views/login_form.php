<?php include Kohana::find_file('views','header'); ?>

<div class="login_page">
	<div class="left">
        <h1><?php echo $lang['login_form']; ?></h1>
        <div class="login_tip"><?php echo $lang['please_fill_fields_above']?></div>
        <?php 
			if(!empty($errors)){
				echo "<ul style='padding:10px;margin:10px;background:#ffebe8;color:#dd3c10;border:1px solid #dd3c10;'>";
				foreach($errors as $error){
					echo "<li>{$error}</li>";
				}
				echo "</ul>";
			}
		?>
        <form class="loginform" method="post" action="<?php echo url::base(); ?>user/login/">
          <fieldset>
            <label><?php echo $lang['username'] ?></label>
            <input type="text" class="text_input" value="<?php echo $fields['username'] ?>" name="username" />
            <label><?php  echo $lang['password'] ?></label>
            <input type="password" class="text_input" name="password" />
            <div class="remember_me"><span><input type="checkbox" name="remember_me"/></span><span  class="remember_txt"><?php echo $lang['remember_me'] ?></span></div>
            <input type="submit" value="Вход" class="enter_but" />
            <div class="forgot"><a href="<?php echo url::base(); ?>user/reminder"><?php echo $lang['password_remind']; ?></a></div>
          </fieldset>
        </form>  
      </div>
<script>
login_callback.push( function(username){
	window.location = "<?php echo url::base() . 'user/profile/' ?>"
})
$(document).ready(function(){
	init_social_login();
});
</script>

      <div class="right">
        <div class="reg_offer">
        	Авторизация в один клик
        	<div class="buttons">
        	        	<!--  <a href=""><img alt="" src="/img/openid_b.gif"></a>  --> 
        	        	<a href="javascript: void(0);" onclick="doVKLogin()"><img alt="" src="/img/vkontakte_b.gif"></a>
        	        	<!-- <a href=""><img alt="" src="/img/twitter_b.gif"></a> -->
        	        	<a href="javascript: void(0);" onclick="doFbLogin()" ><img alt="" src="/img/facebook_b.gif"></a>
        	 </div>
        	или <div class="clear-fix"></div>
          <a href="<?php echo url::base() ?>/user/register"><em class="l"></em><em class="r"></em><?php echo $lang['register'] ?></a>
        </div>
        <div class="regoffer_txt"><?php echo $lang['register_descr'] ?></div>
      </div>  
</div>
<?php include Kohana::find_file('views','footer'); ?>
