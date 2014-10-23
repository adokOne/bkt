<?php
/**
 * Config for Multi_Lang Module
 *
 * @package    Multi_Lang Module 
 * @author     Kiall Mac Innes
 * @copyright  (c) 2007-2009 Multi_Lang Module Team..
 * @license    http://dev.kohanaphp.com/wiki/multilang/License
 */
$config['enabled'] = TRUE; // Enable or disable...

// The supported languages located in the i18n folder of your application
$config['allowed_languages'] = array
(	'ua' => array('name' => 'Укр', 'locale' => 'uk_UA'),
 	'ru' => array('name' => 'Рус', 'locale' => 'ru_RU'),
);

$config['default'] = 'ua';
                                         
?>