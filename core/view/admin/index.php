<?php View::layout('admin-head',['title'=>'Главная']); ?>
<?php View::layout('admin-header'); ?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-1">
				<?php View::position('left') ?>
			</div>		
			<div class="col-11">
				<?php View::position('right') ?>
			</div>
		</div>
	</div>
<?php View::layout('footer'); ?>