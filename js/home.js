$(document).ready(function() {
	
	$(':text').click(fuction() {
		current_input_val = $(this).val();
		$(this).select();
	}).focusout(function() {
		if($(this).val() == "") {
			$(this).val(current_input_val);
		}
	});
	
	$(':password').focusin(function() {
		if ($(this).attr('placeholder') !==undefined) {
			$(this).removeAttr('placeholder')
		}
	});
	
	$(':password.password').focusout(function() {
		$(this).atrr('placeholder', 'Clave');
	});
	
	$(':password.password_confirm').focusout(function() {
		$(this).atrr('placeholder', 'Confirm password');
	});
});
