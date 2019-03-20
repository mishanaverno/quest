<?php 
namespace app\controllers;
use app\controllers\Controller;
use app\core\classes\View;
use app\core\classes\DB;
use app\core\classes\DataProvider;
use app\core\classes\Router;
use app\core\classes\ORM\library\UserTableRow;
use app\core\classes\API\Response;
use app\core\processors\GETP;


class APIController extends Controller
{
	protected static $instance = '';
	
	function __construct(){
		parent::__construct();
	}

	public function actionUsers(){
		$data = new DataProvider();
		$users = $data->connect()
				->getCollection(get_class(new UserTableRow));
		$data->disconnect();

		if(count($users)<1) 
			return Response::create()
				->error(5)
				->msg('empty collection')
				->printJSON();

		$arrUsesr = [];
		foreach ($users as $key => $user) {
			$arrUsesr[] = $user->toArray();
		}

		return Response::create()
			->succes()
			->data($arrUsesr)
			->printJSON();	
	}
	public function actionUser(){
		$id = GETP::getInstance()->get('id');
		if(!$id) 
			return Response::create()
				->error(7)
				->msg('Id not assigned')
				->printJSON();
		$data = new DataProvider();
		$user = $data->connect()
			->getOne($id, get_class(new UserTableRow));
			$data->disconnect();
		if($user){
			$user = $user->toArray();
			return Response::create()
			->succes()
			->data($user)
			->printJSON();
		}
		return Response::create()
			->error(6)
			->msg('User not found')
			->printJSON();
		
	}
	public function actionUserNew(){
		$res = GETP::getInstance()->get(['name','login','pass','is_admin','email']);
		$user = new UserTableRow();
		$user->load($res)->save();
		vd($user);
	}
	public function actionTest(){
		$arr = [
			'name'=>'ya',
			'login'=>'yssa',
			'pass'=>'33'
		];
		$res = DB::getInstance()
			->connect()
			->insert('users',$arr);
			vd($res);
	}
	
	
}