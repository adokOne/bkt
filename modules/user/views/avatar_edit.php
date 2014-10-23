	<h1>Загрузка аватара</h1>

	<div class="avatar_preview">
		<img   width="127" height="128" src="/img/avatars/<?php echo $user->id; ?>/pic_195.jpg" class="user_ava_pic"/>
    </div>    
    <div  class="avatar_options" id="ava_form">
    <form action="/user/avatar_upload/" method="post" id="avatar_form"  class="change_avatar">	
    <p><?php echo $lang['avatar_top_text']; ?></p>
    <div class="choose_file">
      <div id="avatar_upload">
        <div class="fileinputs">
          <input type="file" name="avatar" id="avatar_file" class="file hidden" />
          <div class="fakefile"><input class="file_inp" /></div>
        </div>
      </div>
      <p>Файл не выбран.</p>
      <p>Загрузить файл с комьютера.</p>
    </div>  
          
    <p><?php echo $lang['avatar_bottom_text'] ?></p>
    <div class="ava_upl_btn"><input class="update_avatar"  type="submit" value="<?php echo $lang['avatar_update']?>" id="avatar_start_upload"></div>
    <div class="ava_loading" style="display: none;"><img src="/img/loading.gif"></div>
    </form>
	</div>

<script>
$(function() {

	$('#avatar_start_upload').click(function(){
		$('.ava_upl_btn').hide();
		$('.ava_loading').show();
		
	});	
	
	$('#avatar_form').ajaxForm({ 
		url: "/user/avatar_upload/",
		type: 'POST',
		dataType: 'json',
		success: function(responce){
			if(responce.msg == 'ok'){
				$('.user_ava_pic').attr('src','/img/avatars/<?php echo $user->id; ?>/pic_195.jpg?' + Math.floor(Math.random()*123847) );
				$('.ava_upl_btn').show();
				$('.ava_loading').hide();
			}else {
				$('.ava_loading').hide();
				$('.ava_upl_btn').show();
				alert(responce.data);
			}
		}
	 }); 
});
</script>