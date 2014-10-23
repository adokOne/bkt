<div class="images_list_container">
<?php
if(count($pictures) > 0){
	foreach($pictures as $picture){ ?> 
	<div class="img_item" id="my_pic_item_<?php echo $picture->id ?>">
			<div class="edit_pics" style="display: none;"></div>
            <div class="pics_edittools" style="display: none;"><a class="pics_delete" href="javascript:void(0);" rel="<?php echo $picture->id ?>"></a><a class="pics_leavealive" href="javascript:void(0);"></a></div>
			<a href="<?php echo url::base() ?>event/photo/<?php echo $picture->u_id ?>">
			<img height="93" width="93" alt="" src="<?php echo url::base() . '/img/pictures/' . $picture->event_id . '/' . $picture->u_id . '/s.jpg' ?>"></img>
			</a>
			<div class="added_pictures_name"><?php echo $picture->name ?></div>
			<div class="added_pictures_name"><?php echo $lang['users_count'] . " " . $picture->users_count ?></div>
			<div class="added_pictures_name"><?php echo $lang['comments_count'] . " " . $picture->comments_count ?></div>
	</div>		
	<?php } 
}else {
	echo $lang['NoPicturesUploadedByYou'];
}?>
</div>
<script>
	init_pictools();
</script>