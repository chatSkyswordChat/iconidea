(function ($) {
    "use strict";
      //Filter Isotop Window Load
    function lusionFilterIsotopLoad() {
        var $grid = $('.isotope');
        var container = $('.isotope').isotope({
            itemSelector: '.item',
            layoutMode: 'fitRows',
            getSortData: {
                name: '.item'
            }
        });
        var container = $('.product-isotope .product-grid').isotope({
            itemSelector: '.item',
            layoutMode: 'masonry',
            getSortData: {
                name: '.item'
            }
        });
        $('.btn-filter').each(function (i, buttonGroup) {
            var filterLoadValue = $(this).find('.active').attr('data-filter');
            container.isotope({filter: filterLoadValue});
        });
        $('.blog-masonry').masonry({
            itemSelector: '.item',
            percentPosition: true
        });


        $('.btn-filter').on('click', '.button', function () { 
            var filterValue = $(this).attr('data-filter');
            container.isotope({filter: filterValue});
        });
        $('.btn-filter').each(function (i, buttonGroup) {
            var buttonGroup = $(buttonGroup);
            buttonGroup.on('click', '.button', function () {
                buttonGroup.find('.active').removeClass('active');
                $(this).addClass('active');
            });
        });

        var container = $('.product-isotope .product-grid').isotope({
            itemSelector: '.item',
            layoutMode: 'masonry',
            getSortData: {
                name: '.item'
            }
        });
    }
    function lusionLoadMore() {
        if (typeof isotope == 'function') {
            var $j = jQuery.noConflict();
            var $container = $j('.load-item');
            var i = 1;
            var paged = $('.load_more_button').data('data-paged');
            var page = paged ? paged + 1 : 2;
            $j('.load_more_button a').off('click tap').on('click tap', function (e) {
                e.preventDefault();
                var el = $(this);
                $j('.load_more_button a').after('<div id="portfolio_loading"><div class="scroll-loader"><center><div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div></center><br></div></div>');
                el.addClass('hide-loadmore');
                var link = $j(this).attr('href');
                var $content = '.load-item';
                var $anchor = '.load_more_button a';
                var $next_href = $j($anchor).attr('href');
                $j.get(link + '', function (data) {
                    $j('.load_more_button').find('#portfolio_loading').remove();
                    el.removeClass('hide-loadmore');
                    var $new_content = $j($content, data).wrapInner('').html();
                    $next_href = $j($anchor, data).attr('href');
                    $('.item-page' + i).each(function () {
                        var id = $(this).find('.blog-img').attr('id');
                        $('#' + id + '.blog-gallery').slick({
                            dots: false,
                            arrows: true,
                            nextArrow: '<button class="btn-next"><span class="theme-icon-next"></span></button>',
                            prevArrow: '<button class="btn-prev"><span class="theme-icon-back"></span></button>',
                            rtl: $rtl,
                            infinite: true,
                            autoplay: false,
                            autoplaySpeed: 2000,
                            slidesToShow: 1,
                            slidesToScroll: 1
                        });
                    });
                  
                    if ($('.blog-entries-wrap').hasClass('blog-masonry')) {
                        $container.isotope({
                            itemSelector: '.item',
                            layoutMode: 'masonry',
                            getSortData: {
                                name: '.item'
                            }
                        });
                    } else {
                        $container.isotope({
                            itemSelector: '.item',
                            layoutMode: 'fitRows',
                            getSortData: {
                                name: '.item'
                            }
                        });
                    }
                    $container.append($new_content).isotope('reloadItems').isotope({sortBy: 'original-order'});
               
                    if ($j('.load_more_button').attr('rel') > i) {
                        $j('.load_more_button a').attr('href', $next_href); // Change the next URL
                    } else {
                        $j('.load_more_button').remove();
                    }
                }).done(function () {
                    setTimeout(function () {
                        $j('.load-item').isotope('layout');
                    }, 500);
                });
                i++;
            });
            $('.animate-top').each(function(){
                var animate_item = $(this);
                if( animate_item.offset().top > $(window).scrollTop() + $(window).height() ){
                    animate_item.css({ 'opacity':0, 'padding-top':30, 'margin-bottom':-30 });
                }else{ return; }    

                $(window).scroll(function(){
                    if( $(window).scrollTop() + $(window).height() > animate_item.offset().top + 100 ){
                        animate_item.animate({ 'opacity':1, 'padding-top':0, 'margin-bottom':0 }, 1200);
                    }
                });                 
            });
        }
    }
    // Fillter Isotop
    function lusionFillterIsotop() {
        var filterValue = $('.active_cat').attr('data-filter');
        var container = $('.isotope').isotope({
            itemSelector: '.item',
            filter: filterValue,
            layoutMode: 'fitRows',
            getSortData: {
                name: '.item'
            }
        });
        $('.btn-filter').on('click', '.button', function () {
            var filterValue = $(this).attr('data-filter');
            container.isotope({filter: filterValue});
        });
        $('.btn-filter').each(function (i, buttonGroup) {
            var buttonGroup = $(buttonGroup);
            buttonGroup.on('click', '.button', function () {
                buttonGroup.find('.active').removeClass('active');
                $(this).addClass('active');
            });
        });
    }
     // Function Click
    function lusionClick() {
        // filter items on button click Gallery
        var $gridGallery = $('.isotope');
        $('.button-group').on('click', 'button', function () {
            var filterValueGallery = $(this).attr('data-filter');
            $gridGallery.isotope({filter: filterValueGallery});
            $('.button-group button').removeClass('is-checked');
            $(this).addClass('is-checked');
        });
        // filter items on button click Blog
        var $grid = $('.grid-isotope');
        $('.button-group').on('click', 'button', function () {
            var filterValue = $(this).attr('data-filter');
            $grid.isotope({filter: filterValue});
            $('.button-group button').removeClass('is-checked');
            $(this).addClass('is-checked');
        });

        // Form login my account page
        $('#customer_login > h2.title-login').on('click', function () {
            $(this).addClass('active');
            $('#customer_login .woocommerce-form-login').addClass('active');
            $('#customer_login .woocommerce-form-register').removeClass('active');
            $('#customer_login > h2.title-register').removeClass('active');
        });
        $('#customer_login > h2.title-register').on('click', function () {
            $(this).addClass('active');
            $('#customer_login .woocommerce-form-register').addClass('active');
            $('#customer_login .woocommerce-form-login').removeClass('active');
            $('#customer_login > h2.title-login').removeClass('active');
        });

        $('div.tm-contact-widget').removeAttr('id', 'none');
        $('.mc4wp-alert.mc4wp-error p').after("<span class='theme-icon-close'></span>");
        $('.mc4wp-alert.mc4wp-success p').after("<span class='theme-icon-close'></span>");
        $('.mc4wp-alert.mc4wp-notice p').after("<span class='theme-icon-close'></span>");
        $('.mc4wp-alert.mc4wp-error span.theme-icon-close').on('click', function () {
            $('.mc4wp-alert.mc4wp-error').remove();
        });
        $('.mc4wp-alert.mc4wp-success span.theme-icon-close').on('click', function () {
            $('.mc4wp-alert.mc4wp-success').remove();
        });
        $('.mc4wp-alert.mc4wp-notice span.theme-icon-close').on('click', function () {
            $('.mc4wp-alert.mc4wp-notice').remove();
        });
        $('.change-password input').on('click', function () {
            $( '.content-password' ).toggle();
        });
       
        $(".tab-general #review_form_wrapper").hide();
        $('.add-single-review2').on('click', function () {
            $( '.tab-general #review_form_wrapper' ).toggle();
        });
        $(".content-single-review #review_form_wrapper").hide();
        $('.content-single-review .add-single-review').on('click', function () {
            $( '.content-single-review #review_form_wrapper' ).toggle();
        });
    }
    $(document).ready(function () {
        lusionClick();        
        lusionFillterIsotop();
    });
    $(window).resize(function () {        
        lusionLoadMore();
    });
    $(window).load(function () {
        lusionLoadMore();        
        lusionFilterIsotopLoad();
    });
})(jQuery);