<body>
	<nav class="navbar navbar-dark bg-dark border-bottom">
		<a href="/" class="btn btn-dark my-2 my-sm-0">На сайт</a>
		<a class="navbar-brand my-2 my-sm-0 ml-auto" href="/admin?page=user&action=edit&id=<?=USER::$data->id?>">
			<?=USER::$data->name?>
			<i class="fas fa-user-circle"></i>
		</a>
		<form class="form-inline" action="/auth" method="post">
			<button class="btn btn-dark my-2 my-sm-0" name="action" value="auth-logout" type="submit">Выход</button>
		</form>
	</nav>