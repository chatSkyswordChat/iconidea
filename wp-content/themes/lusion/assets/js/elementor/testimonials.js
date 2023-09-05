(function ($) {
    "use strict";
	var $rtl = false;
	if (lusion_params.lusion_rtl == 'yes') {
		$rtl = true;
	}
    function lusionTestimonial() {
		$('.slider-banner .elementor-widget-wrap').slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			centerPadding: '29.19%',
			centerMode: true,
			dots: false,
			rtl: $rtl,
			arrows: true,
			nextArrow: '<button class="btn-next"><i class="theme-icon-next"></i></button>',
			prevArrow: '<button class="btn-prev"><i class="theme-icon-back"></i></button>',
			infinite: true,
			responsive: [
				{
					breakpoint: 1024.2,
					settings: {
						centerPadding: '12%'
					}
				},
				{
					breakpoint: 767.2,
					settings: {
						centerPadding: '0'
					}
				},
			]
		});
		$('.slide-top-cate .elementor-row').slick({
			slidesToShow: 3,
			slidesToScroll: 1,
			dots: false,
			rtl: $rtl,
			arrows: true,
			nextArrow: '<button class="btn-next"><i class="theme-icon-next"></i></button>',
			prevArrow: '<button class="btn-prev"><i class="theme-icon-back"></i></button>',
			infinite: true,
			responsive: [
				{
					breakpoint: 767.2,
					settings: {
						slidesToShow: 2
					}
				},
				{
					breakpoint: 480.2,
					settings: {
						slidesToShow: 1
					}
				},
			]
		});
    }
    $(document).ready(function () {  
        lusionTestimonial();
    });
})(jQuery);