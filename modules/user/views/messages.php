<?php include Kohana::find_file('views','header'); ?>
			<ul class="breadcrumbs_nav">
			  <li><a href="#">главная</a></li>
			  <li class="last">профиль</li>
			</ul>
			<div class="wrap">
				<?php include Kohana::find_file('views','user_menu'); ?>
				<div class="b_profile_body">
			<?php widget::render('messages','user_messages',$new); ?>
			  </div> <!-- end b_profile_text -->	
				<div class="clear"></div>
			</div><!-- end wrap -->						
<?php include Kohana::find_file('views','footer'); ?>
	