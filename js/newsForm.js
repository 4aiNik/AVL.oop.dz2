$(document).ready(function(){
	$('#newsAdd').on('click', function(){
		event.preventDefault();
		
		$('#newsTitle').val('');
		$('#newsText').val('');
		$('#newsTags').val('');

		if (!$('#newsButton').length) {
			$('#newsEdit').remove();
			$('.formForNews').append('<input type="submit" id="newsButton" value="добавить">');
		}
		$('.formForNews').toggle();
	

		$('#newsButton').on('click', function(){
			event.preventDefault();
			var newsTitle = $('#newsTitle').val();
			var newsText = $('#newsText').val();
			var newsTags = $('#newsTags').val();
	
			if (newsTitle.length || newsText.length || newsTags.length) {
				$.post(MAIN + 'news/add/', {newsTitle: newsTitle, newsText: newsText, newsTags: newsTags}, function(data){
					// console.log(data['error'] + ' ' + data['text'] + ' ' + data['type']);
					//location.reload();
				}, 'json');
			} else {
				alert('поля пустые');
			}
		});
	});

	$('.newsEdit').on('click', function(){
		event.preventDefault();
		
		var newsId = '';
		newsId = $(this).data('item');

		var title = $($('.newsEdit[data-item=' + newsId + ']').closest('tr').children()[0]).text();
		var text = $($('.newsEdit[data-item=' + newsId + ']').closest('tr').children()[3]).text();
		var tags = $($('.newsEdit[data-item=' + newsId + ']').closest('tr').children()[4]).text();

		$('#newsTitle').val('');
		$('#newsText').val('');
		$('#newsTags').val('');

		$('#newsTitle').val(title);
		$('#newsText').val(text);
		$('#newsTags').val(tags);

		if (!$('#newsEdit').length) {
			$('#newsButton').remove();
			$('.formForNews').append('<input type="submit" id="newsEdit" value="редактировать">');
		}
		$('.formForNews').toggle();

		$('#newsEdit').on('click', function(){
			event.preventDefault();
			
			var newTitle = $('#newsTitle').val();
			var newText = $('#newsText').val();
			var newTags = $('#newsTags').val();

			if (newTitle.length || newText.length || newTags.length) {

				$.post(MAIN + 'news/edit/' + newsId + '/', {newTitle: newTitle, newText: newText, newTags: newTags}, function(data){
					// console.log(data['error'] + ' ' + data['text'] + ' ' + data['type']);
					//location.reload();
				}, 'json');
			} else {
				alert('поля пустые');
			}

		});
	});
});
