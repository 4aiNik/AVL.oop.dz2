$(document).ready(function(){
	$('#newsAdd').on('click', function(){
		event.preventDefault();

		$('.formForNews').show();
	});

	$('#newsButton').on('click', function(){
		event.preventDefault();
		var newsTitle = $(this).closest('form').find('#newsTitle').val();
		var newsText = $(this).closest('form').find('#newsText').val();
		var newsTags = $(this).closest('form').find('#newsTags').val();

		if (newsTitle.length || newsText.length || newsTags.length) {
			$.post(MAIN + 'news/add/', {newsTitle: newsTitle, newsText: newsText, newsTags: newsTags}, function(data){
				console.log(data['error'] + ' ' + data['text'] + ' ' + data['type']);
				//location.reload();
			}, 'json');
		} else {
			alert('поля пустые');
		}
	})
});