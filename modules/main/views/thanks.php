<?php $lang= Kohana::lang("all");?>

<div id = "thanks_page" style="">

<p>Шановний(а) <b><?php echo $online->name?></b>, Ви залишили завку-запис на курс 

	<b>   <?php $course = ORM::factory("course")->where("id",$online->course_id)->find(); 
	echo $course->where("id_lang",$cur_lang)->courses_langs->current()->name?>
	
	</b>
	<?php if(is_null($online->is_group)):?>

	<?php else:?>

	<?php
	$groups = $course->groups->as_array();
	$group = $groups[($online->group - 1)];

	?>
	<p>Група <?php echo $online->group?></p>
	<p>Початок занять <?php echo $group->start_date ?></p>
	<p>Тривалість занять <?php echo $course->l_count ?> ак. год</p>
	<p>Вартість занять <?php echo $group->price ?> грн. (без урахування знижок)</p>




	<?php #var_dump($group );die;?>
	<?php endif;?>
	<br />
	<p style="text-align:center">У найближчий час до Вас зателефонують для уточнення інформації</p>



	<p>






</div>