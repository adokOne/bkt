<?php


$config['_default'] = "main";

$config["courses"] = "main/courses";
$config["price"] = "main/price";

$config["courses/(.*)"] = "main/courses/$1";
$config["courses/(.*)/(.*)"] = "main/courses/$1/$2";
$config["courses/(.*)/(.*)/(.*)"] = "main/courses/$1/$2/$3";
$config["courses/(.*)/(.*)/(.*)/(.*)"] = "main/courses/$1/$2/$3/$4";

$config["aktsiyi_ta_znyzhky"] = "news/sale";
$config["aktsiyi_ta_znyzhky/(.*).html"] = "news/sale/$1";

$config["aktsiyi_ta_znyzhky/pruvedu-dryga.html"] = "news/sale/pruvedu-dryga";


$config["online_registration"] = "main/online_registration";
$config["get_online_reg_form/(\d+)/(\d+)/(\d+)"] = "main/get_online_reg_form/$1/$2/$3";
$config["do_online_reg"] = "main/do_online_reg";



$config["callback"] = "main/callback";
$config['main/get_call_back_form'] = "main/get_call_back_form";
$config['captcha/kcaptcha'] = "captcha/kcaptcha";
$config["feedbacks"] = "main/feedbacks";
$config["send_feedback"] = "main/send_feedback";
$config["online"] = "user/onine_reg";
$config["blog"] = "news";
$config["blog/(.*).html"] = "news/index/$1";
$config["comment"] = "news/comment";
$config["admin"] = "admin";
$config["admin/(\w+)"] = "admin/$1/";
$config["admin/(\w+)/(\w+)"] = "admin/$1/$2/";
$config["admin/(\w+)/(\w+)/(\w+)"] = "admin/$1/$2/$3";
$config["(.*)"] = "main/other/$1";

$config["thanks"] = "main/thanks";







