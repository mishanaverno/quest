<?php 
namespace app\core\classes;
use app\core\classes\Singleton;

class Router extends Singleton
{
	private $routes;
	protected static $instance = '';
	protected function __construct() {	
		$this->routes = require CONFIG_PATH.'routes.config.php';
		
	}
	
	public function start(){
		$controllerName = $this->getController();
		$controllerPath = '\app\controllers\\'.$controllerName;
		if(class_exists($controllerPath)){
			$controller = $controllerPath::getInstance();
		}else{
			$controller = \app\controllers\Controller::getInstance();
		}
		$controller->actionIndex();
		
	}
	private function getController(){
		$path = $_SERVER['REQUEST_URI'];
		return $this->routes[$path]['controller'];
	}
	
	public function test(){
		echo 'y';
	}
}