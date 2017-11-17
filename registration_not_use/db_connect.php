<?php

mysql_connect('localhost', 'root', '') or die('Ошибка соеденения с MySQL!');
mysql_select_db('finansist') or die ('Ошибка соединения с базой данных MySQL!');
mysql_query('SET NAMES `utf8`'); // выставляем кодировку базы данных

?>