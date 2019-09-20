$(document).ready(function () {
	$("input").on('input propertychange', function(e){
    	e.preventDefault();

    	var from = $('select.others-group').children("option:selected").text();
    	var to = 'UZS';
    	var amount = $('#input-one').val();

		endpoint = 'latest';
		access_key = 'a77ce158752393317cef33a608245383';

		// execute the conversion using the "convert" endpoint:
		$.ajax({
		    url: 'http://data.fixer.io/api/' + endpoint + '?access_key=' + access_key +'&from=' + from + '&to=' + to + '&amount=' + amount,   
		    dataType: 'jsonp',
		    success: function(json) {
		        console.log(json);
		    }
		});
	});

	$('#send-btn').on('click', function(e){
		e.preventDefault();
		sendAjaxForm('comment', '/api/comment');
		$('.area').val('');
		
	});

	function sendAjaxForm(ajax_form, url) {
    $.ajax({
        url:     url, //url страницы
        type:     "POST", //метод отправки
        dataType: "html", //формат данных
        data: $("#"+ajax_form).serialize(),  // Сеарилизуем объект
        success: function(response) { //Данные отправлены успешно
        	// console.log();
        	data = JSON.parse(response);
        	if (response) {
        		var str = '<footer class="comment-meta" style="margin-bottom: 20px;">';
				str+= '<div class="comment-author vcard">';
				str+= '<img alt="" src="" class="avatar avatar-32 photo" height="32" width="32">';
				str+= '<b class="fn"> '+data['user']['email']+' </b> <span class="says">izohi:</span>';
				str+= '</div>';
				str+= '<div class="comment-metadata">';
				str+= '<a href="https://lifehaq.uz/nega-yoshimiz-ulg-aygan-sari-do-stlarimizni-yo-qotib-boramiz/#comment-34">';
				str+= '<time> '+data['created_at']+' </time>';
				str+= '</a>';
				str+= '</div>';
				str+= '<em class="comment-awaiting-moderation">'+data['content']+'</em>';
				str+= '</footer>';
				str+= '<hr>';
				$('#place').prepend(str);
        	}
        	
        },
    	error: function(response) { // Данные не отправлены
    		alert(response);
    	}
 	});
}

});