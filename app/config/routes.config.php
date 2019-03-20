<?php 
return [
	'/'=>[
		'controller' => 'IndexController',
		'action' => 'index'
	],
	'/api/users'=>[
		'controller' => 'APIController',
		'action' => 'users'
	],
	'/api/user'=>[ //id
		'controller' => 'APIController',
		'action' => 'user'
	],
	'/api/user/new'=>[ //id+fields
		'controller' => 'APIController',
		'action' => 'userNew'
	],
	'/api/user/edit'=>[ //id+fields
		'controller' => 'APIController',
		'action' => 'userEdit'
	], 
	'/api/user/delete'=>[ //id
		'controller' => 'APIController',
		'action' => 'userDelete'
	],
	'/api/test'=>[ 
		'controller' => 'APIController',
		'action' => 'test'
	],

	
	
];