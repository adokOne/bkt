<?php
$hide_flow = 1; $hide_days = 1; 
include Kohana::find_file('views','header'); ?>


<!--  FRIENDS PAGE -->
    <div class="fiendspage">
      <?php if ($my_friends){?>
      <h1>Мои друзья</h1>
      <h2 class="h2_add">Предложения дружбы</h2>  
      <div class="friend_blocks"> 
        <?php
        $float_l = true; 
        foreach($friend_req as $friend){ ?>
        <!-- ONE FRIEND BLOCK -->   
        <div class="friend_block <?php if($float_l) echo 'fl_l'; else echo 'fl_r'; ?>" id="frblid_<?php echo $friend->id ?>">

          <div class="friend_photo">
            <div class="photo2 <?php if($friend->gender == 1):?>male<?php else: ?>female<?php endif;?>">
              <img height="93" width="93" src="<?php echo url::base() . 'img/avatars/' . $friend->id . '/pic_93.jpg'?>" alt="">
              <div class="user_caption">
					<?php $data = MOJOUser::user_statistic($friend->id); ?>
                	<span class="capt_was" title="<?php if($friend->gender == 1):?>Был<?php else:?>Была<?php endif;?> на <?php echo $data['was'];?> событиях"><?php echo $data['was'];?></span>
                	<span class="capt_friend" title="<?php echo $data['friends']; ?> друзей"><?php echo $data['friends']; ?></span>
                	<span class="capt_will" title="Пойдет на <?php echo $data['will']; ?>"><?php echo $data['will']; ?></span>
                </div>
            </div>
            <div class="friend_info">
              <p><span class="sex <?php if($friend->gender == 2) echo 'female'; else if($friend->gender == 1) echo 'male'; else echo 'xz' ?>"></span><?php echo $friend->firstname . ' ' . $friend->lastname ?></p> 
              <span><?php echo User_Model::modifier_getAge($friend->birthday) ;?> лет, <?php echo $friend->city . ', ' . $friend->country ?></span>
              <p class="correspondence_level">Уровень вашего соответствия</p>
              <div class="level_img"><img src="img/level_img.jpg" width="335" height="26" /></div>      
            </div>

          </div>
          <div class="friend_status">
            <div class="txtarea">
            <?php /*
              <div class="tr"><img alt="" class="txt_corner" src="img/txtarea_tl.gif" /></div>
              <div class="cntr"><div class="cntr_l">
                <p>Freeride is a relatively new discipline of mountain biking, combining different aspects of the sport such as downhill and dirtjumping which has progressed rapidly in recent years, and is now recognized as one of the most popular disciplines within mountain biking.</p>
              </div></div>
              
              <div class="br"><img alt="" class="txt_corner" src="img/txtarea_bl.gif" /></div>
				*/ ?>
            </div>  
          </div>
          <div class="friend_buttons">
            <a href="javascript: void(0);" class="accept" onclick="Friendship.approve(<?php echo $friend->id ?>)"><em class="l"></em><em class="r"></em><span>Принять приглашение</span></a>
            <a href="javascript: void(0);" class="decline" onclick="Friendship.decline(<?php echo $friend->id ?>)"><em class="l"></em><em class="r"></em><span>Отклонить приглашение</span></a>
          </div>
        </div>
        <!-- END ONE FRIEND BLOCK -->  
        <?php
        if($float_l)
        	$float_l = false;
        else 
        	$float_l = true; 
        } ?>
        
      </div>    
      <!-- ALL USER'S FRIENDS -->
	  <?php }else {?>
      <h1>Друзья <?php echo $owner->username ?></h1>
      <?php }?>
      
      <div class="all_user_friends">
        <select class="events_select"><option value="1-50 событий">1-50 событий</option></select>
        <h2>Друзья<span class="quantity">всего: <a href="http://mojo.me/user/admin/friends" id="all_friends_count"><?php echo count($friends);?></a> сейчас на сайте: <a href="#"><?php echo $online_count ?></a></span></h2>
        <?php if ($my_friends){?><a href="<?php echo url::base() . 'friends/add_form'?>" class="add_friends" rel="facebox" onclick="return false;"><em class="l"></em><em class="r"></em><span>Пригласить друзей</span></a><?php } ?>
      </div>

      <div class="all_friends_list friend_photo">
        <ul>
          <?php foreach($friends as $friend){ ?>
          
          <!-- list item -->
          <li id="friend_item_<?php echo $friend->id ?>">
            <div class="all_friends_listitem">
              <div class="pos_rel2 <?php if($friend->gender == 1):?>male<?php else: ?>female<?php endif;?>">
                <div class="edit_friend" style="display: none;"></div>
                <div class="friend_edittools" style="display: none;"><a class="friend_delete" href="javascript:void(0);" rel="<?php echo $friend->id ?>"></a><a class="friend_leavealive" href="javascript:void(0);"></a></div>
                <a href="<?php echo url::base() . 'user/' .  $friend->username ?>"><img height="93" width="93" src="<?php echo url::base() . 'img/avatars/' . $friend->id . '/pic_93.jpg'?>" alt="" /></a>
                <div class="user_caption">
					<?php $data = MOJOUser::user_statistic($friend->id); ?>
                	<span class="capt_was" title="<?php if($friend->gender == 1):?>Был<?php else:?>Была<?php endif;?> на <?php echo $data['was'];?> событиях"><?php echo $data['was'];?></span>
                	<span class="capt_friend" title="<?php echo $data['friends']; ?> друзей"><?php echo $data['friends']; ?></span>
                	<span class="capt_will" title="Пойдет на <?php echo $data['will']; ?>"><?php echo $data['will']; ?></span>
                </div>
              </div>
              <div class="friend_name"><?php echo $friend->firstname . ' ' . $friend->lastname ?></div>
              <div class="friend_comes">Иду: <a href="<?php echo url::base().'event/'. $users_vs_events[$friend->id]['event_id'] ?>"><?php echo $users_vs_events[$friend->id]['event_name'] ?></a></div>
            </div>  
          </li>
          <!-- end list item -->
          <?php } ?>
        </ul>    

      </div>  
      <!-- END ALL USER'S FRIENDS -->
	<script>
	 $(document).ready(function(){
		 Friendship.attach_drop_events();
		 $('a[rel*=facebox]').facebox(); 
	  });
	</script>
      
      <!-- MAJORITY COMES -->
      <div class="majority_comes">
        <h2 class="h2_are_going">Большинство друзей собирается на</h2>
      </div>
          <!-- CASUAL EVENTS -->
    <ul class="block1">
      <?php
      $col = 0;
      foreach($most_events as $row) {
		$col++;
      ?>
      <!-- ONE NEW -->
      <li <?php if($col == 5) echo 'class="new no_bg"'; else echo 'class="new"'; ?> >
        <div class="rubric"><a href="<?php echo url::base() . 'category/' . $row->catid ?>"><?php echo $row->catname ?></a></div>
        <div class="heading"><a href="<?php echo url::base() . 'event/' . $row->id ?>"><?php echo $row->name ?></a></div>
        <div class="place_info"><?php if($row->city_custom) echo text::limit_chars($row->city_custom,10,'&hellip;'); else echo $row->location_city; if($row->city_custom || $row->location_city) echo ', '; ?> 
        						<?php if($row->location_custom) echo text::limit_chars($row->location_custom,7,'&hellip;'); else echo '<a href="'. url::base() . 'location/' . $row->location_id .'">' . $row->location_name .'</a>' ?> 
        						<?php echo  strftime  ("%H:%I %e %B", $row->start_date)?></div>
        <div class="preview">
          <div class="left_mask2"></div>
          <div class="right_mask2"></div>
          <a href="<?php echo url::base() . 'event/' . $row->id ?>"><img src="<?php echo url::base() . 'img/events/' . $row->id . '/small2_pic.jpg' ?>" width="180" height="96" /></a>
        </div>
        <div class="description"><?php echo $row->teaser ?></div>
        <div class="added_by">добавила: <a href="/user/<?php echo $row->username ?>"><?php echo $row->username ?></a></div>
        <div class="tools">
          <ul>
            <li><em class="comm"></em><a href="<?php echo url::base() . 'event/' . $row->id ?>#comments"><?php echo $row->comments_count ?></a></li>
            <li>|</li>
            <li><em class="people"></em><a href="<?php echo url::base() . 'event/' . $row->id ?>#users" class="users_count_ev<?php echo $row->id ?>"><?php echo $row->users_count ?></a></li>
            <li>
            <?php if($logged_in) {?>
            <!--YES NO MAYBE-->
            <div class="status_option"><span class="status <?php if($row->type == 1) echo 'yes'; 
	            												 elseif ($row->type == 2) echo 'maybe'; 
	            												 elseif ($row->type == 3) echo 'no';
	            												 else echo 'plus'; ?>
            													 statusbtn_<?php echo $row->id ?>" <?php if(empty($row->type)) echo 'onclick="IllComeOnce('.$row->id.', this)" style="cursor: pointer;"'; ?> ></span><input class="choose_but" type="button" onclick="togglePanel(<?php  echo $row->id ?>, '.tools')" onmouseout="initiateClose()"/>
             <div class="more_status statuspanel_<?php  echo $row->id ?>" style="display: none;" onmouseover="restrictClosePanel()">
              <ul>
                <li class="will_come" onclick="IllCome(<?php  echo $row->id ?>, '.tools')">Пойду</li>
                <li class="maybe_will_come" onclick="MaybeIllCome(<?php  echo $row->id ?>, '.tools')">Возможно пойду</li>
                <li class="wont_come" onclick="IDontCome( <?php echo $row->id  ?>, '.tools')" <?php if(empty( $row->type ) || $row->type == 3) echo 'style="display: none;"' ?>>Не пойду</li>
              </ul>
             </div>
           </div>
           <!--END YES NO MAYBE-->
           <?php } ?>
           </li>
          </ul>
        </div>
      </li>
      <!-- END ONE NEW -->
      <?php } ?>
    </ul>
    <!-- END CASUAL EVENTS -->
  <script type="text/javascript">
	   var allow_close = false;
	   var users_counter_el = '.users_count_ev';

	   function closePanels(){
		   if(allow_close){
			   $('.more_status').hide();
		   }
	   }

	   function initiateClose(){
		   allow_close = true;
		   setTimeout ( 'closePanels()', 1000 );
	   }

	   function restrictClosePanel(){
		   allow_close = false;
	   }
	   
	   $(document).ready(function(){
		   $(".more_status").mouseleave(function(event){
			   								$(".more_status").hide();
									   });
	    });


		function togglePanel(id, parent){
			var el = '.statuspanel_' + id;

			if(parent){
				el = parent + ' ' + el;
			}
			
			if( $(el).css('display') == 'none' ){
				$('.more_status').hide();
				$(el).show();
			}else {
				$('.more_status').hide();
				$(el).hide();
			}
		}
		function IllCome(id, parent){
			togglePanel(id, parent);
			saveData(id, 'yes');
		}
		function MaybeIllCome(id, parent){
			togglePanel(id, parent);
			saveData(id, 'maybe');
		}

		function IllComeOnce(id, el){
			saveData(id, 'yes');
			el.onclick = null ;
			el.style.cursor = 'default';
		}
		
		function IDontCome(id, parent){
			togglePanel(id, parent);
			saveData(id, 'no');
		}
		function saveData(id, action){
			jQuery.ajax({ 	async: false,
							type: "POST",
							url: "/calendar/markevent",
							success: function(data){
								if(data == 1 || data == 0 || data == -1){
									$('.statusbtn_' + id ).removeClass().addClass('status').addClass(action).addClass('statusbtn_' + id);
									if(action != 'no')
										$('.statuspanel_' + id + ' .wont_come').show();
									else
										$('.statuspanel_' + id + ' .wont_come').hide();

									$(users_counter_el + id).text( $(users_counter_el + id).text() * 1.0 + data * 1.0 );
								}
								else
									alert(data);
					     	},
							data: {event: id, action: action}
						});
			
		}
	
	</script>
      <!-- END MAJORITY COMES -->



&nbsp;
<br />
&nbsp;
            
    
    </div>
<!--  END FRIENDS PAGE -->

<?php include Kohana::find_file('views','footer'); ?>