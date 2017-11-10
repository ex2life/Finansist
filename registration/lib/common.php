<?php

require('config.php');


/* ****************************************************************************
 * Общие функции
 */

/*
 * Выполняет переадресацию на указанный адрес $url
 */
function redirect($url)
{
	session_write_close();
	header('Location: '.$url);
	exit;
}

/*
 * Выполняет вывод указанного шаблона $template с данными
 */
function render($template, $data=array())
{
	extract($data);
	require('templates/'.$template.'.php');
}


/* ****************************************************************************
 * Функции работы с массивом ошибок
 */

/*
 * Инициализирует структуру массива для хранения информации об ошибках
 */
function empty_errors()
{
	return array(
		'fields' 	=> array(),
		'messages'	=> array(),
	);
}

/*
 * Проверяет, что есть ошибочные поля в описании ошибок
 */
function has_errors($errors)
{
	return isset($errors['fields']) && count($errors['fields']) > 0;
}

/*
 * Проверяет, что указанное поле есть в списке ошибочных полей
 */
function is_error($errors, $field)
{
	return isset($errors['fields']) && in_array($field, $errors['fields']);
}

/*
 * Добавляет описание ошибки в массив ошибок
 */
function add_error(&$errors, $field, $description)
{
	$errors['fields'][] = $field;
	$errors['messages'][$field] = "@$field-$description";
	return false;
}


/* ****************************************************************************
 * Валидация данных
 */

/*
 * Проверяет корректность строки в форме, если строка корректна, копирует ее в $obj
 * и возвращает true; false и заполненный массив ошибок, если нет
 */
function read_string($form, $field, &$obj, &$errors, $min, $max, $is_required, $default=null, $trim=true)
{
	$obj[$field] = $default;
	if (!isset($form[$field])) {
		return $is_required ? add_error($errors, $field, 'required') : true;
	}

	$value = $trim ? trim($form[$field]) : $form[$field];
	if ($value == '' && $is_required)
		return add_error($errors, $field, 'required');

	if (strlen($value) < $min)
		return add_error($errors, $field, 'too-short');

	if (strlen($value) > $max)
		return add_error($errors, $field, 'too-long');

	$obj[$field] = $value;
	return true;
}

/*
 * Проверяет корректность адреса электронной почты в форме, если адрес корректен,
 * копирует его в $obj и возвращает true; false и заполненный массив ошибок, если нет
 */
function read_email($form, $field, &$obj, &$errors, $min, $max, $is_required, $default=null)
{
	$obj[$field] = $default;
	if (!isset($form[$field])) {
		return $is_required ? add_error($errors, $field, 'required') : true;
	}

	$value = trim($form[$field]);
	if (strlen($value) < $min)
		return add_error($errors, $field, 'too-short');

	if (strlen($value) > $max)
		return add_error($errors, $field, 'too-long');

	// проверяем, что в строке задан адрес электронной почты
	if (!filter_var($value, FILTER_VALIDATE_EMAIL))
		return add_error($errors, $field, 'invalid');

	$obj[$field] = $value;
	return true;
}

/*
 * Проверяет корректность выбора одного из значений в форме, если выбрано значение
 * из указанного списка, копирует его в $obj и возвращает true; false и заполненный
 * массив ошибок, если нет
 */
function read_list($form, $field, &$obj, &$errors, $list, $is_required, $default=null)
{
	$obj[$field] = $default;
	if (!isset($form[$field])) {
		return $is_required ? add_error($errors, $field, 'required') : true;
	}

	$value = trim($form[$field]);
	if (!in_array($value, $list))
		return add_error($errors, $field, 'invalid');

	$obj[$field] = $value;
	return true;
}

/*
 * Проверяет корректность логического значения, если корректно, копирует его
 * в $obj и возвращает true; false и заполненный массив ошибок, если нет
 */
function read_bool($form, $field, &$obj, &$errors, $true, $is_required, $default=null)
{
	$obj[$field] = $default;
	if (!isset($form[$field])) {
		return $is_required ? add_error($errors, $field, 'required') : true;
	}

	$value = trim($form[$field]);
	$obj[$field] = $value === $true;
	return true;
}


/* ****************************************************************************
 * Текущий пользователь, для вошедшего в систему пользователя мы храним
 * в сессии его идентификатор в базе данных
 */

/*
 * Проверяет, что у нас имеется вошедший в систему пользователь
 */
function is_current_user()
{
	return isset($_SESSION['user_id']);
}

/*
 * Возвращает идентификатор пользователя, выполнившего вход в систему
 */
function get_current_user_id()
{
	return $_SESSION['user_id'];
}

/*
 * Сохраняет идентификатор пользователя, выполнившего вход
 */
function store_current_user_id($id)
{
	$_SESSION['user_id'] = $id;
}

/*
 * Сбрасывает идентификатор пользователя, выполнившего вход
 */
function reset_current_user_id()
{
	unset($_SESSION['user_id']);
}

/*
 * Выполняет вход пользователя в систему, возвращает true, если вход
 * выполнен успешно, и false и заполненный массив ошибок в противном
 * случае
 */
function login_user($dbh, &$user, &$errors)
{
	$user = array();
	$errors = empty_errors();

	// считываем строки из запроса
	read_string($_POST, 'username', $user, $errors, 2, 64, true);
	read_string($_POST, 'password', $user, $errors, 6, 20, true);

	if (has_errors($errors))
		return false;

	// форма передана правильно, ищем пользователя и проверяем пароль
	$db_user = db_user_find_by_login($dbh, $user['username']);
	// смотрим, есть ли такой пользователь и правильно ли передан пароль
	if ($db_user == null || $db_user['password'] !== crypt($user['password'], $db_user['password']))
		return add_error($errors, 'password', 'invalid');

	// пользователь ввел правильные имя и пароль, запоминаем его в сессии
	store_current_user_id($db_user['id']);
	return true;
}

/*
 * Выполняет выход пользователя из системы
 */
function logout_user()
{
	reset_current_user_id();
}

/*
 * Выполняет ркгистрацию пользователя, возвращает true, если регистраиция
 * завершилась успешно, и false и заполненный массив ошибок в противном
 * случае
 */
function register_user($dbh, &$user, &$errors)
{
	$user = array();
	$errors = empty_errors();

	// считываем строки из запроса
	read_string($_POST, 'nickname', $user, $errors, 2, 64, true);
	read_email($_POST, 'email', $user, $errors, 2, 64, true);
	read_string($_POST, 'password', $user, $errors, 6, 24, true);
	read_string($_POST, 'password_confirmation', $user, $errors, 6, 24, true);
	read_string($_POST, 'fullname', $user, $errors, 1, 80, true);
	read_list($_POST, 'gender', $user, $errors, array('M', 'F'), false);
	read_bool($_POST, 'newsletter', $user, $errors, '1', false, false);

	// пароль и подтверждение пароля должны совпадать
	if (!is_error($errors, 'password') &&
			!is_error($errors, 'password_confirmation') &&
			$user['password'] != $user['password_confirmation']) {
		$errors['fields'][] = 'password';
		add_error($errors, 'password_confirmation', 'dont-match');
	}

	if (has_errors($errors))
		return false;

	// защищаем пароль пользователя
	$user['password'] = crypt($user['password']);
	unset($user['password_confirmation']);

	// форма передана правильно, сохраняем пользователя в базу данных
	$db_user = db_user_insert($dbh, $user);

	// автоматически логиним пользователя после регистрации, запоминая его в сессии
	store_current_user_id($db_user['id']);
	return true;
}


/* ****************************************************************************
 * Список пользователей в базе данных
 */

/*
 * Выполняет подключение к базе данных
 */
function db_connect()
{
	$dbh = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	// проверка соединения
	if (mysqli_connect_errno())
		db_handle_error($dbh);

	mysqli_set_charset($dbh, "utf8");

	return $dbh;
}

/*
 * Закрывает подключение к базе данных
 */
function db_close($dbh)
{
	mysqli_close($dbh);
}

/*
 * Обработка ошибок подключения к базе данных
 */
function db_handle_error($dbh)
{
	$code = '@unknown-error';
	$message = '';
	if (mysqli_connect_error()) {
		$code = '@connect-error';
		$message = mysqli_connect_error();
	}

	if (mysqli_error($dbh)) {
		$code = '@query-error';
		$message =mysqli_error($dbh);
	}

	render('error', array(
		'code' => $code, 'message' => $message,
	));
	exit;
}

/*
 * Извлекает из базы данных список пользователей
 */
function db_user_find_all($dbh)
{
	$query = 'SELECT * FROM users';
	$result = array();

	// выполняем запрос к базе данных
	$qr = mysqli_query($dbh, $query, MYSQLI_STORE_RESULT);
	if ($qr === false)
		db_handle_error($dbh);

	// последовательно извлекаем строки
	while ($row = mysqli_fetch_assoc($qr))
		$result[] = $row;

	// освобождаем ресурсы, связанные с хранением результата
	mysqli_free_result($qr);

	return $result;
}

/*
 * Выполняет поиск в базе данных и загрузку пользователя с указанным id
 */
function db_user_find_by_id($dbh, $id)
{
	$query = 'SELECT * FROM users WHERE id=?';

	// подготовливаем запрос для выполнения
	$stmt = mysqli_prepare($dbh, $query);
	if ($stmt === false)
		db_handle_error($dbh);

	mysqli_stmt_bind_param($stmt, 's', $id);

	// выполняем запрос и получаем результат
	if (mysqli_stmt_execute($stmt) === false)
		db_handle_error($dbh);

	// получаем результирующий набор строк
	$qr = mysqli_stmt_get_result($stmt);
	if ($qr === false)
		db_handle_error($dbh);

	// извлекаем результирующую строку
	$result = mysqli_fetch_assoc($qr);

	// освобождаем ресурсы, связанные с хранением результата и запроса
	mysqli_free_result($qr);
	mysqli_stmt_close($stmt);

	return $result;
}

/*
 * Выполняет поиск в базе данных и загрузку пользователя с указанным логином
 * (логином считаем адрес электронной почты и ник пользователя)
 */
function db_user_find_by_login($dbh, $login)
{
	$query = 'SELECT * FROM users WHERE email=? OR nickname=?';

	// подготовливаем запрос для выполнения
	$stmt = mysqli_prepare($dbh, $query);
	if ($stmt === false)
		db_handle_error($dbh);

	mysqli_stmt_bind_param($stmt, 'ss', $login, $login);

	// выполняем запрос и получаем результат
	if (mysqli_stmt_execute($stmt) === false)
		db_handle_error($dbh);

	// получаем результирующий набор строк
	$qr = mysqli_stmt_get_result($stmt);
	if ($qr === false)
		db_handle_error($dbh);

	// извлекаем результирующую строку
	$result = mysqli_fetch_assoc($qr);

	// освобождаем ресурсы, связанные с хранением результата и запроса
	mysqli_free_result($qr);
	mysqli_stmt_close($stmt);

	return $result;
}

/*
 * Вставляет в базу данных строку с информацией о пользователе, возвращает массив
 * с данными пользователя и его id в базе данных
 */
function db_user_insert($dbh, $user)
{
	$query = 'INSERT INTO users(nickname,email,password,fullname,gender,newsletter) VALUES(?,?,?,?,?,?)';

	// подготовливаем запрос для выполнения
	$stmt = mysqli_prepare($dbh, $query);
	if ($stmt === false)
		db_handle_error($dbh);

	mysqli_stmt_bind_param($stmt, 'sssssi',
		$user['nickname'], $user['email'], $user['password'],
		$user['fullname'], $user['gender'], $user['newsletter']);

	// выполняем запрос и получаем результат
	if (mysqli_stmt_execute($stmt) === false)
		db_handle_error($dbh);

	// получаем идентификатор вставленной записи
	$user['id'] = mysqli_insert_id($dbh);

	// освобождаем ресурсы, связанные с хранением результата и запроса
	mysqli_stmt_close($stmt);

	return $user;
}
