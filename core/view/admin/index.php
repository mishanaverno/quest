<?php View::layout('admin-head',['title'=>'Главная']); ?>
<?php View::layout('admin-header'); ?>
	<div class="container-fluid">
		<div class="row">
			<div class="col">
				<h1>Admin panel</h1>
				<?php AdminPanel::init(); ?>
			</div>		
		</div>
	</div>
<?php View::layout('footer'); ?>