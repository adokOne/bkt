<?php include Kohana::find_file('views','header'); ?>

			<ul class="breadcrumbs_nav">
			  <li><a href="#">главная</a></li>
			  <li class="last">профиль</li>
			</ul>
			<div class="wrap">
				<?php include Kohana::find_file('views','user_menu'); ?>
				<div class="b_profile_body">
					<h1 class="no_padding"><?php echo $user_profile->username ?></h1>
					<h3>На сайте с <?php echo  $user_profile->join_date ?></h3>
					
					<div class="b_photo">
                                                <?php if (file_exists(DOCROOT."/upload/avatars/".$user_profile->id."/pic_93.jpg")): ?>
                                                    <img id="avatar_image" src="/upload/avatars/<?php echo $user_profile->id ?>/pic_93.jpg" alt="" />
                                                <?php else: ?>
                                                    <img id="avatar_image" src="/img/profile_photo.png" alt="" />
                                                <?php endif ?>

                                                <?php if ($allow_edit): ?>
                                                <input id="avatar_input" name="file_upload" type="file" />
                                                <?php endif ?>
					</div>
					
					<h4 class="small">Контакты</h4>
                                        <form id="profile">
					<ul class="form_list">
                                          <?php if ($user_profile->usertype == 'agency'):?>
					  <li>
					  	<label>Вид деятеьности:</label>
					  	<input <?php if (!$allow_edit): ?>disabled="disabled" <?php endif ?>type="text" name="brief" class="form-text" value="<?php echo $user_profile->brief ?>" />
					  	<?php if ($allow_edit): ?><a href="javascript:void(0)" class="btn_profile_edit"></a><?php endif ?>
					  </li>
					  <li>
					  	<label>Web-Сайт:</label>
					  	<input <?php if (!$allow_edit): ?>disabled="disabled" <?php endif ?>type="text" name="site" class="form-text" value="<?php echo $user_profile->site ?>" />
					  	<?php if ($allow_edit): ?><a href="javascript:void(0)" class="btn_profile_edit"></a><?php endif ?>
					  </li>

					  <li>
					  	<label>Адрес:</label>
					  	<input <?php if (!$allow_edit): ?>disabled="disabled" <?php endif ?>type="text" name="address" class="form-text" value="<?php echo $user_profile->address ?>" />
					  	<?php if ($allow_edit): ?><a href="javascript:void(0)" class="btn_profile_edit"></a><?php endif ?>
					  </li>

					  <li>
					  	<label>Короткое описание:</label>
                                                <textarea <?php if (!$allow_edit): ?>disabled="disabled" <?php endif ?>type="text" name="short_desc" class="form-text" style="height: 100px;"><?php echo $user_profile->short_desc ?></textarea>
					  	<?//php if ($allow_edit): ?><a href="javascript:void(0)" class="btn_profile_edit"></a><?//php endif ?>
					  </li>

					  <li>
					  	<label>Полное описание:</label>
                                                <textarea <?php if (!$allow_edit): ?>disabled="disabled" <?php endif ?>type="text" name="description" class="form-text" style="height: 100px;"><?php echo $user_profile->description ?></textarea>
					  	<?php if ($allow_edit): ?><a href="javascript:void(0)" class="btn_profile_edit"></a><?php endif ?>
					  </li>
                                          <?php endif ?>

					  <li>
					  	<label>тел:</label>
					  	<input <?php if (!$allow_edit): ?>disabled="disabled" <?php endif ?>type="text" name="phone" class="form-text" value="<?php echo $user_profile->phone ?>" />
					  	<?php if ($allow_edit): ?><a href="javascript:void(0)" class="btn_profile_edit"></a><?php endif ?>
					  </li>
					  <li>
					  	<label>email:</label>
					  	<input <?php if (!$allow_edit): ?>disabled="disabled" <?php endif ?>type="text" name="email" class="form-text" value="<?php echo $user_profile->email ?>" />
					  	<?php if ($allow_edit): ?><a href="javascript:void(0)" class="btn_profile_edit"></a><?php endif ?>
					  </li>
					  <li>
					  	<label>skype:</label>
					  	<input <?php if (!$allow_edit): ?>disabled="disabled" <?php endif ?>type="text" name="skype" class="form-text" value="<?php echo $user_profile->skype ?>" />
					  	<?php if ($allow_edit): ?><a href="javascript:void(0)" class="btn_profile_edit"></a><?php endif ?>
					  </li>
					  <li>
					  	<label>ICQ:</label>
					  	<input <?php if (!$allow_edit): ?>disabled="disabled" <?php endif ?>type="text" name="icq" class="form-text" value="<?php echo $user_profile->icq ?>" />
					  	<?php if ($allow_edit): ?><a href="javascript:void(0)" class="btn_profile_edit"></a><?php endif ?>
					  </li>
                                          <!--
					  <li>
					  	<a href="#">Добавить контакт</a>
					  </li>
                                          -->
					</ul>
                                        </form>
					<h4 class="small">Стандартная статистика</h4>
					<ul class="text_list">
					<?php if(is_array($filter) || is_object($filter)) foreach ($standart as $n=>$v):?>
					  <li><?php echo $n.': '.$v?></li>
					<?php endforeach;?>
					</ul>
					<h4 class="small">Статистика по срезам на сайте</h4>
					<ul>
					<li>
					<ul>
						<li  style="float:left;margin-right: 150px;">Средння цена</li>
						<li  style="float:left;margin-right: 150px;">Мин / Макс цена</li>
						<li>Самое популярное</li>
					</ul>
					</li>
					<hr>
					<li  style="float:left;margin-right: 120px;">
					<ul class="text_list">
					<?php if(is_array($filter) || is_object($filter)) foreach ($site->rentPrice as $n=>$v):?>
					  <li><?php echo 'Комнат '.$n.': '.$v.' грн'?></li>
					<?php endforeach;?>
					</ul>
					</li>
					<li style="float:left;margin-right: 140px;">
					<ul class="text_list">
					<?php if(is_array($filter) || is_object($filter)) foreach ($site->Price as $v):?>
					  <li><?php echo $v['MIN'].' / '.$v['MAX'].' грн'?></li>
					<?php endforeach;?>
					</ul>
					</li>
					<li style="float:left;">
					<ul class="text_list">
					<?php if(is_array($filter) || is_object($filter)) foreach($site->mostPopular as $n=>$v ):?>
					<li><?php echo $n.': '.$v?></li>
					<?php endforeach;?>
					</ul>
					</li>
					</ul>
					<?php if($user_profile->usertype!='tenant'):?>
					<h4 class="small">Статистика поиска по удобствам</h4>
					<ul  class="text_list">
					<?php if(is_array($filter) || is_object($filter)) foreach ($filter as $n=>$v):?>
					<li><?php echo $n.': '.$v.'%'?></li>
					<?php endforeach;?>
					</ul>
					<?php endif;?>
					<div class="b_statistics">
						<h4>Средняя недельная аудитория</h4>
						<img src="img/statistics.png" alt="" /> 
					</div>

			  </div> <!-- end b_profile_text -->	
				<div class="clear"></div>
			</div><!-- end wrap -->

<script type="text/javascript">
  $(document).ready(function() {

      $('#profile .btn_profile_edit').click(function(){
          var input = $(this).prev();
          input.attr('disabled', '');
          input.focus();
      });

      $('#profile input').blur(function(){
          var input = $(this);
          input.attr('disabled', 'disabled');
          $.ajax({
                url: '/user/save_profile',
                type: "POST",
                dataType: "json",
                data: {
                    key: input.attr('name'),
                    val: input.val()
                },
                success: function(data) {
                    if (data.msg == 'ok') {
                        input.val('');
                        input.val(data.data);
                    } 
                    else if(data.msg == 'empty') {
						alert("Это поле не может быть пустым");
						input.val(data.data);
                        }
                    else {
                        showLogin();
                    }

                }
          });

      });
      $('#profile textarea').blur(function(){
    	  var input = $(this);
          input.attr('disabled', '');
          $.ajax({
              
                url: '/user/save_profile',
                type: "POST",
                dataType: "json",
                data: {
                    key: input.attr('name'),
                    val: input.val()
                },
                success: function(data) {
                    if (data.msg == 'ok') {
                        input.html(data.data);
                    } else {
                        showLogin();
                    }

                }
          });

      });

  $('#avatar_input').uploadify({
    'uploader'  : '/js/uploadify.swf',
    'script'    : '/user/avatar_upload',
    'cancelImg' : '/img/cancel.png',
    'folder'    : '/uploads',
    'auto'      : true,
    'multi'	: false,
    'queueSizeLimit' : 5,
    'buttonImg'	: '/img/b_plus.png',
     'width'    : 124,
    'onSelectOnce' : function(event,data) {
    		//$('.b_count_file').html('добавлено ' + data.filesSelected + ' фото')
    		//filesToUpload =  data.filesSelected;
     },
     'onError' : function(e,file_no, file_obj, error ){
    	 alert(error.type + ' Error: ' + error.info);
     },
     'onComplete' : function(event, ID, fileObj, response, data){
          $.ajax({
                url: '/user/avatar_upload',
                type: "POST",
                dataType: "json",
                data: {
                    file: response
                },
                success: function(data) {
                    $('#avatar_image').attr('src', '/upload/avatars/<?php echo $user_profile->id ?>/pic_93.jpg?'+Math.random());
                }
          });
     }
  });

  });
</script>

<?php include Kohana::find_file('views','footer'); ?>