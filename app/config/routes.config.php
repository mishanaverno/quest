<?php 
return [
	'/'=>[
		'controller' => 'IndexController',
		'action' => 'index'
	],
	'/api/auth'=>[
		'controller' => 'APIController',
		'action' => 'auth'
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
	'/api/books'=>[ 
		'controller' => 'APIController',
		'action' => 'books'
	],
	'/api/book'=>[ 
		'controller' => 'APIController',
		'action' => 'book'
	],
	'/api/book/random'=>[ 
		'controller' => 'APIController',
		'action' => 'bookRandom'
	],
	'/api/test'=>[ 
		'controller' => 'APIController',
		'action' => 'test'
	],

	
	
];