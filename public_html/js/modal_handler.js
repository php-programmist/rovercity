function validateNameAndPhone(name_field, phone_field) {
	let phone_test =/\+7\(\d{3}\)\d{3}-\d{2}-\d{2}/;
	let name_test =/[\da-zA-Z]/;
	
	if (!name_field.val() || name_test.test(name_field.val())) {
		name_field.addClass('red_border');
		console.log("Ошибка в имени");
		return false;
	}
	else{
		name_field.removeClass('red_border');
		console.log("Имя верное");
	}
	if (!phone_test.test(phone_field.val())) {
		phone_field.addClass('red_border');
		console.log("Ошибка в телефоне");
		return false;
	}
	else{
		phone_field.removeClass('red_border');
		console.log("Телефон верный");
	}
	return true;
}

$(document).ready(function() {
	$(".phone-field").mask("+7(999)999-99-99");
	
	$('#callback-form').submit( (e) => {
		e.preventDefault();
		let name_field = $('#callback-name');
		let phone_field = $('#callback-phone');
		let subject = $('.callback-modal-title').html();
		
		if (!validateNameAndPhone(name_field, phone_field)) {
			return false;
		}
		$.ajax({
			url:'/mail/callback/',
			type:'POST',
			data:{name:name_field.val(),phone:phone_field.val(),subject:subject},
			dataType: 'json',
			success:(data)=>{
				if (data.status) {
					alert(data.msg);
					$('.mymodal-close').click();
					// name_field.val('');
					// phone_field.val('');
				}
				else{
					alert("Возникли ошибки:\n - "+data.errors.join("\n - "));
				}
			},
			error:(e)=>{
				console.log(e);
				alert("Произошла ошибка")
			}
		});
	});
});