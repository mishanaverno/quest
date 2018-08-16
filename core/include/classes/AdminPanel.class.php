<?php 
abstract class AdminPanel
{
	public static function listenGET()
	{	
		$action = GETP::get('action');
		switch (GETP::get('page')) {
			case 'users':
			if($action){
				switch ($action){
					case 'edit':

					break;
				}
			}else{
				return (object) DataProvider::get('user');
			}
			break;
			default:
				
			break;
		}
	}
}