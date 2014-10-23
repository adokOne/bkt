<div>
	<ul id="navigation" style="list-style: none;margin: 0 auto;width: 570px;font-size: 24px;">
		<li style="margin: 10px;float:left">
			<a id="_program" href="#">
			<?php echo $lang["program"]?>
			</a>
		</li>
		<li style="margin: 10px;float:left">
			<a id="_pidgotovka" href="#">
				<?php echo $lang["pidgotovka"]?>
			
			</a>
		</li>
		<li style="margin: 10px;float:left">
			<a id="_price" href="#">
			<?php echo $lang["__price"]?>
			</a>
		</li>
		<li style="margin: 10px;float:left">
			<a id="_rozklad" href="#">
			<?php echo $lang["rozklad"]?>
			</a>
		</li>
	</ul>
	<img alt="<?php echo $course->img_alt?>" title="<?php echo $course->img_title?>" style="padding-right: 10px;float: left;" src="/upload/logos/<?php echo $course->id?>/pic_93.jpg?<?php echo text::random($type = 'alnum', $length = 8)?>" width="93" height="93">
	<p style="padding-top: 50px;">
		<?php echo trim($desc)?>
	</p>
<?php $nam_e = "text_".Router::$current_language; ?>
<div class="program" id="_pidgotovka_">
		<h3 style="color: #d57108;">
			<?php echo $lang["pidg"]?> 
		</h3>
		<p><?php echo $course->preparation->$nam_e  ?></p>
</div>

	<div class="program" id="_program_">
		<h3 style="color: #d57108;">
			<?php echo $lang["course_program"]?> <?php echo $course->where("id_lang",$cur_lang)->courses_langs->current()->name;?>
		</h3>
		<ul style="list-style: none;padding: 0;">
			<?php foreach($course->plans as $k =>$plan):?>
			<li>
				<p style="margin-bottom: 2px;font: 13px Verdana,sans-serif;">Тема <?php echo ($k+1)?>: <b style="font: 13px Verdana,sans-serif;"><?php $n = "name_".Router::$current_language;echo $plan->$n?></b></p>
				<ul style="margin-left: 30px;">
					<?php foreach($plan->plan_themes as $theme):?>
					<li style="font: 12px Verdana,sans-serif;">
							<p style="text-indent: 0;"><?php $n = "name_".Router::$current_language;echo $theme->$n?></p>
					</li>
					<?php endforeach;?>
				</ul>
			</li>
			<?php endforeach;?>
		</ul>
	</div>
	<?php if($course->groups->count() > 0) : ?>
	<div class="program">
		<h3 style="color: #d57108;"> <?php echo $lang["_groups_skoro"]?>
			
		</h3>
		<table style="font-family:Tahoma, Geneva, sans-serif; font-size:12px; color:#666; border:1px solid #e5e5e5; margin-top:10px" border="0" cellspacing="0" cellpadding="5" width="600" align="center">

				<tr style="text-align: center;font-weight: bold;">
					<td align="center" bgcolor="#e5e5e5" style="width: 145px;"><?php echo $lang["goup"]?></td>
					<td align="center" bgcolor="#e5e5e5"><?php echo $lang["po4_zan"]?></td>
					<td align="center" bgcolor="#e5e5e5"><?php echo $lang["4as_zan"]?></td>
					<td align="center" bgcolor="#e5e5e5"><?php echo $lang["days"]?></td>
					<td align="center" bgcolor="#e5e5e5"><?php echo $lang["k_t_ludey"]?></td>
					<td align="center" bgcolor="#e5e5e5"><?php echo $lang["price"]?></td>
					<td align="center" bgcolor="#e5e5e5"><?php echo $lang["zapus"]?></td>
				</tr>
			<tbody>
			<?php foreach ($course->groups as $k=>$row):?>
			<tr bordercolor="#000000" height="70" >
					<td style="border-bottom: 1px solid #e5e5e5;border-right: 1px solid #e5e5e5;" align="center">
						<p style="text-indent: 0;" ><?php echo ($k+1)?></p>
					</td>
					<td style="border-bottom: 1px solid #e5e5e5;border-right: 1px solid #e5e5e5;" align="center">
						<p style="text-indent: 0;" ><?php echo $row->start_date?></p>
					</td>
					<td style="border-bottom: 1px solid #e5e5e5;border-right: 1px solid #e5e5e5;" align="center">
						<p style="text-indent: 0;" ><?php echo substr($row->time_from,0,-3)."  ".substr($row->time_to,0,-3)?></p>
					</td>
					<td style="border-bottom: 1px solid #e5e5e5;border-right: 1px solid #e5e5e5;" align="center">
						<p style="text-indent: 0;" ><?php echo $row->days?></p>

					</td>
					<td style="border-bottom: 1px solid #e5e5e5;border-right: 1px solid #e5e5e5;" align="center">
						<p style="text-indent: 0;" ><?php echo $row->people_count?></p>

					</td>
					<td style="border-bottom: 1px solid #e5e5e5;border-right: 1px solid #e5e5e5;" align="center">
						<p style="text-indent: 0;" ><?php echo $row->price?></p>

					</td>
					<td style="border-bottom: 1px solid #e5e5e5;" align="center">
						<a href="#" onclick="doOnlineReg(<?php echo $row->course_id.",".($k+1)?>,1);return false" style="text-indent: 0;" >
							<img src="/images/buy.png" width= "40"/>
						</a>

					</td>
			</tr>
			<?php endforeach;?>

			</tbody>
		</table>

	</div>
<?php endif;?>
	<div class="program" id="_rozklad_">
		<h3 style="color: #d57108;">  <?php echo $lang["truv_cursu"]?> <?php echo $course->where("id_lang",$cur_lang)->courses_langs->current()->name;?>  
			<b ><?php echo $course->l_count ?></b><?php echo $lang["ak_god"]?>
		</h3>
	</div>
	<div class="program" id="_price_" style="margin-top: 30px;">
		<span style="color: #d57108;"><?php echo $lang["vart_ind_course"]?>
			<b ><?php echo $course->individual_price ?></b> грн.
		</span>
		<a href="#" style="color: gray;font-weight: bold;" onclick="doOnlineReg(<?php echo $course->id.",0"?>,0);return false" style="text-indent: 0;" >
			<?php echo $lang["ind_zapus"]?>
		</a>
<p><span style="color:red;font-size: 18px;">*</span><?php echo $lang["ind_desc"]?></p>
	</div>

	<?php if($course->has_presentation >0):?>
	<div class="program" id="">
	<p><?php echo $lang["presentation_desc"]?> <a href="/upload/presentations/<?php echo $course->present_name?>">Завантажити</a></p>
	</div>
	<?php endif;?>


</div>