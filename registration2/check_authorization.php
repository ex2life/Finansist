<?php
//include_once 'db_connect.php'; // Проверяем подключение к базе данных
include_once '../script/app_config.php'; // Проверяем подключение к базе данных
$mysqli = db_connect();

// Проверяем, заполнены ли логин и пароль в куках
if (!empty($_COOKIE['username']) AND !empty($_COOKIE['password'])) {
 	// Ищем пользователя в таблице users_profiles
 	$username = $mysqli->real_escape_string($_COOKIE['username']);
 	$password = $mysqli->real_escape_string($_COOKIE['password']);
 	$search_user = $mysqli->query("SELECT * FROM `users_profiles` WHERE `username` = '".$username.
 		"' AND `password` = '".$password."'");
 	$user = ($search_user->num_rows == 1) ? $search_user->fetch_assoc() : 0;
}
else 	{
 	$user = 0;
}

?>