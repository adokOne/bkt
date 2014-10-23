			<?php if(count($news) > 0):?>
			<div class="wrap b_banner_news_list">
				<div class="b_news_list">
					<?php foreach ($news as $new): $new->reset_select();?>

						<div class="b_news_item">
					  	
					  	<a href="<?php echo Router::$current_language == "ua" ? "" : "/".Router::$current_language?>/blog/<?php echo $new->seo_name;?>.html" class="more_link">
					  		<h1 style="margin: 0;margin-top: 20px;">
					  			<?php echo $new->title?>
					  		</h1>
					  	</a>
					  	<!--<div class="b_date"><?php # echo date::rusdate2("j M, Y г",strtotime($row->created_date));?></div>
					  	--><p>
					  		
					  		<?php echo text::limit_chars($new->anons,250,"...")?>
					  	</p>
						<p style="text-align: right;">Коментарів: <span style="color:black!important"><?php echo $new->comments->count(); ?></span> | Переглядів: <span style="color:black!important"><?php echo $new->views_count?></span></p>
						</div>
						<?php endforeach;?>
						<div class="clear"></div>						
						<?php # if($pag_render) echo $paginator->render();?>
				  </div> <!-- end b_news_list -->
					
					<div class="clear"></div>
			</div><!-- end wrap -->	
			<?php endif;?>					