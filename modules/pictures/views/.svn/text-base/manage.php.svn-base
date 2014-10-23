<?php
$hide_flow = 1; $hide_days = 1; 
include Kohana::find_file('views','header'); ?>

<div class="pic_inner">
<h1><?php echo $lang['my_photoreports']; ?></h1>


<h2><?php echo $lang['old_events'] ?></h2>
</div>

  <!-- FOTO REPORT -->
  <div class="foto_report">

    <div class="foto_report_left"></div>
    <div class="foto_report_right"></div>
    <ul id="mycarousel" class="jcarousel-skin-tango">
     <?php foreach($was_events as $event){?>
      <li><span></span><img alt="" src="<?php echo url::base(); ?>img/events/<?php echo $event->id ;?>/small2_pic.jpg" class="jcenter event_item<?php if(!empty($go_to) && $go_to==$event->id ) echo ' selected' ?>" width="64" height="64" onclick="show_event_pics(<?php echo $event->id; ?>)" /></li>
         
     <?php }?>
    </ul>

  </div>
  <!-- END FOTO REPORT -->
  	
<div class="pic_inner">
	<div id="uploded_block"></div>
</div>
  
  
  <script type="text/javascript">
  	var pic_names = [];
	jQuery('#mycarousel').jcarousel({
    	visible: 4
    });
	
	$(document).ready(function(){
		$('.event_item').click( function(eventObj){
			$('.event_item').removeClass('current');
			$(this).addClass('current');
		});

		$('a[rel*=facebox]').facebox();

		if( $('.selected').length ){
			$('.selected').click();
			$('.add_new a').click();
		}
	});

	function show_event_pics( event_id ){
		var pic_block = '<div class="add_new">'
							+ '<a href="/pictures/uploader_form/' + event_id + '" rel="facebox"><?php echo $lang['add_new_photos'] ?></a>'
							+ '</div>'
							+ '<div class="added_pictures"><img src="/img/loading.gif"></div>';
		$('#uploded_block').html(pic_block);
		$('#uploded_block .added_pictures').load('/pictures/get_event_pics/' + event_id);
		$('a[rel*=facebox]').facebox();

		$(document).bind('close.facebox',function(){
			show_event_pics( event_id );
		});
	}

	function dropImage( u_id ){

		$.ajax({ 
			url: "/pictures/drop_image/" + u_id, 
			success: function(){
				$('#ju_' + u_id ).hide();
	     	},
			error: function(){
				alert('Ошибка');
	     	}
	     });
		
		return false;
	} 
	
	function save_name(u_id, name){
		if( pic_names[u_id] != name ){
			pic_names[u_id] = name;
			$.ajax({ 
				url: "/pictures/change_name/" + u_id,
				data: ({name : name}),
				type: "POST",
				success: function(){
					
		     	},
				error: function(){
					alert('Ошибка сохранения нового названия');
		     	}
		     });
		     
		}		
	}

	function init_pictools(){
		$('.img_item').unbind( 'mouseenter' );
		$('.img_item').unbind( 'mouseleave' );
		$('.edit_pics').unbind( 'click' );
		$('.pics_leavealive').unbind( 'click' );
		$('.pics_delete').unbind( 'click' );
		
		
	   $('.img_item').mouseenter(function(){
			$(this).find('.edit_pics').show();
	   });

	   $('.img_item').mouseleave(function(){
			$(this).find('.edit_pics').hide();
			$(this).find('.pics_edittools').hide();
	   });
		
	   $('.edit_pics').click(function(){
			$(this).parent().find('.pics_edittools').show();
	   });

	   $('.pics_leavealive').click(function(){
		  $(this).parent().hide();
	   });

	   $('.pics_delete').click(function(){
			  id = $(this).attr('rel');
			  droppic(id);
	   });
	}

	function droppic(id){
		 $.ajax({
       	  url: "/pictures/remove_image/" + id, 
       	  dataType: 'json',
       	  type: 'POST',
       	  success: function(data){
           	  if(data.msg == 'ok'){
           		$('#my_pic_item_' + id).hide();
           	  }else {
           		  alert(data.data);
           	  }
         	}    
         })
		
	}	    
  </script>



<?php include Kohana::find_file('views','footer'); ?>