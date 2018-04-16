<!DOCTYPE html>

<html>
  <head>
	<title>Финансист онлайн</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<link href="../css/bootstrap.min.css" rel="stylesheet"/> 
	<link href="../css/style.css" rel="stylesheet"/> 
	<link rel="stylesheet" type="text/css" href="../registration/css/main.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
	
  <body>
  
  	<div class="container">
		<div align="right" style="margin-right:5%" class="wrapper">
			<a href="#" class="btn btn-default">Мои компании</a>
			<div class="btn-group">
			  <a href="#" title="Настройки профиля" class="btn btn-default"><?= $user['fullname'] ?></a>
			  <a href="../registration/logout.php" title="Выход" class="btn btn-default"><img width="20" height="20" src="../img/Out.png"></a>
			</div>
		</div>
	    <header class="header">
			<center><h1>Настройки профиля</h1></center>
			
		</header>
		
		<div id="formlogin" class="jumbotron">
	<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#setting">Основные настройки</a></li>
    <li><a data-toggle="tab" href="#password">Изменение пароля</a></li>
	<li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Подключение социальных сетей
    <span class="caret"></span></a>
    <ul class="dropdown-menu">
      <li><a data-toggle="tab" href="#vk">Google</a></li>
      <li><a data-toggle="tab" href="#telegram">Telegram</a></li>
      <li><a data-toggle="tab" href="#google">Google</a></li> 
    </ul>
  </li>
  </ul>

  <div class="tab-content">
    <div id="setting" class="tab-pane fade in active">
      <h3>HOME</h3>
      <p>Some content.</p>
    </div>
    <div id="password" class="tab-pane fade">
      <h3>Menu 1</h3>
      <p>Some content in menu 1.</p>
    </div>
    <div id="social" class="tab-pane fade">
      <h3>Menu 2</h3>
      <p>Some content in menu 2.</p>
    </div>
	<div id="vk" class="tab-pane fade">
      <h3>Авторизация вк</h3>
      <p>Some content in menu 2.</p>
    </div>
    <div id="telegram" class="tab-pane fade">
      <h3>Авторизация телеграмм</h3>
      <p>Some content in menu 2.</p>
    </div>
    <div id="google" class="tab-pane fade">
      <h3>Авторизация гугл</h3>
      <p>Some content in menu 2.</p>
    </div>
    
  </div>
  </div>
    <form action="users_company.php" method="POST">
        <input type="submit" name="add_company" id="add_company" value="Добавить компанию"/>
    </form>
</div>
	</div>
  </body>
  
</html>