<?php
$hide_flow = 1; $hide_days = 1; 
include Kohana::find_file('views','header'); ?>

<div class="login_page">
  <h1><?php echo $lang['registered_title'] ?></h1>
  <div class="login_tip"><?php echo $lang['registered_body'] ?></div>
</div>

<?php include Kohana::find_file('views','footer'); ?>
