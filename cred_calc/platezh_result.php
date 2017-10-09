<?php 
	require_once '../script/functions.php';
	$type_platezh = $_POST['type_platezh'];
	$str_beg_date = "01.".$_POST['str_beg_date'];
	$sum_kred = $_POST['sum_kred'];
	$col_month = $_POST['col_month'];
	$proc = $_POST['proc'];
	
	$arr_payments = array_fill(0, $col_month, 0);
	$n = 0;
	if ($type_platezh == 'flex') {
		foreach($_POST['flex_payment_schedule'] as $flex_payment) {
			$arr_payments[$n] = round((float)$flex_payment, 2);
			$n++;
		
		}
	}

	// Формируем массив с данными о платежах в каждом месяце
	$arr_all_platezh = Payment_Schedule($type_platezh, $str_beg_date, $sum_kred, $col_month, $proc, $arr_payments);

	// Формируем html-код для табличной части расчета платежей для всплывающего окна
	$platezhi_in_html = Platezh_to_html($str_beg_date, $sum_kred, $col_month, $proc, $arr_all_platezh);

	// Выводим html-код, который вернется через Ajax и будет послан во всплывающее окно
	echo $platezhi_in_html;

	// Added by SA 20171006
	// AP 20170: Весь код перенес в функцию Platezh_to_html

    /*
    echo "<form  target='_blank' method='post' action='pdf_xls.php'>";
	echo "<input type='hidden' name='type_platezh' value=$type_platezh>";
	echo "<input type='hidden' name='sum_kred' value=$sum_kred>";
	echo "<input type='hidden' name='str_beg_date' value=$str_beg_date>";
	echo "<input type='hidden' name='col_month' value=$col_month>";
	echo "<input type='hidden' name='proc' value=$proc>";

	if ($type_platezh == 'flex') {
		foreach($_POST['flex_payment_schedule'] as $flex_payment) {
		    echo "<input type='hidden' name='flex_payment_schedule[]' value=$flex_payment>";	
		}
	}	
	echo '<input class="col-xs-6 btn btn-primary" type="submit" id="btnShowPaymentSchedule" name="pdf" value="Сохранить отчет в PDF">';
	echo '<input class="col-xs-6 btn btn-primary" type="submit" id="btnShowPaymentSchedule" name="xls" value="Сохранить отчет в Excel">';
	echo '</form>';
	*/
 ?>
