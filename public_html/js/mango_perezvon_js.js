function showHide_perezvon(element_id) {
	$(".phone_mask_perezvon").mask("(999) 999-99-99");
	//Если элемент с id-шником element_id существует
	if (document.getElementById(element_id)) {
		//alert("id: " + element_id + "");
		//Записываем ссылку на элемент в переменную obj
		var obj = document.getElementById(element_id);
		//Если css-свойство display не block, то:
		if (obj.style.display != "block") {
			obj.style.display = "block"; //Показываем элемент
			//alert("Элемент с id: " + element_id + " Показываем элемент!");
		}
		else obj.style.display = "none"; //Скрываем элемент
	}
	//Если элемент с id-шником element_id не найден, то выводим сообщение
	else alert("Элемент с id: " + element_id + " не найден!");
}

$(document).ready(function () {
	/*перозвонишка2 начало*/


//
	
	$('div.button-widget_perezvon').on('click', function () {
		//alert('1112');
		
		
		//Отправка Запроса
		
		
		phonezrr = $("#phoneperezvon").val();
		
		
		if (phonezrr.length < 7) {
			$('#phoneperezvon').css('border', '1px solid #FF0000');
			alert("заполните полое телефон, пожалуйста.");
		} else {
			//$('#phoneperezvon').css('border', '1px solid #B2B2B2');
		}
		
		
		if (phonezrr.length > 6) {
			
			$(this).html('Отправка...');
			$.post("/js_perezvon/zayavky_send.php",
				{phonezrr: '7' + phonezrr, do_thisss: 'perezvonishka'},
				function (data111s22122ddd2111) {
					
					
					var sev2 = document.getElementById("sev").innerHTML;
					
					
					function id_ploshadki2(sev) {
						
						
						sev = sev.replace("<div>", "");
						sev = sev.replace("</div>", "");
						sev = sev.replace("<span>", "");
						sev = sev.replace("</span>", "");
						sev = sev.replace('<span style="color: rgb(0, 21, 50); text-shadow: none;">', "");
						sev = sev.trim();
						
						//alert ('***'+sev+'***');
						
						if (sev == '+7 (495)  150-70-69') {
							//alert('nizegor2');
							var id_ploshadki = '223429';
						}
						else if (sev == '+7 (499) 288-24-67') {
							//alert('lobn2');
							var id_ploshadki = '223427';
						}
						else if (sev == '+7 (499) 288-84-58') {
							//alert('lobn2');
							var id_ploshadki = '223425';
						}
						else if (sev == '+7 (495) 1167139') {
							var id_ploshadki = '224793';
						}
						
						else if (sev == '+7 (495) 116-99-75') {
							var id_ploshadki = '224795';
						}
						else if (sev == '+7 (495) 116-83-60') {
							var id_ploshadki = '224797';
						}
						else if (sev == '+7 (495) 126-34-17') {
							var id_ploshadki = '224799';
						}
						else if (sev == '+7 (495) 116-96-75') {
							var id_ploshadki = '224801';
						}
						else if (sev == '+7 (495) 116-70-34') {
							var id_ploshadki = '224805';
						}
						else if (sev == '+7 (495) 116-96-26') {
							var id_ploshadki = '224809';
						}
						else if (sev == '+7 (495) 126-18-40') {
							var id_ploshadki = '224811';
						}
						return id_ploshadki;
					};
					
					
					if (window.ComagicWidget) {
						var t = +new Date() + 10000;
						var id_ploshadki = id_ploshadki2(sev2);
//alert('*'+id_ploshadki+'*'+sev2+'*');
						yaCounter33503593.reachGoal('mango_perezvon');
						ComagicWidget.sitePhoneCall({
							phone: phonezrr,
							group_id: id_ploshadki,
							delayed_call_time: t.toString()
						});
					}
					alert('Отправлено');
					showHide_perezvon('perethvon0');
					showHide_perezvon('perethvon');
					$('.button-widget_perezvon').html('Отправлено');
					$('#phoneperezvon').remove();
				}
			);
			
		}
		
		
	});
	/* перезвонишка2 конец*/
});