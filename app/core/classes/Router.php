<?php 
namespace app\core\classes;
use app\core\classes\Singleton;

class Router extends Singleton
{
	private $routes;
	protected static $instance = '';
	protected function __construct() {	
		$this->routes = require_once CONFIG_PATH.'routes.config.php';
		$this->request_uri = request();	
	}
	
	public function start(){
		$controllerName = $this->getController();
		$controllerPath = '\app\controllers\\'.$controllerName;
		if(class_exists($controllerPath)){
			$controller = $controllerPath::getInstance();
		}else{
			$this->NotFound404();
		}
		$methodName = 'action'.ucfirst($this->getAction());
		if(method_exists($controller, $methodName)){
			$controller->$methodName();
			exit;
		}else{
			$this->NotFound404();
		}	
	}
	public function NotFound404(){
		$controller = \app\controllers\Controller::getInstance()->actionIndex();
		exit;
	}
	private function getController(){
		return $this->routes[$this->request_uri]['controller'];
	}
	private function getAction()
	{
		return $this->routes[$this->request_uri]['action'];
	}
	public function routeTo($to){
		header("Location: $to");
		exit;
	}
}