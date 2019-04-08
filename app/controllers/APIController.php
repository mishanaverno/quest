<?php 
namespace app\controllers;
use app\controllers\Controller;
use app\core\classes\View;
use app\core\classes\DB;
use app\core\classes\DataProvider;
use app\core\classes\Router;
use app\core\classes\ORM\library\UserTableRow;
use app\core\classes\ORM\library\BookTableRow;
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
		$user->new($res);
		vd($user);
		$user->save();
		if($user->InDB){
			$user = $user->toArray();
			return Response::create()
			->succes()
			->data($user)
			->printJSON();
		}else{
			Response::create()
			->error(7)
			->msg('User not created')
			->printJSON();
		}
	}
	public function actionUserEdit(){
		$res = GETP::getInstance()->get(['name','login','pass','is_admin','email']);
		$id = GETP::getInstance()->get('id');
		$data = new DataProvider();
		$user = $data->connect()
			->getOne($id, get_class(new UserTableRow));
			$data->disconnect();
		
		if(!$user) return Response::create()
			->error(6)
			->msg('User not found')
			->printJSON();

		foreach ($res as $key => $value) {
			$user->changeFieldValue($key, $value);
		}
		$user->save();
		$user = $user->toArray();
		return Response::create()
			->succes()
			->data($user)
			->printJSON();
	}
	public function actionUserDelete(){
		$id = GETP::getInstance()->get('id');
		$data = new DataProvider();
		$user = $data->connect()
			->getOne($id, get_class(new UserTableRow));
			$data->disconnect();
		if(!$user) return Response::create()
			->error(6)
			->msg('User not found')
			->printJSON();
		$user->delete();
		return Response::create()
			->succes()
			->data(['id' => $id])
			->printJSON();
	}
	public function actionAuth(){
		$login = GETP::getInstance()->get('login');
		$pass = GETP::getInstance()->get('pass');

		if(!$login || !$pass) 
			return Response::create()
				->error(9)
				->msg('not login or pass')
				->printJSON();
		$data = new DataProvider();
		$user = $data->connect()
			->getOne($login, get_class(new UserTableRow), 'login');
			$data->disconnect();
		if($user){
			$user = $user->toArray();
			if($user['pass'] == $pass){
				$_SESSION['auth'] = $user['token'];
				
			
			return Response::create()
			->succes()
			->data($user)
			->printJSON();
		}
			else
			return Response::create()
				->error(10)
				->msg('pass invalid')
				->printJSON();
		}
		return Response::create()
			->error(6)
			->msg('User not found')
			->printJSON();
		
	}
	public function actionBooks(){
		$data = new DataProvider();
		$books = $data->connect()
			->getCollection(get_class(new BookTableRow),'in_library=1');
		$data->disconnect();
		if(empty($books)){
			return Response::create()
			->error(10)
			->msg('Books not found')
			->printJSON();
		}
		$arrBooks = [];
		foreach ($books as $key => $value) {
			$arrBooks[] = $value->toArray();
		}
		return Response::create()
			->succes()
			->data($arrBooks)
			->printJSON();
	}
	public function actionBook(){
		$id = GETP::getInstance()->get('id');
		$data = new DataProvider();
		$book = $data->connect()
			->getOne($id,get_class(new BookTableRow));
		$data->disconnect();
		if(!$book){
			return Response::create()
			->error(11)
			->msg('Book not found')
			->printJSON();
		}
		return Response::create()
			->succes()
			->data($book->toArray())
			->printJSON();
	}
	public function actionBookRandom(){
		$data = new DataProvider();
		$books = $data->connect()
			->getCollection(get_class(new BookTableRow),'',1, 'rand()');
		$data->disconnect();
		if(empty($books)){
			return Response::create()
			->error(10)
			->msg('Books not found')
			->printJSON();
		}
		$arrBooks = [];
		foreach ($books as $key => $value) {
			$arrBooks[] = $value->toArray();
		}
		return Response::create()
			->succes()
			->data($arrBooks)
			->printJSON();
	}


	
	public function actionTest(){
		$data = new DataProvider();
		$user = $data->connect()
			->getOne(29, get_class(new UserTableRow));
		$data->disconnect();
		$user->changeFieldValue('pass','111')->save();
		
		
		vd($user);
	}
	
	
}