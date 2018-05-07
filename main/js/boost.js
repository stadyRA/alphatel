$(document).ready(function () {
	$("#send_form").submit(validation);
}); 
function showError(text) {
	var element = $('<div class="alert alert-error"><strong>Ошибка!</strong><br />' + text + '</div>').prependTo('.massege');
	setTimeout(function() {
		element.fadeOut(500, function() {
			$(this).remove();
		});
	}, 5000);
}
function showWarning(text) {
	var element = $('<div class="alert"><strong>Предупреждение!</strong><br />' + text + '</div>').prependTo('.massege');
	setTimeout(function() {
		element.fadeOut(500, function() {
			$(this).remove();
		});
	}, 5000);
}
function showSuccess(text) {
	var element = $('<div class="alert alert-success"><strong>Поздравляем!</strong><br />' + text + '</div>').prependTo('.massege');
	setTimeout(function() {
		element.fadeOut(500, function() {
			$(this).remove();
		});
	}, 5000);
}
function redirect(url) {
	document.location.href=url;
}
function validation() {
	$.ajax({
		url: 'ajax.php',
		dataType : "json",
		type: "POST",
		data: { 
			act: "validation", 
			ip: $("#ip").val(),
			key: $("#key").val()			
		},
		success: function(data) {
			switch(data.status) {
				case 'error':
					showError(data.result);
					$('input[type=submit]').prop('disabled', false);
					break;
				case 'success':
					showSuccess(data.result);
					setTimeout("redirect(location.href)", 3000);
					break;
			}
		},
		beforeSend: function(){
			$('input[type=submit]').prop('disabled', true);
		},
		complete: function(){
			$("#ip").val('');
			$("#key").val('');
		}		
	});
	return false;
}