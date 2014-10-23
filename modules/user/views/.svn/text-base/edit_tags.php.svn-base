<h1><?php echo $lang['edit_tags_title'];?></h1>

<div class="add_tags">
        <label>Новый тег:</label>
        <p>
          <input type="text" class="text_input new_tag" value="qwerty" />
          <input type="submit" class="add_tag" />
        </p>
        <div class="tags_block all_tags">
        
			<?php foreach(explode(",",$user->tags) as $tag):?>
				<?php echo '<span style="font-size:' . MOJOTagcloud::get_user_tagsize($user->id, utf8::strtolower(trim($tag))) . 'px">' . trim($tag) . "<a class='del'   href='javascript:void(0);'></a></span>"; ?>
		    <?php endforeach; ?>
       </div>  
      </div>
      
      <script type="text/javascript">
      	$(document).ready(function(){
			$('.add_tag').click(function(){
				var tag = $('.new_tag').val();
				if(tag.length == 0) return;
				edittag(tag,'add');
				
			});
			
		
			tag_helper();		
			
      	});
      	
      	function tag_helper(){
	      	$('.del').bind('click',function(){
				edittag($(this).parent().text(),'delete');
				$(this).parent().detach();
			});
      	}
      </script>