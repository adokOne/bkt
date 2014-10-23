<?php
$hide_flow = 1; $hide_days = 1; 
include Kohana::find_file('views','header'); ?>

    <div class="login_page">
      <h1><?php echo $lang['password_reminder_title'] ?></h1>
      <div class="login_tip"><?php echo $lang['password_reminder_desc'] ?></div>
      <?php 
			if(!empty($errors)){
				echo "<ul style='padding:10px;margin:10px;background:#ffebe8;color:#dd3c10;border:1px solid #dd3c10;'>";
				foreach($errors as $error){
					echo "<li>{$error}</li>";
				}
				echo "</ul>";
			}
	  ?>
      <form class="loginform reminder" id="remind-form" method="post" action="<?php echo url::base(); ?>user/reminder">
        <fieldset>
          <label>E-mail</label>
          <input type="text" class="text_input" name="remindemail" id="remindemail" value="" />
          <input type="submit" value="<?php echo $lang['password_remind_btn'] ?>" id="remind_btn" class="send_instr" />
          <input type="hidden" name="token" value="<?php echo $token ?>" />
        </fieldset>
      </form>  
    </div>

<script type="text/javascript">
	$(document).ready(function(){
		
		$.validator.methods.notempty = function(value, element, param) {
			return ($('#remindemail').val() != "");
		};

		
		$("#remind-form").validate({
			rules: {
				remindemail: {
					email: true,
					required: true
				}
			}
		});
		
		
		$('#remind_btn').click(function(){
			//if($('#remindemail').val() != "" && $('#username').val()){
				$('#remind-form').submit();
			//}
		});
		
	});
</script>

<?php include Kohana::find_file('views','footer'); ?>