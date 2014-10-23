<!DOCTYPE html>
<html lang="ru">
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<title>BKT Admin</title>
	<link rel="stylesheet" type="text/css" href="/css/admin/bootstrap.css" media="screen" />
    <link href="/css/admin/bootstrap-responsive.css" rel="stylesheet">
    <link id="base-style" href="/css/admin/style.css" rel="stylesheet">
    <link id="base-style-responsive" href="/css/admin/style-responsive.css" rel="stylesheet">
	<!-- start: JavaScript-->

		<script src="/js/admin/jquery-1.7.2.min.js"></script>
		<script src="/js/admin/jquery-ui-1.8.21.custom.min.js"></script>
	    <script src="/js/jquery.mvc.js"></script>
	    <script src="/js/controllers/login_controller.js"></script>
		<script src="/js/admin/bootstrap.js"></script>
	
		<script src="/js/admin/jquery.cookie.js"></script>
		<script src="/js/jquery.form.js"></script>
	
		<script src="/js/admin/fullcalendar.min.js"></script>
	
		<script src="/js/admin/jquery.dataTables.min.js"></script>

		<script src="/js/admin/excanvas.js"></script>
		<script src="/js/admin/jquery.flot.min.js"></script>
		<script src="/js/admin/jquery.flot.pie.min.js"></script>
		<script src="/js/admin/jquery.flot.stack.js"></script>
		<script src="/js/admin/jquery.flot.resize.min.js"></script>
	
		<script src="/js/admin/jquery.chosen.min.js"></script>
	
		<script src="/js/admin/jquery.uniform.min.js"></script>
		
		<script src="/js/admin/jquery.cleditor.min.js"></script>
	
		<script src="/js/admin/jquery.noty.js"></script>
	
		<script src="/js/admin/jquery.elfinder.min.js"></script>
	
		<script src="/js/admin/jquery.raty.min.js"></script>
	
		<script src="/js/admin/jquery.iphone.toggle.js"></script>
	
		<script src="/js/admin/jquery.uploadify-3.1.min.js"></script>
	
		<script src="/js/admin/jquery.gritter.min.js"></script>
	
		<script src="/js/admin/jquery.imagesloaded.js"></script>
	
		<script src="/js/admin/jquery.masonry.min.js"></script>
	
		<script src="/js/admin/jquery.knob.js"></script>
	
		<script src="/js/admin/jquery.sparkline.min.js"></script>

		<script src="/js/admin/custom.js"></script>
		<!-- end: JavaScript-->
    <?php javascript::render()?>
</head>
<body>
<?php include Kohana::find_file('views', 'header');?>
	<div class="container-fluid">
		<div class="row-fluid">
			<?php include Kohana::find_file('views', 'modules')?>
			<div id="content" class="span10" style="min-height: 635px;">
				<div class="btn_block">
					<hr>
					<?php echo $additional;?>
					<hr>
				</div>
				<?php echo $grid_content;?>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</body>
</html>