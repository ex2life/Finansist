<?php
include_once 'check_authorization.php'; // проверяем авторизирован ли пользователь

// проверяем авторизацию пользователя
 if ($user) {
 setcookie('username', '', time()-1, '/');
 setcookie('password', '', time()-1, '/');
 session_destroy();
 echo 'Вы успешно вышли!';
 } else {
  echo 'Для этого действия нужно авторизироваться.';
 }
?>