function Make_flex_payment_schedule() {
	var col_month = $.trim($("#col_month").val());
	col_month = parseInt(col_month, 10);
	var str_date = $.trim($("#str_beg_date").val()),
		str_month = str_date.substr(0,2),
		str_year = str_date.substr(3,4);
	var month = parseInt(str_month, 10),
		year = parseInt(str_year, 10);
		
	//Начинаем платить со следующего месяца после взятия кредита
	if (month == 12) {
		month = 1;
		year++;
	}
	else
		month++;
	
	var str_html = "<div></div>";
	for (var i = 1; i <= col_month; i++) {
		str_month = (month < 10) ? "0" + month : month.toString();
		str_date = str_month + '.' + year;
		str_html += '<div><label>Гашение ' + str_date;
		//Проверку значения через pattern сделать не получилось, все время ругается на неправильный формат
		//str_html += ' <input type="text" name="flex_payment_schedule[]" value="0" pattern="^\d+(\.\d{1,2})?$"/>';
		str_html += ' <input type="text" name="flex_payment_schedule[]" value="0"/>';
		str_html += '</label></div>';
		//$(str_html).fadeIn('slow').appendTo('.input_payment_schedule');
		
		if (month == 12) {
			month = 1;
			year++;
		}
		else
			month++;
	}
	$("#input_payment_schedule").html(str_html);

}

$(document).ready(function() {
	//console.log("ffffff");
	
	if ($.trim($("#type_platezh").val()) == "flex")
		Make_flex_payment_schedule();
	
	$('#str_beg_date').change(function() {
		if ($.trim($("#type_platezh").val()) == "flex")
			Make_flex_payment_schedule();
	});

	$('#col_month').change(function() {
		if ($.trim($("#type_platezh").val()) == "flex")
			Make_flex_payment_schedule();
	});
	
	$('.popup-content').magnificPopup({
        type: 'inline'
    });	
	
	
	$('#btnShowPaymentSchedule').click(function(){
		var data = $("#frmPlatezhParam :input").serialize();
		$.post($("#frmPlatezhParam").attr('action'), data, function(html_reply){
			alert(html_reply);
			/*
			if (json.status == "fail") {
				alert(json.message);
			}
			if (json.status == "success") {
				alert(json.message);
			}
			*/
		}
		)
		//alert("1111111111111");
	});

	$('#frmPlatezhParam').submit(function() {
		return false;
	}
	);
	
	/*
	$('#add_flex_payments').click(function() {
		if ($.trim($("#type_platezh").val()) == "flex")
			Make_flex_payment_schedule();
    });
	*/
});