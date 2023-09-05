(function ($) {
    // "use strict";
	$(document).ready(function () {
		// Perform AJAX login/register on form submit
		$('#login-show form#login, #popup-register form#register, #register-show form#register').on('submit', function (e) {
			if (!$(this).valid()) return false;
			$('div.status', this).show().html(ajax_account_object.loadingmessage).css("margin-bottom","15px");
			action = 'ajaxlogin';
			username = 	$('form#login #username').val();
			password = $('form#login #password').val();
			email = '';
			security = $('form#login #security').val();
			if ($(this).attr('id') == 'register') {
				action = 'ajaxregister';
				username = $('#reg_username').val();
				password = $('#reg_password').val();
				email = $('#reg_email').val();
				security = $('#signonsecurity').val();
			}
			ctrl = $(this);
			$.ajax({
				type: 'POST',
				dataType: 'json',
				url: ajax_account_object.ajaxurl,
				data: {
					'action': action,
					'username': username,
					'password': password,
					'email': email,
					'security': security
				},
				success: function (data) {
					$('div.status', ctrl).html(data.message);
					if (data.loggedin == true) {
						document.location.href = ajax_account_object.redirecturl;
					}
				}
			});
			e.preventDefault();
		});
	})
})(jQuery);