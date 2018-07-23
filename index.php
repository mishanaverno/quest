<?php 
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING & ~E_STRICT);
//инициализация
define('ROOT_PATH', __DIR__);
define('DS',DIRECTORY_SEPARATOR); 
define('CORE_PATH',ROOT_PATH.DS.'core'.DS);
require CORE_PATH.'core.php';;
