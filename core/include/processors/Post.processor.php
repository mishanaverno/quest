<?php 
abstract class POST 
{
	public static function isAction()
	{
			if(isset($_POST['action']) && !empty($_POST['action'])){
				return true;
			}else{
				return false;
			}
	}
	public static function getAction()
	{
		if(self::isAction()){
			return $_POST['action'];
		}else{
			return false;
		}
	}
	public static function get()
	{
		$data = $_POST;
		unset($data['action']);
		return (object) $data;
	}
}