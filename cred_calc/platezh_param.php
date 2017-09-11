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
	<script type="text/javascript" src="../js/jquery.validate.min.js"></script>
	<script type="text/javascript" src="../js/additional-methods.min.js"></script>
	<script type="text/javascript" src="../js/magnific-popup.js"></script>
	<script type="text/javascript" src="../js/my.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
	
<body>
	<div class="container">
		<div class="header">
			<?php
			if ($_REQUEST['type_platezh'] == 'annuit')
				echo '<h2 class="text-center">АННУИТЕТНЫЙ ПЛАТЕЖ</h2>';
			elseif ($_REQUEST['type_platezh'] == 'differ')
				echo '<h2 class="text-center">ДИФФЕРЕНЦИРОВАННЫЙ ПЛАТЕЖ</h2>';
			elseif ($_REQUEST['type_platezh'] == 'flex')
				echo '<h2 class="text-center">ГИБКИЙ ПЛАТЕЖ</h2>';
			?>
		</div>
		<form class="form-horizontal" method="post" id="frmPlatezhParam" action="platezh_result.php">
		<!-- <form class="form-horizontal" id="frmPlatezhParam"> -->
			<?php
			if ($_REQUEST['type_platezh'] == 'annuit')
				echo '<input type="hidden" name="type_platezh" id="type_platezh" value="annuit">';
			elseif ($_REQUEST['type_platezh'] == 'differ')
				echo '<input type="hidden" name="type_platezh" id="type_platezh" value="differ">';
			elseif ($_REQUEST['type_platezh'] == 'flex')
				echo '<input type="hidden" name="type_platezh" id="type_platezh" value="flex">';
			?>
			<div class="form-group">
				<label for="str_beg_date" class="col-xs-3 control-label">Дата получения кредита (ММ.ГГГГ) </label>
				<div class="col-xs-9">
					<!-- Сначала дату вводили в полном формате
					<input type="date" name="str_beg_date" value="<?=date('d.m.Y')?>" maxlength="10" autofocus required pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])\.(0[1-9]|1[012])\.[0-9]{4}"> -->
					<input type="text" name="str_beg_date" value="<?=date('m.Y')?>" id="str_beg_date" maxlength="7" autofocus required pattern="(0[1-9]|1[012])\.[0-9]{4}">
				</div>
			</div>
			<div class="form-group">
				<label for="sum_kred" class="col-xs-3 control-label text-left">Сумма кредита </label>
				<div class="col-xs-9">
					<input type="text" name="sum_kred" id="sum_kred" required pattern="^\d+(\.\d{1,2})?$">
				</div>
			</div>
			<div class="form-group">
				<label for="col_month" class="col-xs-3 control-label">Срок кредита в месяцах </label>
				<div class="col-xs-9">
					<input type="number" min="1" name="col_month" id="col_month" value="1" required>
				</div>
			</div>
			<div class="form-group">
				<label for="proc" class="col-xs-3 control-label">Процентная ставка в год </label>
				<div class="col-xs-9">
					<input type="text" name="proc" id="proc" required pattern="^\d+(\.\d{1,2})?$">
				</div>
			</div>
			
			<!-- <a href="#text-popup" class="popup-content">Вызвать окно с текстом</a>  -->

			<?php
			if ($_REQUEST['type_platezh'] == 'flex') {
				# echo '<a id="add_flex_payments" href="#">Новый график гашений</a>';
				echo '<div class="input_payment_schedule" id="input_payment_schedule">';
				echo  '<div></div>';
				echo '</div>';
				echo '<p></p>';
			}
			?>
			<div class="form-group">
				<input class="col-xs-2 col-xs-offset-3 btn btn-primary" type="submit" id="btnShowPaymentSchedule" value="Показать график платежей">
			</div>
		</form>

		<!-- Контейнер для вывода графика платежей в magnific-popup -->
		<div id="text-popup" class="white-popup mfp-hide">
		</div>
	</div>
</body>
</html>