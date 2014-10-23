<?php defined('SYSPATH') OR die('No direct access allowed.');
$offset = isset($_POST['offset']) ? $_POST['offset'] : 1;
$current_page  = $offset;
$previous_page = $offset > 1;
$next_page     = $offset < $total_pages;
?>
<div class="paging_bootstrap pagination">
	<ul>
		<li class="prev <?php if(!$previous_page) echo "disabled"?>">
			<a class="<?php if ($previous_page)echo "sorting" ?>" data-type="offset" data-value="<?php echo $current_page - 1?>" href="#">← Назад</a>
		</li>
	<?php for ($i = $current_page - 2, $stop = $current_page + 3; $i < $stop; ++$i): ?>

		<?php if ($i < 1 OR $i > $total_pages) continue ?>
        <li class="<?php if ($current_page == $i)echo "active" ?>">
        
        	<a class="<?php if ($current_page != $i)echo "sorting" ?>" data-type="offset" data-value="<?php echo $i ?>" href="#"><?php echo $i ?></a>
        </li>
	<?php endfor ?>
	
	<?php if ($current_page <= $total_pages - 3): ?>
		<?php if ($current_page != $total_pages - 3) echo '<li class="active none"><a>&hellip;</a></li>' ?>
		<li><a class="sorting" data-type="offset" data-value="<?php echo $total_pages ?>" href="#"><?php echo $total_pages ?></a></li>
	<?php endif ?>
	
		<li class="next <?php if(!$next_page) echo "disabled"?>">
			<a class="<?php if ($next_page)echo "sorting" ?>" data-type="offset" data-value="<?php echo $current_page + 1?>" href="#">Далі → </a>
		</li>
	</ul>
</div>