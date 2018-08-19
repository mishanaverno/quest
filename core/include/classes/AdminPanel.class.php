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
						$data = DataProvider::get('user', 'id='.GETP::get('id'));
						$data->model->template = 'editRow';
						return $data;
					break;
					case 'update':
						$response = DataProvider::update('user', 'id='.GETP::get('id'));
						PHP::vd($response);
						//Router::location('admin?page=users&response='.$response);
					break;
					case 'delete':

					break;
				}
			}else{
				return DataProvider::get('user');
			}
			break;
			default:
				
			break;
		}
	}
}