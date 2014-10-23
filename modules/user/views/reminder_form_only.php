<div>
      <h3>Восстановление пароля</h3>
      <div id="errors_block" style="color: red;"></div>
      <ul class="errors_list" style="display: none;"></ul>

      <form id="reminder_form" class="jNice" method="POST" action="<?php echo url::base(); ?>user/reminder">
        <ul class="form_list">
            <li>
                <label>E-mail</label>
                <input type="text" class="text_input" name="remindemail" id="remindemail" value="" />
            </li>
        </ul>
        <!--input type="submit" value="Выслать инструкции" id="remind_btn" class="send_instr" /-->
        <input type="hidden" name="token" value="<?php echo $token ?>" />
        <a href="javascript: void(0);" onclick="$('#reminder_form').submit();" class="btn"  >
            выслать инструкции
            <em class="b_left"></em>
            <em class="b_right"></em>
        </a>
      </form>  
</div>


<script type="text/javascript">

$('#reminder_form').ajaxForm({
  	url: '/user/reminder',
  	method: 'POST',
  	dataType: "json",
	success: function(resp){
		hideRegLoading()
		if(resp.success){
			showLoader('Интсрукции по востановлению пароля отправлены.');
			setTimeout(function(){
                            closeLoginForm();
                        },1000);
		}else {
			showErrors(resp.errors);
			$('.captcha-reload').click();

		}
	},
	error: function(){
		hideRegLoading();
		alert('Server error');
	},
	beforeSubmit: function(){
		showRegLoading('Идет отправка...');
	}
});


</script>