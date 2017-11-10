<!DOCTYPE html>

<html>
  <head>
	<title>Финансист онлайн</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<link href="../css/bootstrap.min.css" rel="stylesheet"/> 
	<link href="../css/style.css" rel="stylesheet"/> 
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
	
  <body>
  	<div class="container">
	    <header class="header">
			<h1 class="text-center">АВТОРИЗАЦИЯ</h1>
			
		</header>
		<div id="formlogin" class="jumbotron">
	    <div class="form">
		<div class="row header">
			<h1>Вход в систему</h1>
		</div>
		<?php if (has_errors($errors)): ?>
		<div class="error-msg">
		При заполнении формы возникли ошибки, пожалуйста проверьте правильность заполнения полей и нажмите "Войти"!
		</div>
		<?php endif; ?>
		<form action="login.php" method="POST">
			<div class="row <?= is_error($errors, 'username') ? 'error' : '' ?>">
				<label for="username">Имя пользователя<span class="required">*</span>:</label>
				<input type="text" name="username" id="username"
					   value="<?= isset($form['username']) ? $form['username'] : '' ?>">
			</div>
			<div class="row <?= is_error($errors, 'password') ? 'error' : '' ?>">
				<label for="password">Пароль<span class="required">*</span>:</label>
				<input type="password" name="password" id="password" value="">
			</div>
			<div class="row footer">
				<input type="submit" name="login" id="login" value="Войти"/>
				<input type="reset" name="reset" id="reset" value="Очистить"/>
			</div>
			<div class="row footer">
				Еще не зарегистрированы? <a href="register.php">Зарегистрируйтесь!</a>
			</div>
		</form>
	</div>
</div>
	</div>
  </body>
</html>