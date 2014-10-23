<?php $lang= Kohana::lang("all");
$data = array();
foreach ($schedule as $row){
	if($row->groups->count() > 0){
		$name = $row->where("id_lang",$cur_lang)->courses_langs->current()->name;
		foreach($row->groups as $group){

			
			$data[$name."_".$row->id][] = $group;
			
		}
	}

}


?>

<div style="" id = "grafic">
<div style="text-align:center;">
<a href="#" style="text-decoration: underline;font: 40px bold;" onclick="$('table').slideToggle();return false;">Розклад занять</a>
</div>
<table style="display:none;font-family:Tahoma, Geneva, sans-serif; font-size:12px; color:#666; border:1px solid #e5e5e5; margin-top:10px" border="0" cellspacing="0" cellpadding="5" width="600" align="center">

<tbody>
		<tr style="text-align: center;font-weight: bold;">
		<td align="center" bgcolor="#e5e5e5" style="width: 185px;"><?php echo $lang["course"]?></td>
		<td align="center"bgcolor="#e5e5e5"><?php echo $lang["goup"]?></td>
		<td align="center" bgcolor="#e5e5e5"><?php echo $lang["po4_zan"]?></td>
		<td align="center" bgcolor="#e5e5e5"><?php echo $lang["4as_zan"]?></td>
		<td align="center" bgcolor="#e5e5e5"><?php echo $lang["days"]?></td>
		<td align="center"bgcolor="#e5e5e5"><?php echo $lang["k_t_ludey"]?></td>
		<td align="center" bgcolor="#e5e5e5"><?php echo $lang["price"]?></td>

	</tr>
<?php foreach ($data as $k=>$row):?>
<tr bordercolor="#000000" height="70" >
		<td style="border-bottom: 1px solid #e5e5e5;border-right: 1px solid #e5e5e5;" align="center"><p><?php $r = explode("_",$k); echo $r[0]?></p></td>
		<td style="border-bottom: 1px solid #e5e5e5;border-right: 1px solid #e5e5e5;" align="center" >
			<?php foreach ($row as $h=>$r):?>
			<p style="text-indent: 0;" ><?php echo ($h+1)?></p>
			<?php endforeach;?>
		</td>
		<td style="border-bottom: 1px solid #e5e5e5;border-right: 1px solid #e5e5e5;" align="center">
			<?php foreach ($row as $r):?>
			<p style="text-indent: 0;" ><?php echo date("j.m.Y",strtotime($r->start_date))?></p>
			<?php endforeach;?>
		</td>
		<td style="border-bottom: 1px solid #e5e5e5;border-right: 1px solid #e5e5e5;" align="center">
			<?php foreach ($row as $r):?>
			<p style="text-indent: 0;" ><?php echo substr($r->time_from,0,-3)."  ".substr($r->time_to,0,-3)?></p>
			<?php endforeach;?>
		</td>
		<td style="border-bottom: 1px solid #e5e5e5;border-right: 1px solid #e5e5e5;" align="center">
			<?php foreach ($row as $r):?>
			<p style="text-indent: 0;" ><?php echo $r->days?></p>
			<?php endforeach;?>
		</td>
		<td style="border-bottom: 1px solid #e5e5e5;border-right: 1px solid #e5e5e5;" align="center">
			<?php foreach ($row as $r):?>
			<p style="text-indent: 0;" ><?php echo $r->people_count?></p>
			<?php endforeach;?>
		</td>
		<td style="border-bottom: 1px solid #e5e5e5;" align="center">
			<?php foreach ($row as $r):?>
			<p style="text-indent: 0;" ><?php echo $r->price?></p>
			<?php endforeach;?>
		</td>




</tr>
<?php endforeach;?>

</tbody>
</table>

<p><?php echo $desc?></p>
</div>