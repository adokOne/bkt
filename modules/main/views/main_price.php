<?php $lang= Kohana::lang("all");?>

<div id = "price" style="margin: 0 auto;">

	<table style="font-family:Tahoma, Geneva, sans-serif; font-size:12px; color:#666; border:1px solid #e5e5e5; margin-top:10px" border="0" cellspacing="0" cellpadding="5" width="600" align="center">
		<tbody>
			<tr>
			<td width="300" align="center" bgcolor="#e5e5e5">
			<h2 style="font-size:14px; text-shadow:1px 1px #fff;"><?php echo $lang["ind_course"]?></h2>
			</td>
			<td width="70" align="center" bgcolor="#ffffff"><?php echo $lang["ind_course_count"]?></td>
			<td width="70" align="center" bgcolor="#e5e5e5"><?php echo $lang["price_uah"]?></td>
			</tr>
			<?php foreach($courses as $par=>$courses_): if($par == 0) continue;?>
				<tr>
					<td style="font-weight: bold;text-align: center;font-size: 20px;">
						<?php echo ORM::factory('course')->where("id",$par)->find()->where("id_lang",$cur_lang)->courses_langs->current()->name?>
					</td>
				</tr>
				
				<?php foreach($courses_ as $course):


				?>
				<tr>
				<td><?php echo $course->where("id_lang",$cur_lang)->courses_langs->current()->name?></td>
				<td align="center" bgcolor="#e5e5e5"><?php echo $course->l_count ?></td>
				<td align="center">
					<?php if($course->sale_price > 0):?>
					<strike>
						<?php echo $course->individual_price?>
					</strike>&nbsp;
					<font color="#ff0000">
						<?php echo $course->sale_price?>
					</font>
					<?php else:?>
						<?php echo $course->individual_price?>
					<?php endif;?>
				</td>
				</tr>
				<?php endforeach;?>
			<?php endforeach;?>
		</tbody>
	</table>

	<p class="zoom">&nbsp;</p>

<table style="font-family:Tahoma, Geneva, sans-serif; font-size:12px; color:#666; border:1px solid #e5e5e5; margin-top:10px" border="0" cellspacing="0" cellpadding="5" width="600" align="center">
	<tbody>
		<tr bgcolor="#e5e5e5">
			<td class="gggggggggg" align="center">
				<h2 style="font-size:14px; text-shadow:1px 1px #fff;">
					<?php echo $lang["group_lessons"]?>
				</h2>
			</td>
			<td width="90" align="center" bgcolor="#ffffff">
				<?php echo $lang["ind_course_count"]?>
			</td>
			<td style="text-align: center;" colspan="4" bgcolor="#cccccc">
				<p><?php echo $lang["price_uah"]?></p>
				<p><?php echo $lang["price_uah_for_1"]?></p>
			</td>
		</tr>
		<tr>
			<td width="85" align="center"><p><strong><?php echo $lang["people_count"]?></strong></p></td>
			<td width="64" align="center" bgcolor="#e5e5e5">---</td>
			<td width="85" align="center"><strong>2</strong></td>
			<td width="80" align="center" bgcolor="#e5e5e5"><strong>3-4</strong></td>
			<td width="80" align="center"><strong>5-6</strong></td>
			<td width="80" align="center" bgcolor="#e5e5e5"><strong>7-8</strong></td>
		</tr>
		<?php foreach($prices as $coyr=>$price_):?>
				<tr>
					<td style="font-weight: bold;text-align: center;font-size: 20px;">
						<?php  $course = ORM::factory("course")->where("id",$coyr)->find();
						echo $course->where("id_lang",$cur_lang)->courses_langs->current()->name?>
					</td>
				</tr>
		<?php foreach($price_ as $prc): ?>
		<?php foreach($prc as $price): ?>
		<tr>
			<td class="gggggggggg" width="500"><?php echo $price->course->where("id_lang",$cur_lang)->courses_langs->current()->name?></td>
			<td width="64" align="center" bgcolor="#e5e5e5"><?php echo $price->course->l_count?></td>
			<td width="85" align="center"><?php echo $price->price_1?></td>
			<td width="80" align="center" bgcolor="#e5e5e5"><?php echo $price->price_2?></td>
			<td width="80" align="center"><?php echo $price->price_3?></td>
			<td width="80" align="center" bgcolor="#e5e5e5"><?php echo $price->price_4?></td>
		</tr>
	<?php endforeach;?>
		<?php endforeach;?>
	<?php endforeach;?>
	</tbody>
</table>


</div>