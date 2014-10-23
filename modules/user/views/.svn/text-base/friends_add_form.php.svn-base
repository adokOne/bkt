<div id="add_friends_form">
<h1>Пригласить друзей</h1>
<form class="invite_friends" method="post" action="">
      <p>Для того, чтобы пригласить в друзья зарегистрированных пользователей, достаточно внести ники или почтовыэ адреса через запятую в текстовое поле и нажать кнопку "Пригласить"</p>
      <label>Ники или почтовые адреса друзей</label>
      <input type="text" class="text_input nickname" name="friends_list" value="" />
      <input type="submit" class="invite" />
      <div class="ajax_loading" style="display: none; width: 130px; text-align: center; "><img src="/img/loading.gif"></div>
</form>
</div>
<script>
$(function() {
	$('.invite').click(function(){
		$('.invite').hide();
		$('.ajax_loading').show();
	});	
	
	$('.invite_friends').ajaxForm({ 
		url: "/friends/add_friends",
		type: 'POST',
		dataType: 'json',
		success: function(responce){
			if(responce.msg == 'ok'){
				$('#add_friends_form').html(responce.data);
			}else {
				$('.ajax_loading').hide();
				$('.invite').show();
				alert(responce.data);
			}
		}
	 });
});
</script>