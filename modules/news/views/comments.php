
	<a data-auto-controller="SendFeedbackController" class="send" href="#" style="width: 150px;margin: 0 auto;display: block;font-weight: bold;text-shadow: 8px 3px 8px rosybrown;">
		<?php echo $lang["send_comment"]?>
	</a>
<?php if( $comments->count() > 0):?>

			<div class="wrap b_banner_news_list" data-auto-controller="FeedbckController">
				<div class="b_news_list">
					<?php foreach ($comments as $row): ?>

						<div class="b_news_item">
					  	
					  	<a href="#" class="more_link">
					  		<h1 style="margin: 0;margin-top: 20px;">
					  			<?php echo $row->name?>
					  		</h1>
					  	</a>
					  	<div class="b_date" style="float: right;color: gray;font-style: italic;"><?php  echo date::rusdate2("j M, Y ",$row->created_at);?></div>
					  	<p>
					  		<?php echo $row->text?>
					  	</p>							
						</div>
						<?php endforeach;?>
						<div class="clear"></div>						
						<?php # if($pag_render) echo $paginator->render();?>
				  </div> <!-- end b_news_list -->
					
					<div class="clear"></div>
			</div><!-- end wrap -->	



			<?php endif;?>	

		<div class="b_shadow b_shadow_2" style="display: none;" data-auto-controller="SendFeedbackController">
		  <div class="b_popup">
			<div class="b_text_content" style="text-align: center;">
			  <p><?php echo $lang["thanks_text"]?></p>
			  <div class="b_text_center">
				<form action="/comment" >
					<p>Ім'я</p>
					<input required="required" type="text" name="name" style="width: 250px;">
					<p>E-mail</p>
					<input required="required" type="email" name="email" style="width: 250px;">
					<p>Коментар</p>
					<textarea required="required" name="text" style="width: 250px;height: 100px;"></textarea>
					<input type="hidden" value="<?php echo $page_id?>" name="page_id">
				</form>
				<a href="#" class="button"class="color: white;text-decoration: none;font-weight: bold;" ><em class="b_rs"></em><?php echo $lang["do_send"]?></a>
			  </div><!-- b_text_center -->
			</div><!-- b_text_content -->
		  </div><!-- b_popup -->
		</div>

			