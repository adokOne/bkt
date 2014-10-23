<?php include Kohana::find_file('views','header'); 
function cutStr($str,$sCount,$cutParam){

if(strlen($str) > $sCount){
    $str = substr($str,0,$sCount);
    $limit=strrpos($str,' ');
    $str = substr($str,0,$limit).$cutParam;
    }
return $str;
}
$link=str_replace('http://youtu.be/','http://www.youtube.com/embed/',$news->video);
?>

   <ul class="breadcrumbs_nav">
			  <li><a href="#">сдам</a></li>
			  <li><a href="/news">новости</a></li>
			  <li class="last">статья</li>
			</ul>
			<div class="wrap">
				<div class="b_news_open">
					<img src="<?php echo  $logo_path.'b_'.$news->n_id.'.jpg'?>"  class="left"  alt="" />
					<div class="b_date"><?php echo date::rusdate2($date_format,$news->n_updated)?></div>
					<h1><?php echo $news->n_title;?></h1>
					<cite><?php echo $news->n_brieftext;?></cite>
					
					<p><?php echo $news->n_fulltext;?></p>
					<div class="video">
					<?php if($news->video!=null || $news->video!=''):?>
					<iframe width="700" height="505" src="<?php  echo $link ?>?rel=0" frameborder="0" allowfullscreen></iframe>
					<?php endif;?>
					</div>
					<?php if (!empty($news->n_source))echo
					 '<p>Источник: <a href="'.$news->n_source.'">'.$news->n_source.'</a></p>';
					 include Kohana::find_file('views','social');
					 if(count($similar)!=0):?>				
					<h4>Новости по данной теме</h4>
					<ul class="related_news">
					<?php foreach ($similar as $sim):?>
					  <li>
					  	<div class="b_date"><?php echo date::rusdate2($date_format,$sim->n_updated)?></div>
					  	<a href="/news/<?php echo $sim->seo_name;?>">
					  		<?php echo $sim->n_brieftext;?>
					  	</a>
					  <?php endforeach; endif;?>
					</ul>
										<script>					
					$("a.message_box").click(function(){
						showLoader("<p><center>Ожидайте...</center></p>");
						  $.ajax({
							  type: "post",
							  url: "/pages/message_box",
							  data:"id="+$(this).attr("id"),
							  dataType: "json",
								 success: function(response){
									 setLoaderHTML(response.html)
								  }
							  
						 });
					});</script>
				</div> <!-- b_news_open -->
				
					<?php include Kohana::find_file('views','baner');?>
				
					<div class="clear"></div>
			</div><!-- end wrap -->						
<?php include Kohana::find_file('views','footer'); ?>