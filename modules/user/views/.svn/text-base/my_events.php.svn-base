<style>
	.my-ev-list {
		width: 600px;
	}
	.my-ev-list li{
		width: 296px;
		float: left;
		overflow: hidden;
		border: 2px solid white;
	}
	.my-ev-list li img {
		padding-right: 10px;
	}
	.my-ev-list li.active{
		border: 2px solid red;
	}
</style>
<?php if(count($events) > 0) {?>
<ul class="my-ev-list">	
<?php
	foreach( $events as $event ){ ?>
		<li id="<?php echo 'myev_' . $event->id ?>" onclick="select(<?php echo $event->id ?> , '<?php echo htmlspecialchars($event->name)?>')">
			<img alt="" src="/img/events/<?php echo  $event->id ?>/pic_50.jpg" width="50" height="50" align="left"/>
			<div class="event_date"><?php echo date('d.m.Y', $event->start_date) ?></div>
			<b><?php echo $event->name ?></b>
		</li>
	<?php } ?>
</ul>
<div style="clear: both;"></div>
<br />
<input type="hidden" id="selected_event_id" value=""></input>
<center><button id="confirm_btn" disabled="disabled" onclick="send_invite()" >Пригласить</button></center>
<?php }else {?>
	У вас нет будущих событий на которые вы идёте.
<?php }?>
<script>
	function select(id, name){
		 $('.my-ev-list li').removeClass('active');
		 $('#myev_' + id ).addClass('active');
		 $('#selected_event_id').val(id);
		 $('#confirm_btn').attr('disabled',null);
	}

	function send_invite(){
		var event_id = $('#selected_event_id').val();

		var message = event_id;

		$.post("/chat/sendInvite", 
				{to: '<?php echo $invited_user ?>', message: message} , 
				function(data){
					if(data == 1){
						$('#facebox .content').html('Ваше сообщение отправлено');
					}
				}
		);
	}
</script>