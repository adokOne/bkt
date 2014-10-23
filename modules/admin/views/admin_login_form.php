<!DOCTYPE html>
<html lang="en"><head>
	
	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>BKT Admin login</title>
	<meta name="description" content="BKT Admin login">
	<meta name="author" content="Chernov Alexandr">
	<!-- end: Meta -->
	
	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- end: Mobile Specific -->
	
	<!-- start: CSS -->
	<link id="bootstrap-style" href="/css/admin/bootstrap.css" rel="stylesheet">
	<link href="/css/admin/bootstrap-responsive.css" rel="stylesheet">
	<link id="base-style" href="/css/admin/style.css" rel="stylesheet">
	<link id="base-style-responsive" href="/css/admin/style-responsive.css" rel="stylesheet">
	
	<!--[if lt IE 7 ]>
	<link id="ie-style" href="/css/admin/style-ie.css" rel="stylesheet">
	<![endif]-->
	<!--[if IE 8 ]>
	<link id="ie-style" href="/css/admin/style-ie.css" rel="stylesheet">
	<![endif]-->
	<!--[if IE 9 ]>
	<![endif]-->
	
	<!-- end: CSS -->
	

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- start: Favicon -->
	<link rel="shortcut icon" href="/img/favicon.ico">
	<!-- end: Favicon -->
	
			<style type="text/css">
			body { background: url(../images/admin/bg-login.jpg) !important; }
		</style>
		
		
		
<style type="text/css">.jqstooltip { position: absolute;left: 0px;top: 0px;visibility: hidden;background: rgb(0, 0, 0) transparent;background-color: rgba(0,0,0,0.6);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";color: white;font: 10px arial, san serif;text-align: left;white-space: nowrap;padding: 5px;border: 1px solid white;}.jqsfield { color: white;font: 10px arial, san serif;text-align: left;}</style></head>

<body>
		<div class="container-fluid">
		<div class="row-fluid">
					
			<div class="row-fluid">
				<div class="login-box">
					<div class="icons">
						<a title="на головну" href="/"><i class="icon-home"></i></a>
					</div>
					<h2>Вхід в панель адміністратора</h2>
					<form data-auto-controller="LoginController" class="form-horizontal" action="/admin/login" method="post">
						<fieldset>
							
							<div class="input-prepend" title="Username">
								<span class="add-on"><i class="icon-user"></i></span>
								<input type="email" required="required" class="input-large span10" name="username" id="username" placeholder=" -Логин- ">
							</div>
							<div class="clearfix"></div>

							<div class="input-prepend" title="Password">
								<span class="add-on"><i class="icon-lock"></i></span>
								<input required="required" class="input-large span10" name="password" id="password" type="password" placeholder=" -Пароль- ">
							</div>
							<div class="clearfix"></div>
							
							<label class="remember" for="remember"><div class="checker" id="uniform-remember"><span><input type="checkbox" name="remember" id="remember" style="opacity: 0;"></span></div>Запомятати мене за цим компьютером</label>

							<div class="button-login">	
								<button type="submit" class="btn btn-primary"><i class="icon-off icon-white"></i> Вхід</button>
							</div>
							<div class="clearfix"></div>
				</fieldset></form></div><!--/span-->
			</div><!--/row-->
			
				</div><!--/fluid-row-->
				
	</div><!--/.fluid-container-->

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
<script type="text/javascript" src="/js/jquery-ui-timepicker-addon.js"></script>
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
	


</body>
</html>