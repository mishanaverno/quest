<?php 
$form = new Constructor($headers, $rows[0], 'Изменить');
$form->addField('action', 'update', [
	'type' => 'hidden',
	'visibility' => 'true',
]);
$form->addField('page', 'users',[
	'type' => 'hidden',
	'visibility' => 'true',
]);
$form->addField('id', $rows[0]['id'], [
	'type' => 'hidden',
	'visibility' => 'true',
]);
$form->constructForm();
?>