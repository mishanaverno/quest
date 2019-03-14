<?php 
namespace app\controllers;
use app\core\classes\Singleton;

class Controller extends Singleton
{
	protected static $instance = '';
	function __construct(){

	}

	function actionIndex(){
		echo '404';
	}
}