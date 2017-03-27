$(document).ready(function(){
	$('.regButton').on('click', function(){
		event.preventDefault();

		var login = $(this).closest('form').find('.userLogin').val();
		var pass  = $(this).closest('form').find('.password').val();
		var name  = $(this).closest('form').find('.userName').val();
		var surname  = $(this).closest('form').find('.userSurname').val();

		if (login.length && pass.length) {
			// alert(login + pass + name + surname);
			$.post(MAIN + 'enterReg/', {login:login, pass:pass, name:name, surname:surname}, function(data){
				if(data['error']) {

					$('.result').html(data['text'] + ' ' + data['type']);
				} else {
					location.reload();
				}
			}, 'json');
		} else {
			$('.result').html('нет логина или пароля');
		}
	})
});