	<div id="main_blog">
		<div id="sec_menu">БЛОГ </div>
		<div class="sdmenu" style="text-align: center;">
			<?php foreach($news as $k=>$n):?>
			<div>
				<span>
					<h1 class="one1" style="margin-left: 20px; <?php if(count($news) -1  === $k) echo 'border-bottom:none;'?>">

					<a href="<?php echo Router::$current_language == "ua" ? "" : "/".Router::$current_language?>/blog/<?php echo $n->seo_name;?>.html" style="margin: 0;background-color: white;border: none;color: #666!important;">
						<?php echo $n->title?>
					</a>
					</h1>
				</span>
			</div>
			<?php endforeach;?>
		</div>
	</div>