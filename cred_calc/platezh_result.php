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
		$platezh_type = $_POST['platezh_type'];
		$str_beg_date = $_POST['str_beg_date'];
		$sum_kred = $_POST['sum_kred'];
		$col_month = $_POST['col_month'];
		$proc = $_POST['proc'];
		
		#annuit("05.08.2017", 100000, 12, 5.3);
		#$arr_all_platezh = annuit("05.08.2017", 150, 36, 2);
		if ($platezh_type == 'annuit') {
			$arr_all_platezh = Annuit($str_beg_date, $sum_kred, $col_month, $proc);
			$platezhi_in_html = Platezh_to_html('annuit', $str_beg_date, $sum_kred, $col_month, $proc, $arr_all_platezh);
		}
		elseif ($platezh_type == 'differ') {
			$arr_all_platezh = Differ($str_beg_date, $sum_kred, $col_month, $proc);
			$platezhi_in_html = Platezh_to_html('differ', $str_beg_date, $sum_kred, $col_month, $proc, $arr_all_platezh);
		}
			
		echo $platezhi_in_html;
		echo '<hr><p>';
		echo '<a href="./annuit.php">Назад в кредитный калькулятoр</a></p>';
	?>
  </body>
</html>