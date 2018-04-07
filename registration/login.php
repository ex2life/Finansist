<?php

require('lib/common.php');
require_once '../libs/google-api-php-client/vendor/autoload.php'; 
/*
 * Проверяет, что была выполнена отправка формы входа
 */
function is_postback()
{
	return isset($_POST['login']);
}
		
function getUserFromToken($token) {
	$client = new Google_Client();
	$ticket = $client->verifyIdToken($token);
	if ($ticket) {
		// $data = $ticket->getAttributes();
		return $ticket['sub']; // user ID
		//return $data['payload']['sub']; // user ID
		//return "ага";
	}
	return "нит";
	//return false;
}

/*
 * Точка входа скрипта
 */
function main()
{
	// создаем сессию
	session_start();
	if (is_current_user()) {
		// если пользователь уже залогинен, то отправляем его на глапную
		redirect('./');
	}
	if ($_GET['log']=='vk')
	{
		if ($_GET['hash']==md5("6394999".$_GET['uid']."C4TLEl6y6TQuLZJj9KGG"))
		{
			$dbh = db_connect();
			$post_result = login_social_user($dbh, $_GET['log'], $_GET['uid']+1, $errors);
			if ($post_result==0) {//Если логин в базе не найден
				$post_result=false;
			}
			db_close($dbh);
			if ($post_result) 
			{
				// перенаправляем на главную
				redirect('./');
			} 
			else {
				// информация о пользователе заполнена неправильно, выведем страницу с ошибками
				if (isset($_GET['first_name']))
				{
					$data_get['fullname'] = $_GET['first_name'];
				}
				if (isset($_GET['last_name']))
				{
					$data_get['fullname'] = $data_get['fullname']." ".$_GET['last_name'];
				}
				render('register_form', array(
					'form' => $_POST, 'errors' => $errors
				));
			}
		};
	}
	elseif ($_GET['log']=='telegram')
	{
		define('BOT_TOKEN', '540342856:AAF9Tg1zBhy2zwma7aoKZ4VcS7GSOC1wxLA'); // place bot token of your bot here
		function checkTelegramAuthorization($auth_data) 
		{
		  $check_hash = $auth_data['hash'];
		  unset($auth_data['hash']);
		  $data_check_arr = [];
		  foreach ($auth_data as $key => $value) {
			if ($value!='telegram') {
				$data_check_arr[] = $key . '=' . $value;
			}
		  }
		  sort($data_check_arr);
		  $data_check_string = implode("\n", $data_check_arr);
		  $secret_key = hash('sha256', BOT_TOKEN, true);
		  $hash = hash_hmac('sha256', $data_check_string, $secret_key);
		  if (strcmp($hash, $check_hash) !== 0) {
			throw new Exception('Data is NOT from Telegram');
		  }
		  if ((time() - $auth_data['auth_date']) > 86400) {
			throw new Exception('Data is outdated');
		  }
		  return true;
		}
		function saveTelegramUserData($auth_data) {
		  $auth_data_json = json_encode($auth_data);
		  setcookie('tg_user', $auth_data_json);
		}
		try {
		  $check = checkTelegramAuthorization($_GET);
		  if ($check){
			$dbh = db_connect();
			$post_result = login_social_user($dbh, $_GET['log'], $_GET['id']+1, $errors);
			db_close($dbh);
			if ($post_result==0) {//Если логин в базе не найден
				$post_result=false;
			}
			if ($post_result) 
			{
				//// перенаправляем на главную
				redirect('./');
			} 
			else {
				// информация о пользователе заполнена неправильно, выведем страницу с ошибками
				if (isset($_GET['username']))
				{
					$data_get['nickname'] = $_GET['username'];
				}
				if (isset($_GET['first_name']))
				{
					$data_get['fullname'] = $_GET['first_name'];
				}
				if (isset($_GET['last_name']))
				{
					$data_get['fullname'] = $data_get['fullname']." ".$_GET['last_name'];
				}
				render('register_form', array(
					'form' => $data_get, 'errors' => $errors
				));
			}
		  }
		} catch (Exception $e) {
		  die ($e->getMessage());
		}
	}
	elseif ($_POST['log']=='google')
	{	
		$idgoogleuser=getUserFromToken($_POST['idtoken']);
		if (!$idgoogleuser) {
			echo ("Что-то пошло не так.");
		}
		else{
			$dbh = db_connect();
			$post_result = login_social_user($dbh, $_POST['log'], $idgoogleuser+1, $errors);
			if ($post_result==0) {//Если логин в базе не найден
				$post_result=false;
			}
			db_close($dbh);
			if ($post_result) 
			{
				//// перенаправляем на главную
				///redirect('./');
				echo "auth_ok";
			} 
			else {
				// информация о пользователе заполнена неправильно, выведем страницу с ошибками
				echo "auth_not_found";
			}
		}
	}
	else
	{
		if (is_postback()) 
		{
			// обрабатываем отправленную форму
			$dbh = db_connect();
			$post_result = login_user($dbh, $user, $errors);
			db_close($dbh);

			if ($post_result) 
			{
				// перенаправляем на главную
				redirect('./');
			} 
			else {
				// информация о пользователе заполнена неправильно, выведем страницу с ошибками
				render('login_form', array(
					'form' => $_POST, 'errors' => $errors
				));
		}
		} 
		else 
		{
			// отправляем пользователю чистую форму для входа
			render('login_form', array(
				'form' => array(), 'errors' => array()
			));
		}	
	}
}

main();

