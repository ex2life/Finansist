<?php
include_once 'check_authorization.php'; // проверяем авторизирован ли пользователь

// если да, перенаправляем его на главную страницу
if ($user) 	{
	header ('Location: index.php');
	exit();
}

if (!empty($_POST['login']) AND !empty($_POST['password'])) 	{
 	// фильтрируем логин и пароль
 	$login = $mysqli->real_escape_string(htmlspecialchars($_POST['login']));
 	$password = $mysqli->real_escape_string(htmlspecialchars($_POST['password']));
 
 	// проверяем есть ли логин в нашей базе данных
 	$query = "SELECT COUNT(*) FROM `users_profiles` WHERE `username` = '".$login."' LIMIT 1;";
 	$result = $mysqli->query($query);
 	$is_user_already_exists = $result->fetch_row()[0];
	if ($is_user_already_exists != 0)
		{
		echo 'Выбранный логин уже зарегистрирован!';
		exit();
		}
 	// Добавляем имя и пароль пользователя в таблицу (пароль кодируем в md5)
	$query = "INSERT INTO `users_profiles` (`username`, `password`) VALUES ('".$login."', '".md5($password)."')";
	$mysqli->query($query);
    echo 'Вы успешно зарегистрированы!';
	exit();
}
 // форма регистрации
echo '
<form action="register.php" method="POST">
Логин:<br/>
<input name="login" type="text" value="" /><br/>
Пароль:<br/>
<input name="password" type="text" value="" /><br/>
<input type="submit" value="Зарегистрироваться" />
</form>';
?>