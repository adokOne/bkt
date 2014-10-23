<h1><?php echo $lang['social_network_title']; ?></h1>
<?php echo form::open('user/social_network', array('class'=>'nets_data', 'method' => 'post', 'id' => 'social_network')); ?>
	<?php $i = 1;?>
	<?php foreach($networks as $network):?> 
	
 	<label><?php echo html::image("img/nets/net{$i}.gif", array('width' => 16, 'height' => 16, 'align' => 'left')); ?><?php echo $network; ?>:</label>
 	<?php $fieldname = str_replace(".","",$network); ?>
    <?php echo form::input($fieldname,$user->$fieldname, 'class="text_input"');?>
    <?php $i++; ?>
	<?php endforeach;?>
	<input name="submit" type="submit" class="save" value="Сохранить" />
<?php echo form::close(); ?>

<script type="text/javascript">
 $(document).ready(function(){
 	$('#social_network').submit(function(event){
 		event.preventDefault();
 		
 		$(this).ajaxSubmit({
	 		dataType: "json",
   			data: { save_data: 1 },
   			success: function(responce){
	   			if(responce.msg == 'ok'){
	   				$('#facebox .content').html('<center>Успешно сохранено!<br><input type="button" value="Ok" onclick="$.facebox.close();"></center>')
	   			} else {
	   				alert(responce.data);
	   			}
   			}
 		});
 	});
 });
</script>