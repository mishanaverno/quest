<?php
abstract class User 
{
	public static $authorized = false;
	public static $data;
	public static function login($login,$pass){

	}
	public static function logout($login){

	}
	public static function isAuthorized(){
		if($_SESSION['user'] && $_SESSION['user']['authorized']){
			echo 'yes';
		}else{
			Router::location('auth');
		}
	}
} 