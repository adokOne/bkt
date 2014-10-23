<?php include Kohana::find_file("views","main_header")?>
<?php
global $str;
global $left_menu;
global $c;
$c = 0;
$str = "";
$left_menu = "";
function render($data,$pos=""){
	global $str;
	global $c;
	$c++;
	$str .= "<ul style='".$pos."' class='base' >";
 	foreach($data as $k =>$row):
 		$cls =  isset($row["children"]) ? "has_sub" : "";
 		$str .= "<li class=".$cls.">";
 		$cls =  isset($row["children"]) ? "menu_bar" : "";
 		$link = isset($row["link"]) ? $row["link"]  : $row["seo_name"];
 		$link = Router::$current_language == Kohana::config('multi_lang.default') ? $link : Router::$current_language."/".$link;
 		if($row["id"]!=54354)
 			$str .= "<a class='".$cls."' href='/".$link."'>";
 		else
 			$str .= "<a class='".$cls."' href='/".$link."'>";
		$c--;
 		$str .= $row["name"];
 		if(isset($row["children"])){
 			$str .=  $c < 1 ? '<img src="/images/bkt/img/down.gif" class="downarrowclass" style="border:0;">'  : '<img src="/images/bkt/img/right.gif" class="rightarrowclass" style="border:0;">';
 		}
 		
 		
 		$c++;
 		$str .= "</a>";
		if(isset($row["children"])){
			$offset = $c > 1 ? "left: 200px;" : "";
			render($row["children"],$offset);
		}
 		$str .= "</li>";
 	endforeach;
 	$str .= "</ul>";
	
}


function render_2($data,$pos=""){
	global $left_menu;
	$c = 1;
	
	foreach($data["children"] as $row):
		$left_menu .= '<div class="collapsed" style="">';
		$left_menu .='<span>';
		$left_menu .='<h1 href="'.$row["link"].'" class="one1">';
		$left_menu .= '<span class="menu_number">'.$c.'</span>';
		$left_menu .= $row["name"];
		$left_menu .='</h1>';
		$left_menu .='</span>';
		if(isset($row["children"])){
			foreach ($row["children"] as $ch){
				$link = Router::$current_language == Kohana::config('multi_lang.default') ? $ch["link"] : Router::$current_language."/".$ch["link"];
				$left_menu .= '<a href="/'.$link.'">'.$ch["name"].'</a>';
			}
		}
		$left_menu .= '</div>';
		$c++;
	endforeach;

	
}

render($menu);

$lang = Kohana::lang("all");

?>

<div  id="" class="jqueryslidemenu" style="width:869px; background-image:url(/images/bkt/img/menu.png); height:45px; margin-top:15px; padding:2px 3px 3px 3px ; background-repeat:no-repeat">
  
	<?php echo $str;?>
  
</div>
<?php if($view_slide):?>

<div id="leftcol">
	<div id="block_1">
		<a href="<?php echo Router::$current_language == "ua" ? "" : "/ru" ?>/courses">
			<span class="text"><?php echo $lang["menu_1"]?></span>
		</a>

     </div>
     <div id="block_2">
        <a href="/online_registration">
        	<span class="text"><?php echo $lang["menu_2"]?></span>
        </a>
     </div>
    
     <div id="block_3">
        <a href="/feedbacks">
        	<span class="text"><?php echo $lang["menu_3"]?></span>
        </a>
	</div>
</div><!--/leftcol-->

<div id="change_fl" style="top: 247px;">
	<embed src="/images/bkt/flash/change.swf" quality="high" bgcolor="#FFFFFF" width="601" height="288" name="mtown" align="" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" wmode:"opaque"="" wmode="opaque"><param name="wmode" value="opaque">
</div>

<div id="bottom_menu"></div>
<div id="button_k">
	<a href="http://bkt.lviv.ua/courses">
		<span><?php echo $lang["menu_1"]?></span>
	</a>
</div>
<p id="f1"><?php echo $lang["vdosk_znannya"]?><span style="font-size:11px; font-family:Tahoma, Geneva, sans-serif; margin-left:25px">&nbsp;&nbsp;&gt;&gt;&gt;</span></p>

<?php else:?>
<div id="leftcol" style="height: 100px;">
	<img src="/images/bkt/img/picture_vn.png" id="my_big_pic">
</div>
<?php endif;?>


<div id="leftcolumn">

﻿
	<div id="sec_menu"><?php echo $lang["menu_header"]?></div>
	<div data-auto-controller="FrontMenuController" id="my_menu" class="sdmenu">
	<?php foreach ($menu as $k=>$row) {if($row["id"] == 54354) { render_2($row); echo $left_menu;}}?>
	
	</div>
<div id="sec_menu"  >Наші партнери</div>
<div style="width: 230px;text-align: center;" >
<img src="/images/Logo111.jpg" />
<img src="/images/mlogo.jpg" />
<img src="/img/unkur.png" width="200" />
</div>

<?php echo $blog;?>


</div><!--/leftcolumn-->﻿
		<div id="content_heading"><?php echo Router::$page_title?></div>
		<div id="content" class="<?php echo $cls?>">
			<?php echo Router::$page_content?>

			<div class="comment_line" style="float: left;margin-top: 30px;">
			<?php echo $commments?>
			</div>

			<?php if(isset($_GET["pid"]) && $_GET["pid"] == 52 ):?>

<iframe width="600" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com.ua/maps?near=%D1%83%D0%BB.+%D0%A2%D0%B0%D0%B4%D0%B5%D1%83%D1%88%D0%B0+%D0%9A%D0%BE%D1%81%D1%82%D1%8E%D1%88%D0%BA%D0%BE,+18,+%D0%9B%D1%8C%D0%B2%D0%BE%D0%B2,+%D0%9B%D1%8C%D0%B2%D0%BE%D0%B2%D1%81%D0%BA%D0%B0%D1%8F+%D0%BE%D0%B1%D0%BB%D0%B0%D1%81%D1%82%D1%8C&amp;geocode=CfyAMw8kmOiUFX6D-AIdBZJuASlF2P-Dcd06RzHsNu6C6NWwWg&amp;q=%D0%B1%D0%BA%D1%82&amp;f=l&amp;hl=ru&amp;sll=49.841428,24.023559&amp;sspn=0.009853,0.026479&amp;t=h&amp;ie=UTF8&amp;hq=%D0%B1%D0%BA%D1%82&amp;hnear=&amp;ll=49.841022,24.023557&amp;spn=0.009853,0.026479&amp;z=14&amp;iwloc=A&amp;cid=10326277041113641997&amp;output=embed"></iframe>	<?php endif?>
		</div>





<?php include Kohana::find_file("views","main_footer")?>