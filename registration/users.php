<?php

require('lib/common.php');

/*
 * Точка входа скрипта
 */
function main()
{
	// создаем сессию
	session_start();

	if (!is_current_user()) {
		// отправляем пользователя на страницу входа в систему
		redirect('login.php');
	}

	// у нас есть пользователь, считываем список пользователей из БД, и отображаем его

	// подключаемся к базе данных
	$dbh = db_connect();

	// считываем список пользователей и текущего пользователя
	$user_list = db_user_find_all($dbh);
	$current_user = db_user_find_by_id($dbh, get_current_user_id());

	// выводим результирующую страницу
	render('user_list', array(
		'user_list' => $user_list, 'current_user' => $current_user
	));

	// закрываем соединение с базой данных
	db_close($dbh);
}

main();

