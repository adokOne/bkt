<?php include Kohana::find_file('views','header'); ?>
			<ul class="breadcrumbs_nav">
			  <li><a href="#">главная</a></li>
			  <li class="last">профиль</li>
			</ul>
			<div class="wrap">
				<?php include Kohana::find_file('views','user_menu'); ?>
				<div class="b_profile_body">
					<h1>Настройки</h1>
					
					<h4 class="small">Подписки</h4>
                                        <?php foreach ($mails as $mail): ?>
					<p>
                                            Комнат: <?php echo $mail->rooms_count ?><br/>
                                            <?php if ($mail->price_from > 0 && $mail->price_to > 0) echo "Цена: ".$mail->price_from." - ".$mail->price_to." грн.<br/>" ?>
                                            <?php if ($mail->area_from != 0 && $mail->area_to != 150) echo "Площадь: ".$mail->area_from." - ".$mail->area_to." м.кв.<br/>" ?>
                                            <?php if ($mail->floor_from !=0 && $mail->floor_to != 31) echo "Этаж: ".$mail->floor_from." - ".$mail->floor_to."<br/>" ?>
						<a class="unmail" id="unmail<?php echo ($mail->id)?>" href="#" class="more_link">Отписаться</a>
					</p>
                                        <?php endforeach ?>
                                        
					<div class="b_statics_ad">
						<h4 class="small">Статистика</h4>
						<!--span class="ad">Объявление <a href="#">№ 1 192 62914</a></span-->
						<ul class="link_list">
                                                <?php foreach ($periods as $period): ?>
						  <li><a href="#" id="p<?php echo $period->id ?>" <?php if($period->id == $user->period_id) echo 'class="bold"'?>><?php echo $period->name ?></a></li>
                                                <?php endforeach ?>
						</ul>
					</div>

                                        <!--
					<h4 class="small">Настройки показа</h4>
					<a href="#" class="btn_save">
						календарь
						<em class="b_left"></em>
						<em class="b_right"></em>
					</a>
					
					<div class="b_last_request">
						<h4 class="small">Мои последние запросы</h4>
						<ul class="link_list">
						  <li><a href="#">12 ноябрь 2011, 12:36</a></li>		
						  <li><a href="#">12 ноябрь 2011, 12:36</a></li>	
						  <li><a href="#">12 ноябрь 2011, 12:36</a></li>	
						  <li><a href="#">12 ноябрь 2011, 12:36</a></li>	
						  <li><a href="#">12 ноябрь 2011, 12:36</a></li>	
						  <li><a href="#">12 ноябрь 2011, 12:36</a></li>				  
						</ul>
					</div>
                                        -->

			  </div> <!-- end b_profile_text -->	
				<div class="clear"></div>
			</div><!-- end wrap -->

<script type="text/javascript">
$(document).ready(function() {



      $('.link_list a').click(function() {
          var self = this;
          $.ajax({
            url: '/user/set_period',
            type: "POST",
            dataType: "json",
            data: {
                id: self.id.slice(1)
            },
            success: function(data) {
                $('a.bold').removeClass("bold");
                $(self).addClass("bold");
            }
          });

      });

      $('a.unmail').click(function() {
          var self = this;
          $.ajax({
            url: '/user/unmail',
            type: "POST",
            dataType: "json",
            data: {
                id: $(self).attr('id').slice(6)
            },
            success: function(data) {
                if (data.success)
                    $(self).parent().hide();
            }
          });
      });
});
</script>
<?php include Kohana::find_file('views','footer'); ?>