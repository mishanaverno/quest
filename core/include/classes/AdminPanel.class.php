<?php 
abstract class AdminPanel
{
	public static function init()
	{	
		$action = GETP::get('action');
		switch (GETP::get('page')) {
			case 'users':
				$users = DataProvider::get('user');
				View::part('usersTable',['users' => $users]);
				break;
			default:
				View::part('dashboard');
				break;
		}
	}
}