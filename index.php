<?php
session_start();
require('./registration/lib/common.php');
$dbh = db_connect();
$current_user = db_user_find_by_id($dbh, get_current_user_id());
?>

<html>
  <head>

<div  class="wrapper">
		<?php if ($current_user): ?>
			<a href="./registration/users.php" class="user"><?= $current_user['fullname'] ?></a><a href="./registration/logout.php" class="button">Выход</a>
		<?php else: ?>
		<form action="./registration/index.php">

           <button type="submit" >Авторизация</button>
	    </form>
		<?php endif; ?>
	</div>
	<title>Финансист онлайн</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<link href="css/bootstrap.min.css" rel="stylesheet"/> 
	<link href="css/style.css" rel="stylesheet"/> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
	
  <body>
  	<div class="container">

	    
	    <header>
			<h1 class="text-center">ФИНАНСИСТ ОНЛАЙН</h1>
		</header>
		<div class="row">
			<a class="btn_margin btn btn-default btn-lg col-xs-10 col-sm-6 col-md-4 col-lg-3 col-xs-offset-1 col-sm-offset-5 col-md-offset-7 col-lg-offset-9" href="./cred_calc/calc.html">Кредитный калькулятор </a>
			<a class="btn_margin btn btn-default btn-lg col-xs-10 col-sm-6 col-md-4 col-lg-3 col-xs-offset-1 col-sm-offset-5 col-md-offset-7 col-lg-offset-9" href="#">Расчет суммы кредита</a>
			<a class="btn_margin btn btn-default btn-lg col-xs-10 col-sm-6 col-md-4 col-lg-3 col-xs-offset-1 col-sm-offset-5 col-md-offset-7 col-lg-offset-9" href="#">Финансовый анализ</a>
			<a class="btn_margin btn btn-default btn-lg col-xs-10 col-sm-6 col-md-4 col-lg-3 col-xs-offset-1 col-sm-offset-5 col-md-offset-7 col-lg-offset-9" href="#">Управленческая отчетность</a>
			<a class="btn_margin btn btn-default btn-lg col-xs-10 col-sm-6 col-md-4 col-lg-3 col-xs-offset-1 col-sm-offset-5 col-md-offset-7 col-lg-offset-9" href="#">Анализ инвестиционных проектов</a>
		</div>
	</div>
  </body>

</html>