<?php 
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING & ~E_STRICT);
ini_set('error_reporting', E_ALL);
//инициализация
define('DS', DIRECTORY_SEPARATOR); 
define('ROOT_PATH', __DIR__.DS);
define('APP_PATH', ROOT_PATH.'app'.DS);
define('CONFIG_PATH', APP_PATH.'config'.DS);
define('VIEW_PATH',APP_PATH.'view'.DS);
require APP_PATH.'app.php';
