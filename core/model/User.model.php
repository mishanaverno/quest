<?php
$model = (object)[
	'name' => 'users',
	'tablename' => 'users',
	'fields' => [
		'name' => [
			'dbfield' => 'name',
			'type' => 'text'
		],
		'login' => [
			'dbfield' => 'login',
			'type' => 'text',
		],
		'pass' => [
			'dbfield' => 'pass',
			'type' => 'text',
		],
	]
];