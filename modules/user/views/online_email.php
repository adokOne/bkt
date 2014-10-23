
<div>
<p>І'мя: <?php echo $user->name?></p>
<p>Телефон: <?php echo $user->phone?></p>
<p>Пошта: <?php echo $user->email?></p>
<p>Курс:<?php echo $curs;?></p>
<p>Группа:<?php echo $group;?></p>
<?php if($discount > 0):?>
	<p>Знижка за рахунуко купона "<?php echo $user->code ?>" <?php echo $discount ?> %</p>
<?php endif;?>

<p></p>
</div>