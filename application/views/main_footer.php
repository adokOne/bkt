
		<div id="footer">
			<div style="width: 800px;margin: 0 auto;">
			<div id="first">
			
			<a href="http://bkt"><img src="/images/logo_admin.png"></a>
			<p><b>Моб. (050) 503-41-55</b><br>
			<?php echo $lang["_address_"]?><br><br>
			
			Copyright 2010 www.bkt.lviv.ua</p>
			
			</div>
			
			<div id="second">
			<h6>РОЗДІЛИ САЙТУ</h6>
			<ul>
			<li><a href="/courses"><?php echo $lang["menu_1"]?></a></li>       
			<li><a href="http://bkt.lviv.ua/index.php?option=com_content&amp;view=category&amp;id=1&amp;pid=51">Прайс</a></li>
			<li><a href="http://bkt.lviv.ua/index.php?option=com_content&amp;view=category&amp;id=1&amp;pid=52">Контакти</a></li>
			
			</ul>
			</div>
			
			<div id="third">
			<h6>НАВЧАННЯ</h6>
			<ul>
				<?php ORM::factory("course")->reset_select();$coursesss = ORM::factory("course")->where("parent_id",null)->find_all();

				foreach($coursesss as $course):
					$course_l = $course->where("id_lang",$cur_lang)->courses_langs->current();
				?>
<?php $link = Router::$current_language == Kohana::config('multi_lang.default') ? "/" : "/".Router::$current_language."/";?>

			<li><a href="<?php echo $link.$course->seo_name?>"><?php echo $course_l!==false ? $course_l->name : ""?></a></li>           
<?php endforeach;?>
			
			</ul>
		</div>
			</div>

		</div><!--/footer-->



	</div><!--/main-->
		<span id="call_back_button" class="call_back_button sh_help_button_right" style="">
			<a href="#" class="sh_help_button_chat"></a>
			<div class="sh_help_button_line"></div>
<?php echo $lang["get_call_back_"]?>
		</span>
	</body>

</html>
