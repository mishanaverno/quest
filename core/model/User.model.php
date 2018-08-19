<?php
$model = (object)[
	'name' => 'users',
	'title' => 'Users',
	'tablename' => 'users',
	'template' => 'editableTable',
	'fields' => [
		'id' => [
			'label' => 'ID',
			'dbfield' => 'id',
			'dbreadonly' => true,
			'type' => 'number',
			'visibility' => false,
		],
		'name' => [
			'label' => 'Имя',
			'dbfield' => 'name',
			'type' => 'text',
			'placeholder' => 'Ваше Имя',
			'visibility' => true
		],
		'login' => [
			'label' => 'Логин',
			'dbfield' => 'login',
			'type' => 'text',
			'placeholder' => 'Ваш логин',
			'help' => 'Логин для входа на сайт',
			'visibility' => true
		],
		/*'pass' => [
			'dbfield' => 'pass',
			'type' => 'text',
		],*/
	]
];