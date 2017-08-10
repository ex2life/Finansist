<!DOCTYPE html>

<html>
  <head>
	<title>Финансист онлайн</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<link href="../css/bootstrap.min.css" rel="stylesheet"/> 
	<link href="../css/style.css" rel="stylesheet"/> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script type="text/javascript" src="../js/jquery-1.12.2.min.js"></script>
	<script type="text/javascript" src="../js/my.js"></script>	
	
  </head>
	
  <body>
    <header>
		<?php
		if ($_REQUEST['type_platezh'] == 'flex')
			echo "<h2>ГИБКИЙ ПЛАТЕЖ</h2>";
		?>
	</header>
	<form method="post" action="platezh_result.php">
		<?php
		if ($_REQUEST['type_platezh'] == 'flex')
			echo '<input type="hidden" name="type_platezh" value="flex">';
		?>
		<label>Дата получения кредита (ММ.ГГГГ): 
		<!-- Сначала дату вводили в полном формате
		<input type="date" name="str_beg_date" value="<?=date('d.m.Y')?>" maxlength="10" autofocus required pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])\.(0[1-9]|1[012])\.[0-9]{4}"> -->
		<input type="text" name="str_beg_date" value="<?=date('m.Y')?>" id="str_beg_date" maxlength="7" autofocus required pattern="(0[1-9]|1[012])\.[0-9]{4}">
		</label>
		<p><label>Сумма кредита: 
		<input type="text" name="sum_kred" required pattern="^\d+(\.\d{1,2})?$">
		</label></p>
		<p><label>Срок кредита в месяцах: 
		<input type="number" min="1" name="col_month" id="col_month" value="1" required>
		</label></p>
		<p><label>Процентная ставка в год: 
		<input type="text" name="proc" required pattern="^\d+(\.\d{1,2})?$">
		</label></p>
		<a id="add_flex_payments" href="#">Добавить график гашений</a>
		<div class="input_payment_schedule">
			<div></div>
		</div>
		<p></p>
		<p><input type="submit" value="Построить график платежей"></p>
	</form>

	</body>
</html>