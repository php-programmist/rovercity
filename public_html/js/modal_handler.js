function validateNameAndPhone(name_field, phone_field) {
	let phone_test =/\+7\(\d{3}\)\d{3}-\d{2}-\d{2}/;
	let name_test =/[\da-zA-Z]/;
	
	if (!name_field.val() || name_test.test(name_field.val())) {
		name_field.addClass('red_border');
		 console.log("Ошибка в имени 1");
		return false;
	}
	else{
		name_field.removeClass('red_border');
		 // console.log("Имя верное");
	}
	if (!phone_test.test(phone_field.val())) {
		phone_field.addClass('red_border');
		 console.log("Ошибка в телефоне 1");
		return false;
	}
	else{
		phone_field.removeClass('red_border');
		 // console.log("Телефон верный");
	}
	
	////////////////////////////////////
	var sev2=document.getElementById("sev").innerHTML;
	
 
function id_ploshadki2(sev) {
	
	
				sev=sev.replace("<div>","");
				sev=sev.replace("</div>","");
				sev=sev.replace("<span>","");
				sev=sev.replace("</span>","");
				sev=sev.replace('<span style="color: rgb(0, 21, 50); text-shadow: none;">',"");
				sev=sev.trim();
				
				console.log ('***'+sev+'***');
									
         if(sev=='+7 (495) 150-70-69') {
						//alert('nizegor2');
						var id_ploshadki='223429';
   				 }
				 else if(sev=='+7 (499) 288-24-67') {
						//alert('lobn2');
						var id_ploshadki='223427';
   				 }
				 else if(sev=='+7 (499) 288-84-58') {
						//alert('lobn2');
						var id_ploshadki='223425';
   				 }
				 else if(sev=='+7 (495) 1167139') {var id_ploshadki='224793';}
				 
				 else if(sev=='+7 (495) 116-99-75') {var id_ploshadki='224795';}
				  else if(sev=='+7 (495) 116-83-60') {var id_ploshadki='224797';}
				   else if(sev=='+7 (495) 126-34-17') {var id_ploshadki='224799';}
				    else if(sev=='+7 (495) 116-96-75') {var id_ploshadki='224801';}
					 else if(sev=='+7 (495) 116-70-34') {var id_ploshadki='224805';}
					  else if(sev=='+7 (495) 116-96-26') {var id_ploshadki='224809';}
					   else if(sev=='+7 (495) 126-18-40') {var id_ploshadki='224811';}
					   
    return id_ploshadki;
};

			
			
	  if (window.ComagicWidget) {
var t = +new Date () + 10000;
var id_ploshadki = id_ploshadki2(sev2);
console.log('*'+id_ploshadki+'*'+sev2+'*');
            yaCounter33503593.reachGoal('mango_perezvon');
			ComagicWidget.sitePhoneCall({phone:phone_test.test(phone_field.val()), group_id: id_ploshadki, delayed_call_time: t.toString()});
		}
	///////////////////////////////////
	console.log('отправлено');
	return false;
	return true;
}

$(document).ready(function() {
	$(".phone-field").mask("+7(999)999-99-99");
	
	setTimeout(()=>{
		$(".baner-wraper").slideDown();
	},40000);
	
	$('.callback-form').submit( function(e)  {
		e.preventDefault();
		let name_field = $(this).find('input[name=name]');
		let phone_field = $(this).find('input[name=phone]');
		let subject = $(this).find('.callback-modal-title').html();
		
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
					$('.modal-close-action').click();
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