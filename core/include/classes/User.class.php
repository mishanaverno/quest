<?php
abstract class User 
{
	public static $authorized = false;
	public static $data;
	public static function login($login,$pass){
		$users = DB::makeQuery("SELECT * FROM admins WHERE login='".$login."'");
		if($users){
			foreach ($users as $k => $v) {
				$v = (object) $v;
			  	if($v->pass == $pass){
			  		unset($v->pass);
			  		$_SESSION['user'] = $v;
			  		$_SESSION['authorized'] = true;
			  		Router::location(); 
			  	}else{
			  		Router::location('auth');
			  	}
			}
		}else{
			Router::location('auth');
		}
	}
	public static function logout($login){

	}
	public static function isAuthorized(){
		if($_SESSION['user'] && $_SESSION['authorized']){
			USER::$data = $_SESSION['user'];
		}else{
			Router::location('auth');
		}
	}
} 