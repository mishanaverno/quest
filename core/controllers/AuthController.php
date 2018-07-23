<?php 
if (POST::getAction() == 'auth-login'){
	$data = POST::get();
	USER::login($data->auth_login, $data->auth_pass);
}else{
	View::display('auth',['name'=>'Авторизация']);
}