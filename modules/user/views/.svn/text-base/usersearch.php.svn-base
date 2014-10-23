<?php 
$hide_flow = 1; 
include Kohana::find_file('views','header'); ?>
<script type="text/javascript">
    $(document).ready(function(){ 
		$("#search_city").selectbox();
		setGender(<?php if(!empty($fields['gender']) ) echo $fields['gender']; else echo 0; ?>);

		//set hidden values
		$('#compilance').val( <?php if(isset($fields['compilance']) ) echo $fields['compilance']; else echo 1; ?>);

		$('#age_min').val(<?php if( isset($fields['age_min']) ) echo  $fields['age_min']; else echo 5;  ?>);
		$('#age_max').val(<?php if( isset($fields['age_max']) ) echo  $fields['age_max']; else echo 25;   ?>);
		//activate selected value
		$('#i' + c_slider[<?php if(isset($fields['compilance']) ) echo $fields['compilance']; else echo 1; ?>] ).addClass('amount');
		
    }); 

    var slider;
    var ageslider;

    var c_slider = [];
    c_slider[0] = 46;
    c_slider[1] = 125;
    c_slider[2] = 163;
    c_slider[3] = 201;
    c_slider[4] = 241;
    c_slider[5] = 283;
        
    $(function() {

        $("#city").autocomplete({
    		source: "<?php echo url::site('/location/get_city');?>",
    		minLength: 2,
    		select: function(event, ui) {
    			$("#country").val( ui.item.country );
    		}

    	});


        
    slider = $(".level_slider").slider({
	    value: c_slider[<?php if(isset($fields['compilance']) ) echo $fields['compilance']; else echo 1; ?>],
	    min: 0,
	    max: 300,
	    stop: function(event, ui) {
	    
    		$('.slide_bar li').removeClass('amount');
    		
	    	if( ui.value < 75){
	    		$('#compilance').val('0');
	    		slider.slider('value', 46);
	    		$('#i46').addClass('amount');
	    	}else if (ui.value >= 75 && ui.value < 145 ){
	    		slider.slider('value', 125);
	    		$('#i125').addClass('amount');
	    		$('#compilance').val(1);
	    	}else if(ui.value >= 145 && ui.value < 180 ){
	    		slider.slider('value', 163);
	    		$('#i163').addClass('amount');
	    		$('#compilance').val(2);
	    	}else if(ui.value >= 180 && ui.value < 225 ){
	    		slider.slider('value', 201);
	    		$('#i201').addClass('amount');
	    		$('#compilance').val(3);
	    	}else if(ui.value >= 225 && ui.value < 270 ){
	    		slider.slider('value', 241);
	    		$('#i241').addClass('amount');
	    		$('#compilance').val(4);
	    	}else if(ui.value >= 270 && ui.value <= 300 ){
	    		slider.slider('value', 283);
	    		$('#i283').addClass('amount');
	    		$('#compilance').val(5);
	    	}
	    }
	});

	});

    $(function() {
    ageslider = $(".age_slider").slider({
	    range: true,
	    min: 0,
	    max: 10,
	    values: [<?php if( isset($fields['age_min']) && $fields['age_min'] >= 0 ) echo 'years2pos(' . $fields['age_min'] .',0)'; else echo 'years2pos(5)';  ?>,
	    		<?php if( isset($fields['age_max']) ) echo 'years2pos(' . $fields['age_max'] .',1)'; else echo 'years2pos(25)';  ?>],
	    
		
		stop: function(event, ui) {
			
			var l = ui.values[0];
			var r = ui.values[1];

			$('#age_min').val( pos2years(l) );
			$('#age_max').val( pos2years(r) );
			
			if(l<=1){
				ageslider.slider('values', [1,r]);
				$('#age_min').val(0);
			}else if(l> 1 && l<=2){
				ageslider.slider('values', [3,r]);
				$('#age_min').val(5);
	    	}
			if(r > 9){
				ageslider.slider('values', [l,9]);
				$('#age_max').val(100);
			}else if(r < 3){
				ageslider.slider('values', [l,2]);
				$('#age_max').val(0);
			}
		}
	});

	});

    function setGender(type){
    	$('#gengerselector').val(type);
    	$('.sex_block a').removeClass('active');
    	if(type == 1){
    		$('.guys').addClass('active');
    	}else if(type == 2){
    		$('.girls').addClass('active');
    	}else {
    		$('.nomatter').addClass('active');
    	}
    }

    function setSelType(type){
    	$('.persons_online, .all_persons').removeClass('active');
        if(type=='online'){
            $('.persons_online').addClass('active');
            $('#onlineselector').val('online');
        }else {
            $('.all_persons').addClass('active');
            $('#onlineselector').val('all');
        }
    }

    function pos2years(position){
        var years = 0; 
    	switch(position)
		{
    		case 1: case 2: years = 1; break;
			case 3: years = 5;   break;
			case 4: years = 18;  break;
			case 5:	years = 25;  break;
			case 6: years = 30;  break;
			case 7: years = 40;  break;
			case 8: years = 50;  break;
			case 9: years = 100; break;
		}				
		return years;
    }

    function years2pos (years, right){
        var position = 1; 
    	switch(years)
		{
    		case 0:   position = 1; break;
			case 5:   position = 3; break;
			case 18:  position = 4; break;
			case 25:  position = 5; break;
			case 30:  position = 6; break;
			case 40:  position = 7; break;
			case 50:  position = 8; break;
			case 100: position = 9; break;
		}				
		if(right && position == 1)
			return 2;
		else 
			return position;
    }
</script>
<!-- EVENT PAGE -->
<form action="<?php echo url::base() . 'user/search'; ?>" method="get">
	<div class="event_page people_search">
	    <div class="persons">
	        <a class="persons_online <?php if(!isset($fields['onlineselector']) || $fields['onlineselector'] == 'online' ) echo 'active'; ?>" href="javascript:void(0);" onclick="setSelType('online');"><em class="r"></em>Сейчас на сайте</a>
	        <a class="all_persons <?php if(!empty($fields['onlineselector']) && $fields['onlineselector'] == 'all' ) echo 'active'; ?>" href="javascript:void(0);"  onclick="setSelType('all');"><em class="l"></em>Все персоны</a>
	        <input type="hidden" name="onlineselector" id="onlineselector" value="<?php if(!empty($fields['onlineselector'])) echo $fields['onlineselector']; echo 'online'  ?>"></input>
	    </div>
	    <h1>Собери свою команду</h1>
	    
	    <div class="left_col3">
		<!-- AUTHOR'S ARTICLES -->
		<div class="h3 m0">
		    <em class="l"></em>
		    <em class="r"></em>
		    <h3>Интересные персоны</h3>
		</div>
		<?php foreach ($vip as $vip_user) {?>
		<?php $stat = MOJOUser::user_statistic($vip_user->id)?>
		<div class="list_item more_author">
		    <div class="person_foto">
			<img alt="" src="<?php echo url::base() . 'img/avatars/' . $vip_user->id . '/pic_93.jpg' ?>" class="jcenter" width="93" height="93" />
			
			<div class="user_caption">
			    <span class="capt_was"><?php echo $vip_user->was ?></span>
			    <span class="capt_friend"><?php echo $stat['friends']?></span>
			    <span class="capt_will"><?php echo $vip_user->will ?></span>
			</div>		    
		    </div>
		    <h4><?php echo html::anchor('user/' . $vip_user->username, $vip_user->firstname." ".$vip_user->lastname); ?></h4>
		    <div class="person_age"><span class="sex <?php if($vip_user->gender == 1):?>male<?php else: ?>female<?php endif;?>"></span><?php if(!empty ($vip_user->birthday) ) echo $vip_user->age . ' лет,' ;?></div>
		    <div class="person_city"><?php echo $vip_user->city . ( !empty($vip_user->country) ? ', ' . $vip_user->country : '')  ?></div>
	    </div>
	    <?php } ?>
		
		<div class="show_all">
		    <em class="l"></em>
		    <em class="r"></em>
		    <a href="http://mojo.tzifir.com/user/events/events">Как повысить карму?</a>
		</div>
		<!-- AUTHOR'S ARTICLES -->		
	    </div>
	    <div class="right_col3">
		<!-- LEVEL BLOCK-->
		<div class="gray_block">
		    <em class="l"></em><em class="r"></em>
		    <div class="level_block">
			<div class="level_label"><a href="">Уровень Вашего соответсвия</a></div>
			<div class="level_slider_block">
			    <div class="level_slider"></div>
			    <ul class="slide_bar">
				<li id="i46">без разницы</li>
				<li id="i125">20</li>
				<li id="i163">40</li>
				<li id="i201">60</li>
				<li id="i241">80</li>
				<li id="i283">100</li>
			    </ul>
			    <input type="hidden" name="compilance" id="compilance" value="">
			</div>
			<div class="sex_block">
			    <a class="nomatter" href="javascript: void(0);" onclick="setGender(0);">Без разницы</a>
			    <a class="girls" href="javascript: void(0);"  onclick="setGender(2);">Девушки</a>
			    <a class="guys" href="javascript: void(0);"  onclick="setGender(1);">Парни</a>
			    <input type="hidden" name="gender" value="0" id="gengerselector"></input>
			</div>
		    </div>
		</div>
		<!-- END LEVEL BLOCK-->

		<!-- SEARCH PARAMETERS -->	
		<div class="search_parameters">
		    <form method="post" action="#">
			<div class="select_label">Город</div>
			<?php echo form::input('city',isset($fields['city']) ? $fields['city'] : $user->city ,'class="search_parameters" style="float: left;"'); ?>
			<div class="age_label"><a href="">Возраст</a></div>
			<div class="age_slider_block">
			    <div class="age_slider"></div>
			    <ul class="slide_bar age">
				<li style="padding: 5px 0 2px; width: 70px; margin-right: 4px;">без разницы</li>
				<li>5</li>
				<li>18</li>
				<li>25</li>
				<li style="margin-left: 1px;">30</li>
				<li>40</li>
				<li style="margin-left: 1px;">50</li>
				<li>>50</li>
			    </ul>
			    <input type="hidden" name="age_min" id="age_min" value="">
			    <input type="hidden" name="age_max" id="age_max" value="">    
			</div>
			<input type="submit" class="peoplesearch_but" />
		    </form> 
		    <div class="clear-fix"></div>
		</div>
		<!-- END SEARCH PARAMETERS -->	
<input type="hidden" name="dosearch" value="1">
</form>

<?php if( !empty($error) ){ echo "<h2 class=\"error\">$error</h3>" ; }  ?>

<?php if(!empty($results) && $results_count ){?>
		<h2>Найдено <?php echo $results_count  ?> персон</h2>
		    <div class="join_them">
			<ul>
			<?php foreach($results as $c_user){ ?>
			<?php $stat = MOJOUser::user_statistic($c_user->id)?>
			    <li>
				<div class="pos_rel"><a href="<?php echo url::base().'user/'. $c_user->username ?>"><img alt="" src="<?php echo url::base() . 'img/avatars/' . $c_user->id . '/pic_93.jpg' ?>" class="jcenter" width="93" height="93" /></a>
				<div class="user_caption">
				    <span class="capt_was"><?php echo $c_user->was ?></span>
				    <span class="capt_friend"><?php echo $stat['friends'] ?></span>
				    <span class="capt_will"><?php echo $c_user->will ?></span>
				</div>
				</div>
				<h4><?php echo html::anchor('user/' . $c_user->username, $c_user->firstname." ".$c_user->lastname); ?></h4>			    
			    </li>
			    <?php } ?>
			</ul>				
		    </div>
		<?php }else {
			echo 'Ничего не найдено';
		}?>
		<?php echo $pagination->render(); ?>    
	    </div>
</div>
<?php include Kohana::find_file('views','footer'); ?>
