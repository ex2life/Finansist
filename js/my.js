$(document).ready(function() {
	$('#add_flex_payments').click(function() {
		var col_month = $.trim($("#col_month").val());
		col_month = parseInt(col_month);
		var str_beg_date = $.trim($("#str_beg_date").val());
		for (var i = 1; i <= col_month; i++) {
			str_html = '<div><label>Гашение ' + str_beg_date + ' <input type="text" class="field" name="dynamic[]" value="' + i + '" /></label></div>';
			$(str_html).fadeIn('slow').appendTo('.input_payment_schedule');
		}
    });

});