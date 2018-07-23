<?php 
abstract class Router
{
	public static function start(){
		$path = $_SERVER['REQUEST_URI'];
		if(strpos($path,'?')!==-1){
			$path = explode('?',$path)[0];
		}
		$aliace = ucfirst(end(explode('/', $path)));
		$aliace = $aliace != '' ? $aliace : 'Index';
		$controller_path = CONTROLLERS_PATH.$aliace.'Controller.php';
		if(file_exists($controller_path)){
			require $controller_path;	
		}else{
			echo '404';
		}
		
	}
	public static function location($url){
		header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.$url);
	}
}