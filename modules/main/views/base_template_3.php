<div>

	<img alt="<?php echo $course->img_alt?>" title="<?php echo $course->img_title?>" style="padding-right: 10px;float: left;" src="/upload/logos/<?php echo $course->id?>/pic_93.jpg?<?php echo text::random($type = 'alnum', $length = 8)?>" width="93" height="93">
	<p>
		<?php echo trim($desc)?>
	</p>


	<div class="program">
		<h3 style="color: #d57108;"> 
			<?php echo $lang["courses"]?>

		</h3>
		<?php foreach($courses as $cours):?>
			<div style="width:290px;heigth:150px;float: left;margin-bottom: 10px;max-height: 93px;overflow: hidden;">
			<img alt="<?php echo $cours->img_alt?>" title="<?php echo $cours->img_title?>" style="padding-right: 10px;float: left;" src="/upload/logos/<?php echo $cours->id?>/pic_93.jpg?<?php echo text::random($type = 'alnum', $length = 8)?>" width="93" height="93">
	<?php $page = ORM::factory("pages_lang")->where(array("page_id"=>$cours->page->id ,"id_lang"=>$this->lang))->find(); ?>
	<?php $c = $cours->where("id_lang",$cur_lang)->courses_langs->current();?>
		<a href="/<?php echo url::current()."/".$cours->seo_name?>">
			<?php echo $c->name?>
		</a>
		<p>
		<?php echo $page === false ? "" : trim(strip_tags(text::limit_chars($page->text,100,'...')))?>
		</p>
			</div>
		<?php endforeach;?>
	</div>
	<div class="program" style="float: left;">
		<h3 style="color: #d57108;"> <?php echo $lang["_groups_skoro"]?>
			
		</h3>
		<table style="font-family:Tahoma, Geneva, sans-serif; font-size:12px; color:#666; border:1px solid #e5e5e5; margin-top:10px" border="0" cellspacing="0" cellpadding="5" width="600" align="center">

				<tr style="text-align: center;font-weight: bold;">
					<td align="center" bgcolor="#e5e5e5" style="width: 135px;"><?php echo $lang["course"]?></td>
					<td align="center"bgcolor="#e5e5e5"><?php echo $lang["goup"]?></td>
					<td align="center"bgcolor="#e5e5e5"><?php echo $lang["po4_zan"]?></td>
					<td align="center"bgcolor="#e5e5e5"><?php echo $lang["4as_zan"]?></td>
					<td align="center"bgcolor="#e5e5e5"><?php echo $lang["days"]?></td>
					<td align="center"bgcolor="#e5e5e5"><?php echo $lang["k_t_ludey"]?></td>
					<td align="center"bgcolor="#e5e5e5"><?php echo $lang["price"]?></td>
					<td align="center"bgcolor="#e5e5e5"><?php echo $lang["zapus"]?></td>
				</tr>
			<tbody>

			<?php foreach ($courses as $key => $course): $course->reset_select()?>
			<?php foreach ($course->groups as $k=>$row):?>
			<tr bordercolor="#000000" height="70" >
					<td style="border-bottom: 1px solid #e5e5e5;border-right: 1px solid #e5e5e5;" align="center">
						<p style="text-indent: 0;" ><?php $row->reload_columns();echo $course->where("id_lang",$cur_lang)->courses_langs->current()->name?></p>
					</td>
					<td style="border-bottom: 1px solid #e5e5e5;border-right: 1px solid #e5e5e5;" align="center">
						<p style="text-indent: 0;" ><?php echo ($k+1)?></p>
					</td>
					<td style="border-bottom: 1px solid #e5e5e5;border-right: 1px solid #e5e5e5;" align="center">
						<p style="text-indent: 0;" ><?php echo date("j.m.Y",strtotime($row->start_date))?></p>
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
			<?php endforeach; endforeach;?>

			</tbody>
		</table>

	</div>

</div>