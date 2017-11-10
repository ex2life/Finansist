<?php
include_once 'check_authorization.php'; // Проверяем, авторизирован ли пользователь

if ($user) {
	// выводим информацию для пользователя
	echo 'Привет, <b>'.$user['username'].'</b>!<br />
	- <a href="exit.php">Выйти</a><br />
	';
} 
else {
	// выводим информацию для гостя
	echo '
	- <a href="login.php">Авторизация</a><br />
	- <a href="register.php">Регистрация</a><br />
	';
}

?>