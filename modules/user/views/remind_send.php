<?php
$hide_flow = 1; $hide_days = 1; 
include Kohana::find_file('views','header'); ?>

<div class="login_page">
	<h1><?php echo $lang['remind_send_title']; ?></h1><br/>
	<div class="login_tip"><?php echo $lang['remind_send_text']; ?></div>
</div>

<?php include Kohana::find_file('views','footer'); ?>