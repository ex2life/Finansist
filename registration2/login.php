<?php
include_once 'check_authorization.php'; // проверяем авторизирован ли пользователь

// если да, перенаправляем его на главную страницу
if ($user) {
	header ('Location: index.php');
	exit();
}

if (!empty($_POST['login']) AND !empty($_POST['password'])) {
 	// фильтрируем логин и пароль
 	$login = $mysqli->real_escape_string(htmlspecialchars($_POST['login']));
 	$password = $mysqli->real_escape_string(htmlspecialchars($_POST['password']));
 
 	$query = "SELECT COUNT(*) FROM `users_profiles` WHERE `username` = '".$login."' AND `password` = '".md5($password)."'";
 	$result = $mysqli->query($query);
 	$is_correct_user = $result->fetch_row()[0];

	//$search_user = mysql_result(mysql_query("SELECT COUNT(*) FROM `users_profiles` WHERE `username` = '".$login."' AND `password` = '".md5($password)."'"), 0);
	if ($is_correct_user == 0)
		{
		echo 'Введенные данные неправильные или пользователь не найден.';
		exit();
		}
	else
		{
	    // заносим логин и пароль в куки
		$time = 60*60*24; // сколько времени хранить данные в куках
		setcookie('username', $login, time()+$time, '/');
		setcookie('password', md5($password), time()+$time, '/');
		echo 'Вы успешно авторизировались на сайте!';
		exit();
		}
}
echo '
<form action="login.php" method="POST">
Логин:<br />
<input name="login" type="text" /><br />
Пароль:<br />
<input name="password" type="password" /><br />
<input type="submit" value="Авторизироваться" />
</form>';
?>