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
	$arr_all_platezh = Payment_Schedule($type_platezh, $str_beg_date, $sum_kred, $col_month, $proc, $arr_payments);
	$platezhi_in_html = Platezh_to_html($str_beg_date, $sum_kred, $col_month, $proc, $arr_all_platezh);
	
	echo '<h3>График платежей по кредиту</h3>';
	echo $platezhi_in_html;
?>
