(function ($) {
    "use strict";
    var $rtl = false;
    if (lusion_params.lusion_rtl == 'yes') {
        $rtl = true;
    }
    $(document).ready(function () {
        $('.category-product-slider > div.elementor-container').slick({
            dots: false,
            arrows: true,
            nextArrow: '<button class="btn-next"><span class="theme-icon-next"></span></button>',
            prevArrow: '<button class="btn-prev"><span class="theme-icon-back"></span></button>',
            rtl: $rtl,
            infinite: true,
            autoplay: false,
            autoplaySpeed: 2000,
            slidesToShow: 4,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        infinite: true,
                        dots: false
                    }
                },
                {
                    breakpoint: 767.2,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    });
})(jQuery);