<?php
session_start();
require('lib/common.php');

/*
 * Точка входа скрипта
 */
function main()
{


	// у нас есть пользователь, считываем список пользователей из БД, и отображаем его

	// подключаемся к базе данных
	$dbh = db_connect();


	if (db_freedom_nick_find($dbh, "ex2life"))
	{
		echo "true";
	}
	else
	{
		echo "false";
	}
}

main();

