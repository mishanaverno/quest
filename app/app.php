<?php
namespace app;
use app\core\classes\Router;

spl_autoload_register(function($class){
	$path = $class.'.php';
	
	if (file_exists($path)) {
		require $path;
	}
});

session_start();
Router::getInstance()->start();
/*DB::init();
Router::start();*/
