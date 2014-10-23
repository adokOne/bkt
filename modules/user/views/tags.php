<div class="user-tags">
<?php foreach(explode(",",$user->tags) as $tag):?>
	
		<?php echo '<span style="font-size:' . MOJOTagcloud::get_user_tagsize($user->id, utf8::strtolower(trim($tag))) . 'px">' . html::anchor("/tag/" . urlencode(trim($tag)), trim($tag)) . "</span>"; ?>
	
	<?php endforeach; ?>
</div>