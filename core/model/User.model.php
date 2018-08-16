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
			'type' => 'number',
			'visibility' => false 
		],
		'name' => [
			'label' => 'Имя',
			'dbfield' => 'name',
			'type' => 'text',
			'visibility' => true
		],
		'login' => [
			'label' => 'Логин',
			'dbfield' => 'login',
			'type' => 'text',
			'visibility' => true
		],
		/*'pass' => [
			'dbfield' => 'pass',
			'type' => 'text',
		],*/
	]
];