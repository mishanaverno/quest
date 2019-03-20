<?php
namespace app\controllers;
use app\controllers\Controller;
use app\core\classes\View;

class IndexController extends Controller
{
	protected static $instance = '';
	function __construct(){
		parent::__construct();
	}
	public function actionIndex(){
		View::getInstance()
			->assignVar('title', 'Сервер библиотеки РБ')
			->setTemplate('main')
			->prepareTemplate()
			->display();
	}
}