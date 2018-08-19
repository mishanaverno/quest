<?php View::layout('admin-head',['title'=>'Авторизация']); ?>
<?php View::layout('header'); ?>
<div class="container ">
	<div class="row">
		<div class="col  d-flex justify-content-center">
			<h1><?=$name?></h1>
		</div>
		
	</div>
	<div class="row">
		<div class="col  d-flex justify-content-center align-items-center">
			<div class="form border-top border-bottom pt-3 pb-3 mt-a mb-a">
				<form method="post">
					<fieldset>
						<div class="form-group ">
							<label for="ALogin">Login</label>
							<input type="text" name="auth_login" class="form-control form-control-lg" id="ALogin" aria-describedby="loginHelp" placeholder="Enter login">
							<small id="loginHelp" class="form-text text-muted">Поле ввода для логина если ты забыл</small>
						</div>
						<div class="form-group">
							<label for="APassword">Password</label>
							<input type="password" name="auth_pass" class="form-control form-control-lg" id="APassword" placeholder="Password">
						</div>
						<button type="submit" class="btn btn-primary" name="action" value="auth-login">Вход</button>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
</div>
<?php View::layout('footer'); ?>