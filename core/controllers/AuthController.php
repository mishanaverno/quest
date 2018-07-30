<?php 
switch (POST::getAction()){
	case 'auth-login' :
	$data = POST::get();
	USER::login($data->auth_login, $data->auth_pass);
	break;
	case 'auth-logout' :
	USER::logout();
	default: 
	View::display('auth',['name'=>'Авторизация']);
	break;
}