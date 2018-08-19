<?php 
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING & ~E_STRICT);
//инициализация
define('DS', DIRECTORY_SEPARATOR); 
define('ROOT_PATH', __DIR__.DS);
define('CORE_PATH', ROOT_PATH.'core'.DS);
require CORE_PATH.'core.php';;
