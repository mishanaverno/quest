<?php 
namespace app\core\classes;

abstract class Singleton {
	
	public static function getInstance(){
		if(!static::$instance){
			static::$instance = new static();
		}
		return static::$instance;
	}
}
