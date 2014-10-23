<h1>Приглашения высланы успешно</h1>
      <div class="successfull_invitation">
        
        <p><strong>Приглашены следующие друзья:</strong></p>
        <div class="invited_friends">
        <?php if(count($added_users) > 0){?>
    		<?php foreach($added_users as $user){ ?>    
	          <div class="friend_1">
	             <a href="<?php echo url::base() . 'user/' . $user->username ?>"><img src="/img/avatars/<?php echo $user->id ?>/pic_33.jpg" width="33" height="33"></a>  
	             <div class="friend_nickname"><a href="<?php echo url::base() . 'user/' . $user->username ?>"><?php echo $user->username ?></a></div>
	
	             <span><?php echo $user->age;?> лет, <?php echo $user->city . ', ' . $user->country ?></span>
	          </div>
	         <?php } ?>
          <?php } ?>
         </div>
         
  
        <?php if(count($not_found) > 0){?>
        <p><strong>Но этих пользователей мы не нашли, поэтому проверьте правильность написания:</strong></p>
        <div class="didnt_find"><?php echo implode(', ', $not_found ) ?></div>
        <?php } ?>
      </div>
