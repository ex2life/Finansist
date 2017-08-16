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
  </head>
	
  <body>
    <header>
		<h3>График платежей по кредиту</h3>
	</header>
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
		
		echo $platezhi_in_html;
		echo '<hr><p>';
		if ($type_platezh == 'annuit')
			echo '<a href="./platezh_param.php?type_platezh=annuit">Назад в кредитный калькулятoр</a></p>';
		elseif ($type_platezh == 'differ')
			echo '<a href="./platezh_param.php?type_platezh=differ">Назад в кредитный калькулятoр</a></p>';
		elseif ($type_platezh == 'flex')
			echo '<a href="./platezh_param.php?type_platezh=flex">Назад в кредитный калькулятoр</a></p>';
	?>

	<div id="text-popup" class="white-popup mfp-hide">
	<p>С другой стороны постоянное информационно-пропагандистское обеспечение нашей деятельности позволяет оценить значение направлений прогрессивного развития.</p>
	</div>

  </body>
</html>