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
	<div align="right" style="margin-right:5%" class="wrapper">
		<?php if ($current_user): ?>
			<a href=".\registration\users_company.php" class="btn btn-default">Мои компании</a>
			<div class="btn-group">
			  <a href="./registration/users_setting.php" title="Настройки профиля" class="btn btn-default"><?= $current_user['fullname'] ?></a>
			  <a href="./registration/logout.php" title="Выход" class="btn btn-default"><img width="20" height="20" src="../img/Out.png"></a>
			</div>

				

		<?php else: ?>
		<form action="./registration/login.php?from=index"  method="POST" class="form-inline">
			<div class="input-group mb-2 mr-sm-2 mb-sm-0">
				<div class="input-group-addon"><img width="20" height="20" src="../img/user.png"></div>
				<input type="text" name="username" id="username" class="form-control" placeholder="Имя пользователя">
			</div>
			<div class="input-group mb-2 mr-sm-2 mb-sm-0">
				<div class="input-group-addon"><img width="20" height="20" src="../img/key.png"></div>
				<input type="password" name="password" id="password" class="form-control" placeholder="Пароль">
			</div>
			<button type="submit" name="login" id="login" class="btn btn-default">Вход</button>
			<a href="./registration/register.php" class="btn btn-default">Регистрация</a>
		</form>
		<?php endif; ?>
	</div>
  	<div class="container">
	    <header class="header">
			<h1 class="text-center">ФИНАНСИСТ ОНЛАЙН</h1>
			
		</header>
		<div id="formlogin" class="jumbotron">
	   	<h2>Письмо с ссылкой для восстановления пароля отправлено!</h2>
	<div class="info">
		<H3><P>Для того, чтобы восстановить пароль, перейдите по ссылке в письме, которое вам сейчас придет от нас!<p>
		Если вдруг вы не видете письма на почте, подождите несколько минут, либо проверьте СПАМ ящик.</H3>
	</div>
</div>
	</div>
  </body>
</html>