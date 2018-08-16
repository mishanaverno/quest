<?php 
abstract class GETP 
{
	public static function isAction()
	{
			if(isset($_GET['action']) && !empty($_GET['action'])){
				return true;
			}else{
				return false;
			}
	}
	public static function getAction()
	{
		if(self::isAction()){
			return $_GET['action'];
		}else{
			return false;
		}
	}
	public static function get($parametr = null)
	{	
		if(!$parametr){
			if(empty($_GET))
				$data = false;
			else 
				$data = (object) $_GET;
		}else{
			if(isset($_GET[$parametr]))
				$data = $_GET[$parametr];
			else
				$data = false;
		}
		return $data;
	}
	public static function add($parametrs = [], $return = null)
	{
		$result = self::get();
		foreach ($parametrs as $k => $v) {
			$result->$k = $v;
		}
		switch ($return) {
			case 'string':
				$result = http_build_query($result);
				break;
		}
		return $result;
	}
}