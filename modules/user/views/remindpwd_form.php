<?php
$hide_flow = 1; $hide_days = 1; 
include Kohana::find_file('views','header'); ?>

<div class="login_page">
	<h1><?php echo $lang['password_change'] ?></h1>
    <form class="loginform reminder" method="post" action="<?php echo url::base(); ?>user/remind/<?php echo $activation ?>" id="remind-form">
     <fieldset>
    	<label><?php echo $lang['new_password']; ?></label>
        <input class="text_input" type="password" name="password" id="passwd"  />
		<label><?php echo $lang['new_password_confirm'] ?></label>
        <input class="text_input" type="password" name="confirm_password" id="confirm_password"  />
        <label></label>
        <input type="hidden" name="token" value="<?php echo $token ?>" /> 
        <input type="button" id="change-pwdbtn" value="<?php echo $lang['change_and_login'] ?>" class="enter_but" />
      </fieldset>
    </form>
</div>
<script type="text/javascript">

	$(document).ready(function() {
			
			$("#remind-form").validate({
				rules: {
					password: {
						required: true,
						minlength: 4
					},
					confirm_password: {
						required: true,
						minlength: 4,
						equalTo: "#passwd"
					}			
				}
			});
			
			
		$('#change-pwdbtn').click(function(){
			$('#remind-form').submit();
		});
		
	});
</script>

<?php include Kohana::find_file('views','footer'); ?>