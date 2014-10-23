<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php 
	 function get_meta_desc(){
		$db			=& JFactory::getDBO();
        (empty($_REQUEST['pid'])) ? $id = 46 : $id = $_REQUEST['pid'];
		$sql = 'select metadesc from #__content where id = "'.$id.'"';
        $db->setQuery($sql);
        $rows = $db->loadObjectList();
        return $rows[0]->metadesc;
	}
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Комп'ютерні Курси у Львові, Бюро Комп'ютерних Технологій, Уроки, Навчання Львів</title>
<meta name="description" content="<?php echo get_meta_desc() ?>" />
<link rel="stylesheet" type="text/css" href="/templates/bkt/css/my_css.css" />
<script type="text/javascript" src="/templates/bkt/js/jquery.min.js"></script>
<script type="text/javascript" src="/templates/bkt/js/jqueryslidemenu.js"></script>
<script type="text/javascript" src="/templates/bkt/js/sdmenu.js"></script>
<link rel="stylesheet" type="text/css" href="/templates/bkt/css/sdmenu.css" />
<script type="text/javascript" src="/templates/bkt/js/prototype.js"></script>
<script type="text/javascript" src="/templates/bkt/js/scriptaculous.js?load=effects,builder"></script>
<script type="text/javascript" src="/templates/bkt/js/lightbox.js"></script>
<link rel="stylesheet" href="/templates/bkt/css/lightbox.css" type="text/css" media="screen" />


<script type="text/javascript">
	// <![CDATA[
	var myMenu;
	window.onload = function() {
		myMenu = new SDMenu("my_menu");
		myMenu.init();
	};
	// ]]>
</script>
<link rel="stylesheet" type="text/css" href="/templates/bkt/css/jqueryslidemenu.css" />
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
</head>

<body>
<div id="top_orange_line"></div>
<div id="main">

<a href="http://bkt.lviv.ua" id="home"></a>
<a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=47" id="map"></a>
<a href="mailto:bkt-support@ukr.net" id="mail"></a>

<a href="#" id="fb"></a>
<a href="http://vkontakte.ru/id10265263#/club14919796" target="_blank" id="vk"></a>


<a href="http://bkt.lviv.ua"><img src="/templates/bkt/img/logo.png" border="0" id="logo" /></a>

<div id="contacts">
<div id="s"><img src="/templates/bkt/img/skype.png" id="skype"/><p id="skype_p">skype: <span style="color:#393939">natali_chabanyk</span></p></div>
<div id="p"><img src="/templates/bkt/img/phone.png" id="phone"/><p id="phone_p">моб: <span style="color:#e6871f; font-weight:bold; font-size:14px; letter-spacing:1px">(098) 944 02 59</span></p></div>
<br style="padding:0px; margin:0px"/><div id="e"><img src="/templates/bkt/img/e_mail.png" id="e_mail"/><p id="e_mail_p">e-mail: <span style="color:#393939;">bkt-support@ukr.net</span></p></div>
</div><!--/contacts-->

<img src="/templates/bkt/img/phone.jpg" id="phone_pic" />

<div id="adress">
<p id="our_adress">Наша адреса:</p>
<p style="color:#e6871f; margin-top:10px; margin-bottom:5px">м. Львів,<br/>вул. Т. Костюшка 18</p>

<a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=52">а де це?</a>
</div>

<img src="/templates/bkt/img/kompas.png" id="kompas" />


<div id="myslidemenu" class="jqueryslidemenu" style="width:869px; background-image:url(/templates/bkt/img/menu.png); height:45px; margin-top:35px; padding:2px 3px 3px 3px ; background-repeat:no-repeat">
  
	
  <ul>
<!--<jdoc:include type="modules" name="topmenu" />-->
    <li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=46" >ПРО НАС</a></li>

    <li><a href="#" class="menu_bar">НАВЧАЛЬНІ КУРСИ&nbsp;&nbsp;&nbsp;</a>
      <ul>
        <li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=97">Базовий курс</a>
<ul>
<li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=97">Користувач ПК</a></li>
<li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=98">Користувач ПК за 7 днів</a></li>
</ul>

</li>
        <li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=62">Комп'ютерна графіка</a>

          <ul>
            <li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=74">Курси Photoshop</a></li>
            <li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=75">Курси Illustrator</a></li>
            <li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=76">Курси InDesign</a>
              <li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=77">Курси QuarkXpress</a>
              
            </li>
          </ul>
          

        </li>
        <li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=63">Комп'ютерна анімація</a>

          <ul>
            <li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=79">Курси Flash</a></li>
            <li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=80">Курси ActionScript</a></li>
            
              
            
          </ul>
          

        </li>
         <li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=64">Програмування</a>

          <ul>
            <li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=84">Програмування на C#</a></li>
            <li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=85">Програмування на C</a></li>
<li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=86">Програмування на C++</a></li>
            <li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=87">Програмування на PHP</a>
              <li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=88">Бази даних MySql</a></li>
            <li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=89">Веб-програмування</a></li>
            <li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=90">Програмування на JavaScript</a></li>
			<li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=106">XML / XSLT</a></li>
<li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=105">Java</a></li>
<li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=109">Objective C</a></li>
          </ul>
          

        </li>
        <li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=65">Іноземні мови</a>

          <ul>
            <li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=91">Англійська</a></li>
            <li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=92">Французька</a></li>
            <li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=93">Польська</a>
             
          </ul>
          

        </li>

<li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=63">Адміністрування</a>

          <ul>
            <li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=96">Будова IP-мереж</a></li>
            <li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=99">Будова локальних мереж</a></li>
            
              
            
          </ul>
          

        </li>


<li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=112">Автоматизоване тестування</a>

          

        </li>
<li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=64">Бухгалтерські курси</a>

          <ul>
            <li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=104">Програмування в 1С 7.7</a></li>
            <li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=107">1С:Бухгалтерія 8.2</a></li>
<li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=110">Бухгалтерський облік</a></li>
            <li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=87">1С:Бухгалтерія 7.7</a>
              <li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=113">Програмування в 1С 8</a></li>
           
          </ul>
          

        </li>
      </ul>
    </li>
    <li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=48" class="menu_bar">ДИЗАЙН&nbsp;&nbsp;&nbsp;</a>
    <ul>
            <li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=66">Створення сайтів</a></li>
            <li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=67">Створення фірмового стилю</a>
             
          </ul></li>
    <li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=49" class="menu_bar">ОБСЛУГОВУВАННЯ КОМП'ЮТЕРІВ&nbsp;&nbsp;&nbsp;</a>
      <ul>
        <li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=69">Базові послуги</a></li>
        <li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=70">Сервіси</a></li>
        <li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=71">Встановлення ПЗ</a></li>
        <li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=72">Мережеві послуги</a></li>
        <li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=73">Продаж ліцензійного ПЗ</a>

          <!--<ul>
            
            <li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=67">Операційні системи</a></li>
            <li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=67">Антивіруси</a></li>
            <li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=67">Офісні програми</a></li>
          </ul>-->

        </li>
      </ul>
    </li>
    <li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=51">ПРАЙС</a></li>
    <li class="last"><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=52" style="background-image:none; padding-left:38px; padding-right:38px" >КОНТАКТИ</a></li>
  </ul>
</div>

<?
if(empty($_REQUEST['pid']))
{
?>

<div id="leftcol">
	<div id="block_1">
		<a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=47" ><span class="text">навчальні курси<br />будь-яких напрямків</span></a>

        </div>
        <div id="block_2">
        <a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=48" ><span class="text">розробка сайтів,логотипів<br />фірмових стилів</span></a>
        </div>
    
        <div id="block_3">
        <a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=49" ><span class="text">ремонт, встановлення<br />програм, операційної системи</span></a>
	</div>
</div><!--/leftcol-->

<div id="change_fl">
<EMBED src="templates/bkt/flash
/change.swf" 
 quality=high bgcolor=#FFFFFF  
 WIDTH="601" HEIGHT="288" 
 NAME="mtown" ALIGN="" TYPE="application/x-shockwave-flash" 
 PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer" wmode:"opaque" wmode="opaque"><param name="wmode" value="opaque"/>
 </EMBED>
 </div>

<div id="bottom_menu"></div>
<div id="button_k"><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=47"><span>навчальні курси</span></a></div>
<p id="f1">Вдоскональте свої знання разом з нами!<span style="font-size:11px; font-family:Tahoma, Geneva, sans-serif; margin-left:25px">&nbsp;&nbsp;&gt;&gt;&gt;</span></p>

<?
} else {
?>

<div id="leftcol">
	<img src="/templates/bkt/img/picture_vn.png" id="my_big_pic"/>
</div><!--/leftcol-->

<?
}
?>


<div id="leftcolumn">

<jdoc:include type="modules" name="leftmenu" />

	<!--<div id="sec_menu">НАПРЯМКИ НАВЧАННЯ</div>



	<div id="my_menu" class="sdmenu">
      <div class="collapsed">
        <span id="one"><h1 class="one1">Користувач ПК</h1></span>
        <a href="http://tools.dynamicdrive.com/imageoptimizer/">Базовий</a>
        
      </div>
      <div class="collapsed">
        <span id="two"><h1 class="two2">Комп'ютерна графіка</h1></span>
        <a href="http://www.dynamicdrive.com/recommendit/">Курси Photoshop</a>
        <a href="http://www.dynamicdrive.com/link.htm">Курси Illustrator</a>
        <a href="http://www.dynamicdrive.com/resources/">Курси InDesign</a>
        <a href="http://www.dynamicdrive.com/link.htm">Курси QuarkXpress</a>
        
      </div>
      <div class="collapsed">
        <span id="three"><h1 class="three3">Комп'ютерна анімація</h1></span>
        <a href="http://www.javascriptkit.com">Курси Flash</a>
        <a href="http://www.cssdrive.com">Курси ActionScript</a>
        <a href="http://www.codingforums.com">Курси 3DMax</a>
        <a href="http://www.dynamicdrive.com/style/">Курси Maya</a>
      </div>
      <div class="collapsed" >
        <span id="four"><h1 class="four4">Програмування</h1></span>
        <a href="#">Програмування на C#</a>
        <a href="#">Програмування на C</a>
        <a href="#">Програмування на C++</a>
        <a href="#">Бази даних MySql</a>
        <a href="#">Веб-програмування</a>
        <a href="index.html">Програмування на JavaScript</a>
        <a href="#">Програмування на PHP</a>
      </div>
      
      <div class="collapsed" >
        <span id="five"><h1 class="five5">Іноземні мови</h1></span>
        <a href="#">Англійська</a>
        <a href="#">Французька</a>
        <a href="index.html">Польська</a>
       
      </div>
    </div>-->
<br/>
<div style="font-family:Arial; color: #666; font-weight: bold; font-size: 8pt;margin-left:50px">&nbsp;&nbsp;Osvita.com.ua  – <br/><a href="http://www.osvita.com.ua/courses/" target="_blank" style="color:orange">курсы в Украине</a></div>


   </div><!--/leftcolumn-->
   
   <jdoc:include type="modules" name="content" />
  
   <!--<div id="content_heading">ПРО БЮРО КОМП'ЮТЕРНИХ ТЕХНОЛОГІЙ</div>
   
  
    
    
    <div id="content">
    
    	<h1>БКТ - весь спектр послуг в сфері IT - технологій!</h1>
		<p>У Вас виникли проблеми з комп'ютером або ноутбуком? Вам терміново необхідний <a href="#">ремонт</a> або <a href="#">встановлення програм</a>, операційної системи? Ми допоможемо Вам у цьому! Наша компанія здійснює ремонт комп'ютерів у Львові! Наші фахівці швидко і якісно проведуть встановлення, налаштування домашнього, або офісного комп'ютера, ноутбука. У нас працюють тільки професіонали, для яких ремонт комп'ютерів - це не тільки робота, але і улюблене заняття. Ми також можемо Вам запропонувати регулярне <a href="#">обслуговування</a> вашого комп'ютера, <a href="#">оновлення програм</a> і антивірусів. Що допоможе уникнути проблем з роботою за ПК.</p>
		<p>Зараз важко уявити будь-яку професію без автоматизації, тобто без використання персонального комп'ютера. Це може бути приміщення офісу, виробничий цех, склад або просто робота в домашніх умовах. В плині сучасних технологій дуже важливо за ними встигати, особливо коли Ваша професія пов'язана з ПК. Наша компанія надасть вам <a href="#">професійне навчання</a> в багатьох напрямках, і програмах.</p>
		<p>Також в продажі <a href="#">комп'ютери та комплектуючі</a>, за хорошими цінами. Наш асортимент складається більш ніж з 10 тис. позицій. Завантажити прайс та порівняти ціни можна <a href="#">тут</a>! Чекаємо Ваших дзвінків! </p>
    
    </div>-->
	
	<!--/content-->

<div id="footer">

<div id="first">

<a href="http://bkt"><img src="/templates/bkt/img/logo2.png" /></a>
<p><b>Моб. (050) 503-41-55</b><br />
Львів, вул. Т. Костюшка 18<br /><br />

Copyright 2010 www.bkt.lviv.ua</p>

</div>

<div id="second">
<h6>РОЗДІЛИ САЙТУ</h6>
<ul>
<li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=47">Навчальні курси</a></li>       
<li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=48">Дизайн</a></li>
<li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=49">Обслуговування пк</a></li>
<li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=51">Прайс</a></li>
<li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=52">Контакти</a></li>

</ul>
</div>

<div id="third">
<h6>НАВЧАННЯ</h6>
<ul>
<li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=61">Базовий курс</a></li>           
<li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=64">Програмування</a></li>
<li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=62">Комп'ютерна графіка</a></li>
<li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=63">Комп'ютерна анімація</a></li>
<li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=94">Адміністрування</a></li>
<li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=65">Іноземні мови</a></li>

</ul>
</div>

<div id="fourth">
<h6>ДИЗАЙН</h6>
<ul>
<li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=66">Дизайн сайтів</a></li>          
<li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=67">Фірмовий стиль</a></li>



</ul>
</div>

<div id="fifth">
<h6>ОБСЛУГОВУВАННЯ</h6>
<ul>
<li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=69">Базові послуги</a></li>       
<li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=70">Сервіси</a></li>   
<li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=72">Мережеві послуги</a></li>   
<li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=71">Встановлення ПЗ</a></li>
<li><a href="http://bkt.lviv.ua/index.php?option=com_content&view=category&id=1&pid=73">Продаж ПК</a></li>

</ul>
</div>

</div><!--/footer-->



</div><!--/main-->
</body>
</html>