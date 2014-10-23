<div class="login_page">
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
        <form class="loginform" method="post" action="<?php echo url::base(); ?>user/login/" onsubmit="return doMOJOLogin();">
          <fieldset>
            <label><?php echo $lang['username'] ?></label>
            <input type="text" class="text_input" value="<?php echo $fields['username'] ?>" name="username" id="baloon_username" />
            <label><?php  echo $lang['password'] ?></label>
            <input type="password" class="text_input" name="password"  id="baloon_userpass" />
            <div class="remember_me"><span><input type="checkbox" name="remember_me" id="baloon_remember_me"/></span><span  class="remember_txt"><?php echo $lang['remember_me'] ?></span></div>
            <input type="submit" value="Вход" class="enter_but" />
            <div class="forgot"><a href="<?php echo url::base(); ?>user/reminder"><?php echo $lang['password_remind']; ?></a></div>
          </fieldset>
        </form>  
      </div>
</div>