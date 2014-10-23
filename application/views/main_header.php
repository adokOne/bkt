<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title><?php echo Router::$site_title ?></title>
		<meta name="description" content="<?php echo Router::$site_description ?>">
		<meta name="keywords" content="<?php echo Router::$site_keywords ?>">
		<link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
		<?php 
			echo stylesheet::render();
			echo javascript::render();
		?>
	</head>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-35592046-1']);
  _gaq.push(['_setDomainName', 'bkt.lviv.ua']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<body>
<script type="text/javascript"> _shcp = []; _shcp.push({widget_id : 557156, widget : "Chat", side : "left", position : "center", template : "orange", title : "Онлайн підтримка", title_offline : "В данний момент усі оператори відсутні, залиште ваше повідомлення та контактні данні." }); (function() { var hcc = document.createElement("script"); hcc.type = "text/javascript"; hcc.async = true; hcc.src = ("https:" == document.location.protocol ? "https" : "http")+"://widget.siteheart.com/apps/js/sh.js"; var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(hcc, s.nextSibling); })(); </script>
	<div id="top_orange_line"></div>
  <div id="header_but">
<a href="http://bkt.lviv.ua" id="home"></a>
<a href="#" id="map"></a>
<a href="mailto:bkt-support@ukr.net" id="mail"></a>

<a href="#" id="fb"></a>
<a href="http://vk.com/kyrsu_bkt" target="_blank" id="vk"></a>



</div>
<div id="main">
	<div id="lang">
                        <?php foreach(Kohana::config('multi_lang.allowed_languages') as $lang_lc => $language): ?>
                        <?php $url = url::current() =="main" ? "" : url::current();?>
                        <?php if(Router::$current_language==$lang_lc):?>
                        	<a href="#" style="text-decoration: none;">
                        		<img src ="/img/<?php echo $lang_lc ?>.gif"/>
                        	</a>
                        <?php elseif($lang_lc==Kohana::config('multi_lang.default')):?>
                        	<a style="text-decoration: none;" href="/<?php echo $url?>">
                        		<img src ="/img/<?php echo $lang_lc ?>.gif"/>
                        	</a>
                    	<?php else:?>
                    		<a style="text-decoration: none;" href="/<?php echo $lang_lc."/".$url?>">
                    			<img src ="/img/<?php echo $lang_lc ?>.gif"/>
                    		</a>
                        <?php endif;endforeach;?>
	</div>

<a href="http://bkt.lviv.ua"><img alt="<?php echo Kohana::config("core.sitename")?>" title="<?php echo Kohana::config("core.sitename")?>" src="/images/bkt/img/logo.png" border="0" id="logo"></a>
<div id="contacts">

	<div id="s"><img src="/images/bkt/img/skype.png" id="skype"><p id="skype_p">skype: <span style="color:#393939">natali_chabanyk</span></p></div>
	<div id="p"><img src="/images/bkt/img/phone.png" id="phone"><p id="phone_p">моб: <span style="color:#e6871f; font-weight:bold; font-size:14px; letter-spacing:1px">(098) 944 02 59 </span></p></div>



<br style="padding:0px; margin:0px"><div id="e"><img src="/images/bkt/img/e_mail.png" id="e_mail"><p id="e_mail_p">e-mail: <span style="color:#393939;">bkt-support@ukr.net</span></p></div>
</div><!--/contacts-->

<img src="/images/bkt/img/phone.jpg" id="phone_pic">

<div id="adress">
	<p id="our_adress"><?php echo $lang["address"]?>:</p>
	<p style="color:#e6871f; margin-top:10px; margin-bottom:5px"><?php echo $lang["_address"]?></p>
	
	<a href="http://bkt.lviv.ua/index.php?option=com_content&amp;view=category&amp;id=1&amp;pid=52"><?php echo $lang["where_it"]?></a>
</div>

<img src="/images/bkt/img/kompas.png" id="kompas">
<p style="color:red;font-weight:bold;text-align: center;display:none;">Знижка - 10% на всі травневі групи до 30.04.13</p>