<li id="friend_item_<?php echo $friend->id ?>">
 <div class="all_friends_listitem">
              <div class="pos_rel2">
                <div class="edit_friend" style="display: none;"></div>
                <div class="friend_edittools" style="display: none;"><a class="friend_delete" href="javascript:void(0);" rel="<?php echo $friend->id ?>"></a><a class="friend_leavealive" href="javascript:void(0);"></a></div>
                <img height="93" width="93" src="<?php echo url::base() . 'img/avatars/' . $friend->id . '/pic_93.jpg'?>" alt="">
                <div class="user_caption">
					<?php $data = MOJOUser::user_statistic($friend->id); ?>
                	<span class="capt_was"><?php echo $data['was'];?></span>
                	<span class="capt_friend"><?php echo $data['friends']; ?></span>
                	<span class="capt_will"><?php echo $data['will']; ?></span>
                </div>
              </div>
              <div class="friend_name"><?php echo $friend->firstname . ' ' . $friend->lastname ?></div>
              <div class="friend_comes">Иду: <a href="<?php echo url::base().'event/'. $event->id ?>"><?php echo $event->name ?></a></div>

 </div> 
</li>
<script>
Friendship.attach_drop_events();
</script>