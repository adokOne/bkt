<h1>Редактирование основной информации</h1>
<form id="profile_form" action="/user/edit" method="post" class="user_info">

	 <fieldset>
	 	<?php form::legend('More about you', array('id' => 'more_infos')); ?>
	 	<legend>Личная информация:</legend>
		<div class="p">
	    	<div class="left_fields">
	        	<?php echo form::label('firstname',$lang['firstname']); ?>
	            <?php echo form::input('firstname',isset($user->firstname) ? $user->firstname : "",'class="text_input"'); ?>
	        </div>
	        <div class="right_fields">
	        	<?php echo form::label('lastname',$lang['lastname']); ?>
	            <?php echo form::input('lastname',isset($user->lastname) ? $user->lastname : "", 'class="text_input"'); ?>
	        </div>
		</div>  
		
		<div class="p">
			<div class="left_fields">
	 			<label>Дата рождения<span>*</span></label>
	 			<div class="day_select">
					<select name="birthday" id="birthday">
						<option value="">число</option>
						<?php for($i=1; $i<32; $i++){
							echo "<option value=\"$i\" ";
							if (!empty($user->birthday ) && date('j', $user->birthday ) == $i)
								echo 'selected="selected"';
							echo ">$i</option>";
			  			}?>
					</select>
				</div>  
				<div class="month_select">
	          		<select name="birthmonth" id="birthmonth">
	       				<option value="">месяц</option>
	       				<?php for($i=1; $i<13; $i++){
	       					echo "<option value=\"$i\" ";
							if (!empty($user->birthday ) && date('n', $user->birthday ) == $i)
								echo 'selected="selected"';
							echo ">" . Kohana::lang('calendar.month.'.$i) ."</option>";
	       				}  ?>
					</select>
				</div>
				<div class="year_select">
					<select name="birthyear" id="birthyear">
						<option value="">год</option>
						<?php for($i=1995; $i>1925; $i--){
							echo "<option value=\"$i\" ";
							if (!empty($user->birthday ) && date('Y', $user->birthday ) == $i)
								echo 'selected="selected"';
							echo ">$i</option>";
						}  ?>
					</select>
				</div>  
				<div class="dont_show" style=" margin: 45px 0 0 0"><span><input id="dont_show_brdth" type="checkbox" /></span><span  class="dont_show_txt"><strong>Не показывать год рождения</strong></span></div>
			</div>
			<div class="right_fields">
				<label>Пол<span>*</span></label>
				<span class="girl<?php if($user->gender == 2): echo " active"; else: echo ""; endif;?>"></span>
				<div class="slider2">
					<div class="slider2_left"></div>
					<div class="slider2_right"></div>
					<div class="slider-handle" style="left: <?php if($user->gender == 2): echo "4"; else: echo "64"; endif;?>px"></div>
				</div>	
				<input type="hidden" name="gender" value="<?php echo $user->gender; ?>" id="slider" />
				<span class="boy"></span>
			</div>
		</div>
		<div class="p no_over_hid">
			<div class="left_fields">
				<?php echo form::label('country',$lang['country']); ?>
				<?php echo form::input('country',isset($user->country) ? $user->country : "",'class="text_input"'); ?>
			</div>
			<div class="right_fields">
				<?php echo form::label('city',$lang['city']); ?>
				<?php echo form::input('city',isset($user->city) ? $user->city : "",'class="text_input"'); ?>
			</div>
		</div>
		
		<div class="p">
			<div class="left_fields">
                <?php echo form::label('phone',$lang['phone']); ?>
                <?php echo form::input('phone',isset($user->phone) ? $user->phone : "",'class="text_input"'); ?>
            </div>
            <div class="right_fields">
                <?php echo form::label('url',$lang['my_website']); ?>
                <?php echo form::input('url',isset($user->url) ? $user->url : "",'class="text_input"'); ?>
            </div>
		</div>
	    <div class="p">  
			<?php echo form::label('about',$lang['about']); ?>
			<?php echo form::textarea('about',isset($user->about) ? $user->about : ""); ?>
		</div>   
		<input type="submit" name="" value="<?php echo $lang['save'] ?>" class="save" id="submit_profinfo">
	</fieldset>
</form>
<?php if(empty($user->login_from)){?>
<form id="profile_newemail" action="/user/newemail" method="post" class="user_info">
	<fieldset>
		<?php echo form::legend($lang['change_email']); ?>
		<div class="p">
	    	<div class="left_fields">
	    		<?php echo form::label($lang['new_email']); ?>
	    		<input type="text" name="new_email_field" id="new_email_filed" class="text_input"/>
	    	</div>
	    	<div class="right_fields">
	        	<div style="padding:30px 0 0 0"><?php echo $lang['new_email_description']?></div>
	        </div>
	    </div>
	              <input type="submit" class="send_new_email"  value="$lang['send_activation_to_new_email']" /> 
	</fieldset>
</form>

<form id="profile_newpass" action="/user/newpass" method="post" class="user_info">
	<fieldset>
		<?php echo form::legend($lang['change_pass']); ?>
		<div class="p">
        	<?php echo form::label('pass_curr',$lang['current_password']); ?>
        	<?php echo form::password('pass_curr','','class="text_input"'); ?>
        </div>
        <div class="p">
        	<div class="left_fields">
              <?php echo form::label('new_password',$lang['new_password']); ?>
              <?php echo form::password('new_password','','class="text_input"'); ?>
            </div>  
            <div class="right_fields">
              <?php echo form::label('new_password_retype',$lang['new_password_retype']); ?>
              <?php echo form::password('new_password_retype','','class="text_input"'); ?>
            </div>  
       </div>  
       <input type="submit" class="confirm_pass"  value="<?php echo $lang['approve_password_change'] ?>" /> 
	</fieldset>
</form>
<?php }else {?>
<form id="newnickname" action="/user/newnickname" method="post" class="user_info">
	<fieldset>
		<?php echo form::legend($lang['change_username']); ?>
		<div class="p">
	    	<div class="left_fields">
	    		<?php echo form::label($lang['current_username']); ?>
	    		<input type="text" name="new_username_field" id="new_username_filed" class="text_input" value="<?php echo $user->username?>"/>
	    	</div>
	    </div>
	         <input type="submit" name="" value="<?php echo $lang['save'] ?>" class="save" id="submit_profinfo"> 
	</fieldset>
</form>
<?php }?>

<script>
$(function() {
    $("#phone").mask("(999) 999-9999");
    $("#city").autocomplete({
		source: "<?php echo url::site('/location/get_city');?>",
		minLength: 2,
		select: function(event, ui) {
			$("#country").val( ui.item.country );
		}

	});
	$("#country").autocomplete({
		source: "<?php echo url::site('/location/get_country');?>",
		minLength: 2,
	});
	
	$('#profile_form').validate({
			rules: {
				firstname: {
					required: true,
					minlength: 3
				},
				birthday: { required: true },
				birthmonth: { required: true },
				birthyear: { required: true },
				country: { required: true },
				city: { required: true },
				gender: { required: true }
			},
			groups: {
				birthdate: "birthday birthmonth birthyear",
				country: "country city"
			},
			errorPlacement: function(error, element) {
			    if (element.attr("name") == "birthday" || element.attr("name") == "birthmonth" || element.attr("name") == "birthyear")
			      error.insertAfter("#birthyear");
			    else if (element.attr("name") == "city" )
				      error.insertAfter("#country");
				else if (element.attr("name") == "gender" ){
					      $("#gender_err").html(error);
				}else
			       error.insertAfter(element);
			},
	
		   submitHandler: function(form) {
	   	   		$(form).ajaxSubmit({
		   			dataType: "json",
		   			data: { save_data: 1 },
		   			success: function(responce){
			   					if(responce.msg == 'ok'){
			   						$('.user_location_wrapper').html( responce.data.age + ' лет, ' + responce.data.city + ', ' + responce.data.country );
					   				$('.photo_name .name p').html('<span class="sex female"></span>' + responce.data.firstname + ' ' + responce.data.lastname);
					   				//$('#facebox .content').html('<center>Успешно сохранено!<br><input type="button" value="Ok" onclick="$.facebox.close();"></center>')
					   				$.facebox.close();
				   				}else {
					   				alert(responce.data);
				   				}
				   		}		
	   			});
				return false;
			}
	});

	$('#profile_newemail').validate({
		rules: {
			new_email_field: {
				required: true,
				minlength: 5,
				email: true
			}
		},
	    submitHandler: function(form) {
   	   		$(form).ajaxSubmit({
	   			dataType: "json",
	   			data: { save_data: 1 },
	   			success: function(responce){
		   					if(responce.msg == 'ok'){
				   				$('#facebox .content').html('<center>' + responce.data + '<br><input type="button" value="Ok" onclick="$.facebox.close();"></center>')
			   				}else {
				   				alert(responce.data);
			   				}
			   		}		
   			});
			return false;
		}
	});

	$('#newnickname').validate({
		rules: {
			new_username_field: {
				required: true,
				minlength: 5
			}
		},
	    submitHandler: function(form) {
   	   		$(form).ajaxSubmit({
	   			dataType: "json",
	   			data: { save_data: 1 },
	   			success: function(responce){
		   					if(responce.msg == 'ok'){
		   						window.location = "<?php echo url::base() ?>user/" + responce.username
			   				}else {
				   				alert(responce.data);
			   				}
			   		}		
   			});
			return false;
		}
	});

	$('#profile_newpass').validate({
		rules: {
			pass_curr: {
				required: true,
				minlength: 4,
			},
			new_password: {
				required: true,
				minlength: 4,
			},
			new_password_retype: {
				required: true,
				minlength: 4,
				equalTo: "#new_password"
			}
		},
	    submitHandler: function(form) {
   	   		$(form).ajaxSubmit({
	   			dataType: "json",
	   			data: { save_data: 1 },
	   			success: function(responce){
		   					if(responce.msg == 'ok'){
				   				$('#facebox .content').html('<center>' + responce.data + '<br><input type="button" value="Ok" onclick="$.facebox.close();"></center>')
			   				}else {
				   				alert(responce.data);
			   				}
			   		}		
   			});
			return false;
		}
	});

	$(".slider2 .slider2_left").click(function(){
		$('.slider-handle').animate({
				left: '4'
		}, 400, function() {
			$('#slider').val(2);
		});
		$('.girl').addClass('active');
		$('.boy').removeClass('active');
	});
	$(".slider2 .slider2_right").click(function(){
		$('.slider-handle').animate({
			left: '64'
		}, 400, function() {
			$('#slider').val(1);
		});
		$('.boy').addClass('active');
		$('.girl').removeClass('active');
	});
	$("#birthday").selectbox();
	$("#birthmonth").selectbox();
	$("#birthyear").selectbox(); 
});
</script>