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
		$str_beg_date = $_POST['str_beg_date'];
		$sum_kred = $_POST['sum_kred'];
		$col_month = $_POST['col_month'];
		$proc = $_POST['proc'];
		
		$arr_all_platezh = Payment_Schedule($type_platezh, $str_beg_date, $sum_kred, $col_month, $proc);
		$platezhi_in_html = Platezh_to_html($str_beg_date, $sum_kred, $col_month, $proc, $arr_all_platezh);
		
		echo $platezhi_in_html;
		echo '<hr><p>';
		if ($platezh_type == 'annuit')
			echo '<a href="./platezh_param.php?type_platezh=annuit">Назад в кредитный калькулятoр</a></p>';
		elseif ($platezh_type == 'differ')
			echo '<a href="./platezh_param.php?type_platezh=differ">Назад в кредитный калькулятoр</a></p>';
	?>
  </body>
</html>