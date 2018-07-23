<?php View::layout('head',['title'=>'Главная']); ?>
<?php View::layout('header'); ?>
	<p>hello world asdsdsd <?=USER::$data->name?></p>
<?php View::layout('footer'); ?>