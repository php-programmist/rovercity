$(document).ready(function() {
	$('.calc-head-marka').click(function(e){
		e.preventDefault();
		if ($(this).hasClass('marka-activ')) {
			return false;
		}
		$('.calc-head-marka').removeClass('marka-activ');
		$(this).addClass('marka-activ');
		let image = $(this).data('img');
		$('#calc_brand_img').attr('src',image);
		$('#brand_name').val($(this).html());
	});
});