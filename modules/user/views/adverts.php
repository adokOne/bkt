<?php include Kohana::find_file('views','header'); ?>
<script type="text/javascript">
function typed(id, typef){
	if(typef==1)
		var control='/ads/user_favorite_ads';
	else 
		var control='/ads/user_ads';
	showLoader('<p><center>Загрузка...</center></p>');
	  $.ajax({
		  type: 'post',
		  url: control,
		  data: 'id='+id,
		  dataType: 'json',
		  success: function(msg){
				if(msg.msg == 'error'){
					alert('Произошла ошибка, перезагрузите страницу и попробуйте еще раз.');
					hideLoader();
				}else{
					$('.ad_list').html('');
					$('.ad_list').append(msg.html);
					hideLoader();
				}
			},
			error: function(msg){
				hideLoader();
				alert('Error occured on server. Please try again.');
			}
		  
			});
	
}

</script>
			<ul class="breadcrumbs_nav">
			  <li><a href="#">главная</a></li>
			  <li class="last">профиль</li>
			</ul>
			<div class="wrap">
				<?php include Kohana::find_file('views','user_menu'); ?>
				<div class="b_profile_body">
				<h1>Мои объявления</h1>
				<?php if($this->user->usertype=='tenant'):?><ul class="sort_list">
 					<li class="active"><a href="#" onclick="typed(<?php echo $id.',0';?>);">Мои объявления</a></li>
					<li><a href="#" onclick="typed(<?php echo $id.',1';?>);">Избранные</a></li>
				</ul><?php endif;?>
				<script>
				$('.sort_list li').click(function(){
					if (!$(this).hasClass('active')) {
						
						$('.sort_list li').removeClass('active');
						$(this).addClass('active');
						
					} else {
						return;
					}

				});
				</script>
		<?php widget::render('ads','user_ads',$id); ?>
			  </div> <!-- end b_profile_text -->	
				<div class="clear"></div>
			</div><!-- end wrap -->						
<?php include Kohana::find_file('views','footer'); ?>
