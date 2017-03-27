$(document).ready(function(){
	$('.authButton').on('click', function(){

		event.preventDefault();

		var login = $(this).closest('form').find('.userLogin').val();
		var pass  = $(this).closest('form').find('.password').val();

		if (login.length && pass.length) {
			$.post(MAIN + 'enterAuth/', {login: login, pass:pass}, function(data){
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