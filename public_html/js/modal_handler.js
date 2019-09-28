function id_ploshadki2(sev) {
	var phone = sev.match(/\+7\s\(\d{3}\)\s\d{3}-\d{2}-\d{2}/);
	console.log('***' + phone + '***');
	var phone_id_map = {
		'+7 (495) 150-70-69': '223429',
		'+7 (499) 288-24-67': '223427',
		'+7 (499) 288-84-58': '223425',
		'+7 (495) 116-71-39': '224793',
		'+7 (495) 116-99-75': '224795',
		'+7 (495) 116-83-60': '224797',
		'+7 (495) 126-34-17': '224799',
		'+7 (495) 116-96-75': '224801',
		'+7 (495) 116-70-34': '224805',
		'+7 (495) 116-96-26': '224809',
		'+7 (495) 126-18-40': '224811',
	};
	var id_ploshadki = phone_id_map[phone];
	console.log('***' + id_ploshadki + '***');
	return id_ploshadki;
}

function triggerComagic(phone_field) {
	var sev2 = $("#sev").html();
	
	if (window.ComagicWidget) {
		var t = +new Date() + 10000;
		var id_ploshadki = id_ploshadki2(sev2);
		yaCounter33503593.reachGoal('mango_perezvon');
		ComagicWidget.sitePhoneCall({
			phone: phone_field.val(),
			group_id: id_ploshadki,
			delayed_call_time: t.toString()
		});
	}
	console.log('отправлено');
}

function validateNameAndPhone(name_field, phone_field) {
	let phone_test = /\+7\(\d{3}\)\d{3}-\d{2}-\d{2}/;
	let name_test = /[\da-zA-Z]/;
	
	if (!name_field.val() || name_test.test(name_field.val())) {
		name_field.addClass('red_border');
		console.log("Ошибка в имени 1");
		return false;
	}
	else {
		name_field.removeClass('red_border');
		// console.log("Имя верное");
	}
	if (!phone_test.test(phone_field.val())) {
		phone_field.addClass('red_border');
		console.log("Ошибка в телефоне 1");
		return false;
	}
	else {
		phone_field.removeClass('red_border');
		// console.log("Телефон верный");
	}
	return true;
}

$(document).ready(function () {
	$(".phone-field").mask("+7(999)999-99-99");
	
	setTimeout(() => {
		$(".baner-wraper").slideDown();
	}, 40000);
	
	$('.callback-form').submit(function (e) {
		e.preventDefault();
		let name_field = $(this).find('input[name=name]');
		let phone_field = $(this).find('input[name=phone]');
		let subject = $(this).find('.callback-modal-title').html();
		
		if (!validateNameAndPhone(name_field, phone_field)) {
			return false;
		}
		triggerComagic(phone_field);
		$.ajax({
			url: '/mail/callback/',
			type: 'POST',
			data: {name: name_field.val(), phone: phone_field.val(), subject: subject},
			dataType: 'json',
			success: (data) => {
				if (data.status) {
					alert(data.msg);
					$('.modal-close-action').click();
					// name_field.val('');
					// phone_field.val('');
				}
				else {
					alert("Возникли ошибки:\n - " + data.errors.join("\n - "));
				}
			},
			error: (e) => {
				console.log(e);
				alert("Произошла ошибка")
			}
		});
	});
	
	$(document).mouseup(function (e) {
		var mymodal = $(".mymodal-body");
		if (mymodal.has(e.target).length === 0) {
			$('.mymodal-wrap').slideUp();
		}
	});
	$('.modal-close-action').click(function (event) {
		$(this).parent().parent().slideUp();
	});
	$('.open_modal').click(function (event) {
		event.preventDefault();
		let title = $(this).data('title');
		if (title) {
			$('.callback-modal-title').html(title);
		}
		$('.mymodal-wrap').slideDown();
	});
});