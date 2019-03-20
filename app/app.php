<?php
namespace app;
use app\core\classes\Router;

require APP_PATH.'core'.DS.'helpers'.DS.'PHP.helper.php';

spl_autoload_register(function($class){
	$class = str_replace('\\', DS, $class);
	$path = $class.'.php';
	
	if (file_exists($path)) {
		require $path;
	}
});

session_start();
Router::getInstance()->start();
/*DB::init();
Router::start();*/
