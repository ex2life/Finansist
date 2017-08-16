<!DOCTYPE html>

<html>
  <head>
	<title>Финансист онлайн</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<link rel="stylesheet" href="../css/bootstrap.min.css"/> 
	<link rel="stylesheet" href="../css/magnific-popup.css">
	<link rel="stylesheet" href="../css/style.css"/> 
	<script type="text/javascript" src="../js/jquery-1.12.2.min.js"></script>
	<script type="text/javascript" src="../js/magnific-popup.js"></script>
	<script type="text/javascript" src="../js/my.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
	
  <body>
    <header>
		<?php
		if ($_REQUEST['type_platezh'] == 'annuit')
			echo "<h2>АННУИТЕТНЫЙ ПЛАТЕЖ</h2>";
		elseif ($_REQUEST['type_platezh'] == 'differ')
			echo "<h2>ДИФФЕРЕНЦИРОВАННЫЙ ПЛАТЕЖ</h2>";
		elseif ($_REQUEST['type_platezh'] == 'flex')
			echo "<h2>ГИБКИЙ ПЛАТЕЖ</h2>";
		?>
	</header>
	<form method="post" id="frmPlatezhParam" action="platezh_result_ajax.php">
		<?php
		if ($_REQUEST['type_platezh'] == 'annuit')
			echo '<input type="hidden" name="type_platezh" id="type_platezh" value="annuit">';
		elseif ($_REQUEST['type_platezh'] == 'differ')
			echo '<input type="hidden" name="type_platezh" id="type_platezh" value="differ">';
		elseif ($_REQUEST['type_platezh'] == 'flex')
			echo '<input type="hidden" name="type_platezh" id="type_platezh" value="flex">';
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
		
		<!-- <a href="#text-popup" class="popup-content">Вызвать окно с текстом</a> -->

		<?php
		if ($_REQUEST['type_platezh'] == 'flex') {
			# echo '<a id="add_flex_payments" href="#">Новый график гашений</a>';
			echo '<div class="input_payment_schedule" id="input_payment_schedule">';
			echo  '<div></div>';
			echo '</div>';
			echo '<p></p>';
		}
		?>
		<p><input type="submit" id="btnShowPaymentSchedule" value="Показать график платежей"></p>
	</form>

	<!--
	<div id="text-popup" class="white-popup mfp-hide">
	<p>С другой стороны постоянное информационно-пропагандистское обеспечение нашей деятельности позволяет оценить значение направлений прогрессивного развития.</p>
	</div>
	-->

	</body>
</html>