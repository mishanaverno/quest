<?php 
namespace app\controllers;
use app\controllers\Controller;
use app\core\classes\View;

class AuthController extends Controller
{
	protected static $instance = '';
	function __construct(){
		parent::__construct();
	}
	function actionIndex(){
		View::getInstance()
			->setTemplate('auth')
			->prepareTemplate()
			->display();
	}
}
/*switch (POST::getAction()){
	case 'auth-login' :
	$data = POST::get();
	USER::login($data->auth_login, $data->auth_pass);
	break;
	case 'auth-logout' :
	USER::logout();
	default: 
	
	break;
}*/