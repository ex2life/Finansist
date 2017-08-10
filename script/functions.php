<?php

//---------------------------------------------------------------------
// Добавление одного или нескольких календарных месяцев к TIMESTAMP
//---------------------------------------------------------------------
function Add_month($time, $num=1) {
    $d=date('j',$time);  // день
    $m=date('n',$time);  // месяц
    $y=date('Y',$time);  // год
 
    // Прибавить месяц(ы)
    $m+=$num;
    if ($m>12) {
        $y+=floor($m/12);
        $m=($m%12);
        // Дополнительная проверка на декабрь
        if (!$m) {
            $m=12;
            $y--;
        }
    }
    // Это последний день месяца?
    if ($d==date('t',$time)) {
        $d=31;
    }
    // Открутить дату, пока она не станет корректной
    while(true) {
        if (checkdate($m,$d,$y)){
            break;
        }
        $d--;
    }
    // Вернуть новую дату в TIMESTAMP
    return mktime(0,0,0,$m,$d,$y);
}


//---------------------------------------------------------------------
// Расчет графика платежей по разным схемам.
// Возвращает массив с типом, датами и суммами платежей.
//---------------------------------------------------------------------
function Payment_Schedule($type_platezh, $str_beg_date, $sum_kred, $col_month, $proc) 
{
	/*
	$type_platezh ={'annuit', 'differ'}
	echo "<p>Начальная дата: {$beg_date}</p>";
	echo "<p>Сумма кредита: {$sum_kred}</p>";
	echo "<p>Количество месяцев: {$col_month}</p>";
	echo "<p>Процент: {$proc}</p>";
	*/
	
	$sum_kred = round((float)$sum_kred, 2);
	$proc = round((float)$proc, 2);
	$col_month = (int)($col_month);
	
	$arr_all_platezh = array();
	
	$beg_date = strtotime($str_beg_date);
	
	$platezh_next_date = $beg_date;
	$ostatok_dolg = $sum_kred;
	$month_proc = ($proc/100)/12; #месячный процент
	
	if ($type_platezh == 'annuit') {
		$platezh = $sum_kred*($month_proc + $month_proc /(pow(1+$month_proc, $col_month)-1));
		$platezh = round($platezh,2); #ежемесячный платеж
	}
	elseif ($type_platezh == 'differ') {
		$platezh_main_dolg = $sum_kred/$col_month; 
		$platezh_main_dolg = round((float)$platezh_main_dolg, 2); #ежемесячное погашение основного долга
		$platezh = $sum_kred*($month_proc + $month_proc /(pow(1+$month_proc, $col_month)-1));
		$platezh = round($platezh,2); #ежемесячный платеж
	}
	
	for ($nomer_platezh=1; $nomer_platezh<=$col_month; $nomer_platezh++) {
		$ostatok_dolg_0 = $ostatok_dolg; #остаток основного долга до очередного погашения
		$platezh_proc = $ostatok_dolg*$month_proc;
		$platezh_proc = round($platezh_proc,2); #погашение процентов
		
		if ($type_platezh == 'annuit') {
			$platezh_main_dolg = $platezh - $platezh_proc;
			$ostatok_dolg = $ostatok_dolg - $platezh_main_dolg; #остаток основного долга после очередного погашения
		}
		elseif ($type_platezh == 'differ') {
			$platezh = $platezh_main_dolg + $platezh_proc;
			$ostatok_dolg = $ostatok_dolg - $platezh_main_dolg; #остаток основного долга после очередного погашения
		}
		
		$platezh_date = $platezh_next_date;
		$str_platezh_date = date("d.m.Y", $platezh_date);
		$platezh_next_date = Add_month($platezh_date);
		
		# Корректировка последнего платежа
		if ($nomer_platezh == $col_month) {
			if ($ostatok_dolg != 0) {
				$platezh_proc = $ostatok_dolg_0*$month_proc;
				$platezh_proc = round($platezh_proc,2); #погашение процентов
				$platezh_main_dolg = $ostatok_dolg_0;
				$platezh = $platezh_proc + $platezh_main_dolg;
				$ostatok_dolg = 0.00;
			}
		}
			
		$arr_platezh = array('type_platezh' => $type_platezh,
						'nomer' => $nomer_platezh,
						'date' => $str_platezh_date,
						'ostatok_0' => $ostatok_dolg_0,
						'platezh' => $platezh,
						'platezh_proc' => $platezh_proc,
						'platezh_main_dolg' => $platezh_main_dolg,
						'ostatok' => $ostatok_dolg);
		$arr_all_platezh[] = $arr_platezh;
	}

	return $arr_all_platezh;
}

//---------------------------------------------------------------------
// Формирование html-кода для графика платежей
//---------------------------------------------------------------------
function Platezh_to_html($str_beg_date, $sum_kred, $col_month, $proc, $arr_all_platezh) 
{
	$type_platezh = $arr_all_platezh[0]['type_platezh'];
	
	$str_out = "<p>Вид платежа: ";
	if ($type_platezh == 'annuit') 
		$str_out .= "<strong>Аннуитетный платеж</strong></p>";
	elseif ($type_platezh == 'differ') 
		$str_out .= "<strong>Дифференцированный платеж</strong></p>";
	$str_sum_kred = number_format($sum_kred, 2, '.', ' ');
	$str_proc = number_format($proc, 2, '.', ' ');
	$str_out .= "<p>Сумма кредита: <strong>$str_sum_kred</strong> руб.<br>";
	$str_out .= "Процентная ставка: <strong>$str_proc</strong> %<br>";
	$str_out .= "Срок кредита (мес): <strong>$col_month</strong> </p>";
	
	$str_out .= "<table class=\"platezh_table\">\n";
	$str_out .= "<tr class=\"platezh_table_header\"><th>N</th><th>Дата</th><th>Сумма платежа</th><th>Погашение основного долга</th><th>Погашение процентов</th><th>Остаток основного долга</th></tr>";
	
	$total_platezh = $total_platezh_main_dolg = $total_platezh_proc = 0;
	
	foreach ($arr_all_platezh as $arr_platezh) {
		$str_platezh = number_format($arr_platezh['platezh'], 2, '.', ' ');
		$str_platezh_main_dolg = number_format($arr_platezh['platezh_main_dolg'], 2, '.', ' ');
		$str_platezh_proc = number_format($arr_platezh['platezh_proc'], 2, '.', ' ');
		$str_ostatok = number_format($arr_platezh['ostatok'], 2, '.', ' ');
		$str_out .= "<tr><td>".$arr_platezh['nomer']."</td><td>".$arr_platezh['date']."</td><td>".$str_platezh."</td>";
		$str_out .= "<td>".$str_platezh_main_dolg."</td><td>".$str_platezh_proc."</td><td>".$str_ostatok."</td></tr>";
		$total_platezh += $arr_platezh['platezh'];
		$total_platezh_main_dolg += $arr_platezh['platezh_main_dolg'];
		$total_platezh_proc += $arr_platezh['platezh_proc'];
	}
	$str_total_platezh = number_format($total_platezh, 2, '.', ' ');
	$str_total_platezh_main_dolg = number_format($total_platezh_main_dolg, 2, '.', ' ');
	$str_total_platezh_proc = number_format($total_platezh_proc, 2, '.', ' ');
	$str_out .= "<tr class=\"platezh_table_footer\"><td></td><td>Итого</td><td>$str_total_platezh</td><td>$str_total_platezh_main_dolg</td>";
	$str_out .= "<td>$str_total_platezh_proc</td><td></td></tr>";
	$str_out .= "</table>\n";
	return $str_out;
}
?>