<html>
<head>
<title><?php echo $activation_subject; ?></title>
</head>
<body>
Привет <?php echo$username; ?>,<br />
<br />
Ты запросил смену email на сайте <?php echo $site_name; ?>.<br/>
Для подтверждения нужно пройти <br />
по ссылке - <a href="<?php echo url::base(); ?>user/newemail/<?php echo $activation; ?>"><?php echo url::base(); ?>user/newemail/<?php echo $activation; ?></a><br />
<br />

<br />
Спасибо.<br />
<?php echo $site_name; ?><br />
</body>
</html>