<?php

$config = array
(
	'pagination' => array('uri_segment'    => 'page',
						  'total_items' => Database::instance()->count_records('news'),
			           	  'items_per_page' => 4,
			          	  'auto_hide' => FALSE,
			          	  'style'=>'easyrent'),
						
	'items_in_last_news' => 1,	
	'date_format' => 'j F Y',

	'logo_folder' => 'upload/news/',
	'logo_path'=>"http://".Kohana::config('config.site_domain')."/upload/news/"
);
?>