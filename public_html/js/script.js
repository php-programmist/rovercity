$('.menubtn').click(function (event) {
	$('.header-menu2').slideToggle(1000);
});
var headertop = $('.header-fix1').height();
var h2 = $('.header-menu2').height();
$(window).scroll(function () {
	if ($(window).width() > 767) {
		if ($(window).scrollTop() > headertop) {
			$('.header-menu1').css({display: 'none'});
			$('.vip-menu-block').css({top: '102px'});
		}
		else {
			$('.header-menu1').css({display: 'block'});
			$('.vip-menu-block').css({top: '137px'});
			
		}
	}
});
$('.card-wrap').slick({
	infinite: true,
	slidesToShow: 4,
	slidesToScroll: 4,
	responsive: [
		{
			breakpoint: 1599,
			settings: {
				slidesToShow: 3,
				slidesToScroll: 3
			}
		},
		{
			breakpoint: 991,
			settings: {
				slidesToShow: 2,
				slidesToScroll: 2
			}
		},
		{
			breakpoint: 767,
			settings: {
				slidesToShow: 1,
				slidesToScroll: 1
			}
		}
	]
	
	
});
$(document).ready(function () {
	//прикрепляем клик по заголовкам acc-head
	$('.uslugi-wrap .usluga-btn').on('click', f_acc);
	
	!function (i) {
		var o, n;
		i(".title_block").on("click", function () {
			o = i(this).parents(".accordion_item"), n = o.find(".info"),
				o.hasClass("active_block") ? (o.removeClass("active_block"),
					n.slideUp()) : (o.addClass("active_block"), n.stop(!0, !0).slideDown(),
					o.siblings(".active_block").removeClass("active_block").children(
						".info").stop(!0, !0).slideUp())
		})
	}(jQuery);
});

function f_acc() {
//скрываем все кроме того, что должны открыть
	$('.uslugi-wrap .usluga-body').not($(this).next()).slideUp();

// открываем или скрываем блок под заголовком, по которому кликнули
	$(this).next().slideToggle(1000);
}

$('.slider-for1').slick({
	slidesToShow: 1,
	slidesToScroll: 1,
	fade: true,
	asNavFor: '.slider-nav1',
	responsive: [
		{
			breakpoint: 567,
			settings: {
				fade: false
			}
		}
	]
});
$('.slider-nav1').slick({
	slidesToShow: 4,
	slidesToScroll: 1,
	asNavFor: '.slider-for1',
	dots: false,
	arrows: false,
	centerMode: false,
	focusOnSelect: true,
	responsive: [
		{
			breakpoint: 767,
			settings: {
				slidesToShow: 3
			}
		}
	]
	
});

$('.footslider').slick({
	infinite: true,
	slidesToShow: 5,
	centerMode: false,
	slidesToScroll: 1,
	responsive: [
		{
			breakpoint: 1599,
			settings: {
				slidesToShow: 4,
				slidesToScroll: 1
			}
		},
		{
			breakpoint: 991,
			settings: {
				slidesToShow: 3,
				slidesToScroll: 1
			}
		},
		{
			breakpoint: 767,
			settings: {
				slidesToShow: 2,
				slidesToScroll: 1
			}
		},
		{
			breakpoint: 567,
			settings: {
				slidesToShow: 1,
				slidesToScroll: 1
			}
		}
	]
	
	
});


$('.otziv-slider-block').click(function (event) {
	
	if ($(window).width() > 992) {
		$('.bigslider-foot-wrap').slideToggle(400);
		$('.header').slideToggle(400);
		$('.bigslider-foot-for').slick({
			slidesToShow: 1,
			slidesToScroll: 1
		});
	}
});
$('.bigslider-foot-close').click(function (event) {
	$('.bigslider-foot-wrap').hide(400);
	$('.header').slideToggle(400);
});
$(document).mouseup(function (e) {
	var bs = $(".bigslider-for");
	if (bs.has(e.target).length === 0) {
		$('.bigslider-wrap').hide();
	}
});

$('.rab-slider-block').click(function (event) {
	if ($(window).width() > 992) {
		$('.bigslider-rab-wrap').slideToggle(400);
		$('.header').slideToggle(400);
		$('.bigslider-rab-for').slick({
			slidesToShow: 1,
			slidesToScroll: 1
		});
	}
});
$('.bigslider-rab-close').click(function (event) {
	$('.bigslider-rab-wrap').slideToggle(400);
	$('.header').slideToggle(400);
});

$('.seobtn').click(function (event) {
	$('.seo-none').slideToggle(400);
	$('.seobtn').slideToggle(4);
	
});

$(document).mouseup(function (e) {
	var mymodal = $(".mymodal-body");
	if (mymodal.has(e.target).length === 0) {
		$('.mymodal-wrap').hide();
	}
});
$('.mymodal-close').click(function (event) {
	$('.mymodal-wrap').hide();
});
$('.open_modal').click(function (event) {
	event.preventDefault();
	let title = $(this).data('title');
	if (title) {
		$('.callback-modal-title').html(title);
	}
	$('.mymodal-wrap').slideToggle(1);
});
