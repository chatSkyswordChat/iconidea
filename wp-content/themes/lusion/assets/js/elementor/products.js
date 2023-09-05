(function ($) {
    "use strict";
    var custom_js = {
        widget_product_js: function (){
            function render_slider_wp(id, config) {
                var viewportWidth = $(window).width();
                if (viewportWidth > 1024) {
                    var Rows = config.slidesrow;
                } else if (viewportWidth > 767) {
                    var Rows = config.slidesrow_tablet;
                } else {
                    var Rows = config.slidesrow_mobile;
                }
                $('#'+id+'  ul.products').not('.slick-initialized').slick({ 
                    slidesToShow: config.slidesToShow,
                    slidesToScroll: config.slidesToScroll,
                    rows: Rows,
                    centerMode: config.centermode,
                    centerPadding: config.centerpadding + 'px',
                    dots: config.dots,
                    arrows: config.show_arr,
                    nextArrow: '<button class="slick-next"><i class="theme-icon-right-arrow"></i></button>',
                    prevArrow: '<button class="slick-prev"><i class="theme-icon-left-arrow"></i></button>',
                    speed: config.speed,
                    infinite: config.infinite,
                    autoplay: config.autoplay,
                    autoplaySpeed: config.autoplay_speed,
                    rtl: config.direction,
                    pauseOnHover: config.pause_on_hover,
                    responsive: [{
                            breakpoint: 1400,
                            settings: {
                                slidesToShow: config.slidestoshow_desktop
                            }
                        },
                        {
                            breakpoint: 1025,
                            settings: {
                                slidesToShow: config.slidestoshow_tablet,
                                slidesToScroll: 1,
                                rows: Rows,
                                centerPadding: config.centerpadding_tablet + 'px',
                            }
                        },
                        {
                            breakpoint: 767.2,
                            settings: {
                                slidesToShow: config.slidestoshow_mobile,
                                slidesToScroll: 1,
                                rows: Rows,
                                centerPadding: config.centerpadding_mobile + 'px',
                            }
                        },
                        {
                            breakpoint: 481,
                            settings: {
                                slidesToShow: config.slidestoshow_mobile_mini,
                                slidesToScroll: 1,
                                centerPadding: config.centerpadding_mobile + 'px',
                            }
                        },
                    ]
                });
            }
    
            function tabViewprot1366(id) {
                $("#" + id + " .product-tab-header ul").on("click", ".init", function () {
                    $("#" + id + " .product-tab-header ul").find('.theme-icon-download').toggleClass('upload');
                    $(this).closest("ul").children('li:not(.init)').toggle();
                });
    
                var allOptions = $("#" + id + " .product-tab-header ul").children('li:not(.init)');
                $('#' + id + '  .product-tab-header ul').on("click", "li:not(.init)", function () {
                    $("ul").children('.init').html($(this).html());
                    $('#' + id + ' .product-tab-header ul li.init').append('<span class="theme-icon-download"></span>');
                    allOptions.toggle();
                });
    
                if (!$('#' + id + '  .product-tab-header ul span').hasClass("theme-icon-download")) {
                    var data_attr_value = $('#' + id + '  .product-tab-header ul li').first().attr('data-attr-value');
                    var data_cat_slug = $('#' + id + '  .product-tab-header ul li').first().attr('data-cat-slug');
                    var data_text = $('#' + id + '  .product-tab-header ul li').first().text();
                    $('#' + id + '  .product-tab-header ul li').first().addClass("item-current");
                    $('<li class="init tab-item" data-attr-value="' + data_attr_value + '" data-cat-slug="' + data_cat_slug + '"><span>' + data_text + '</span><span class="theme-icon-download"></span></li>').insertBefore('#' + id + '  .product-tab-header ul li:first-child');
                }
            }
    
            function rende_data_load_tabs(id, config) {
                if (config.change_to_a_filter_box == 'yes' || config.change_to_a_filter_box_767 == 'yes') {
                    tabViewprot1366( id);
                } else {
                    $('#'+ id + ' .product-tab-header ul li').first().addClass("item-current");
                }
                $('#' + id + '  .product-tab-header ul li').each(function () {
                    var data = {
                        'action': 'load_product_by_catslug',
                        'page': -1,
                        'posttype': 'product',
                        'product_cat': $(this).attr('data-cat-slug'),
                        'filter_by': $(this).attr('data-attr-value'),
                        'orderby': config.orderby,
                        'order': config.order,
                        'columns': config.columns,
                        'posts_per_page': config.posts_per_page,
                        'show_quickview': config.show_quickview,
                        'show_wishlist': config.show_wishlist,
                        'show_compare': config.show_compare,
                        'show_attribute_on_title': config.show_attribute_on_title,
                        'product_attr': config.product_attr,
                        'product_type': config.product_type,
                        'product_layout': config.product_layout,
                        'show_custom_image':  config.show_custom_image,
                        'custom_dimension_width':  config.custom_dimension_width,
                        'custom_dimension_height':  config.custom_dimension_height,
                    }
                    // console.log(data)
                    if ($(this).hasClass("item-current")) {
                        $.ajax({
                            url: lusion_params.ajax_url,
                            type: 'POST',
                            data: data,
                            success: function (response) {
                                // console.log(response)
                                // console.log(config)
                                jQuery('#' + id + '  .content-tab-product').html(response);
                                $('#' + id + '  .lds-ellipsis').css('display', 'none');
                                if (!$('#' + id + '   .products ')[0]) {
                                    $('#' + id + '   .woocommerce ').html('<p>No products in this category.</p>');
                                }
                                if (config.show_slider == 'yes') {
                                    setInterval(function () {
                                        var height = $('#' + id + ' li.product .product-top').height() + 'px';
                                        $('#' + id + ' .slick-slider .slick-arrow').css('height', height);
                                    }, 100);
                                    render_slider_wp(id, config);
                                }
                            }
                        }).done(function () {
                            setInterval(function () {
                                var width_sc_product = $('.apr-product.product-style-1.product-style-5 .product-top').width();
                                var height_sc_product = $('.apr-product.product-style-1.product-style-5 .product-top').height();
                                var width_sc_product_hover = $('.apr-product.product-style-1.product-style-5 div.wcvashopswatchlabel').width();
                                var height_sc_product_hover = width_sc_product_hover * (height_sc_product / width_sc_product);
                                var background_size_sc_product_hover = width_sc_product_hover + 'px ' + height_sc_product_hover + 'px';
                                $(".apr-product.product-style-1.product-style-5 div.wcvashopswatchlabel").each(function () {
                                    $(this).css({
                                        "height": height_sc_product_hover,
                                        "background-size": background_size_sc_product_hover
                                    });
                                });
                            }, 300);
                            $('.shopswatchinput.slider').slick({
                                infinite: true,
                                slidesToShow: 3,
                                slidesToScroll: 1,
                                nextArrow: '<button class="slick-next"><i class="theme-icon-right-arrow"></i></button>',
                                prevArrow: '<button class="slick-prev"><i class="theme-icon-left-arrow"></i></button>',
                            });
                        });
                    }
                    if (!$(this).hasClass("init")) {
                        $(this).click(function () {
                            $('#' + id + '  .lds-ellipsis').css('display', 'block').html('<div></div><div></div><div></div><div></div>');
                            $('#' + id + '   .product-tab-header ul li').removeClass("item-current");
                            $('#' + id + '  .content-tab-product').css('opacity', '0');
                            $(this).addClass("item-current");
                            $.ajax({
                                url: lusion_params.ajax_url,
                                type: 'POST',
                                data: data,
                                success: function (response) {
                                    jQuery('#' + id + '  .content-tab-product').html(response);
                                    $('#' + id + '  .lds-ellipsis').css('display', 'none');
                                    $('#' + id + '  .content-tab-product').css('opacity', '1');
                                    if (!$('#' + id + '   .products ')[0]) {
                                        $('#' + id + '   .woocommerce ').html('<p>No products in this category.</p>');
                                    }
                                    if (config.show_slider == 'yes') {
                                        setInterval(function () {
                                            var height = $('#' + id + ' li.product .product-top').height() + 'px';
                                            $('#' + id + ' .slick-slider .slick-arrow').css('height', height);
                                        }, 100);
                                        render_slider_wp(id, config);
                                    }
                                    if ($('.apr-product .content-tab-product > div').hasClass('woocommerce ')) {
                                        $('.woocommerce ').removeAttr('class');
                                    }
    
                                }
                            }).done(function () {
                                setInterval(function () {
                                    var width_sc_product = $('.apr-product.product-style-1.product-style-5 .product-top').width();
                                    var height_sc_product = $('.apr-product.product-style-1.product-style-5 .product-top').height();
                                    var width_sc_product_hover = $('.apr-product.product-style-1.product-style-5 div.wcvashopswatchlabel').width();
                                    var height_sc_product_hover = width_sc_product_hover * (height_sc_product / width_sc_product);
                                    var background_size_sc_product_hover = width_sc_product_hover + 'px ' + height_sc_product_hover + 'px';
                                    $(".apr-product.product-style-1.product-style-5 div.wcvashopswatchlabel").each(function () {
                                        $(this).css({
                                            "height": height_sc_product_hover,
                                            "background-size": background_size_sc_product_hover
                                        });
                                    });
                                }, 300);
                                $('.shopswatchinput.slider').slick({
                                    infinite: true,
                                    slidesToShow: 3,
                                    slidesToScroll: 1,
                                    nextArrow: '<button class="slick-next"><i class="theme-icon-right-arrow"></i></button>',
                                    prevArrow: '<button class="slick-prev"><i class="theme-icon-left-arrow"></i></button>',
                                });
                            });
                        });
                    }
    
                });
            }
    
            function lusionLoadMoreSc(id, config) {
                var $j = jQuery.noConflict();
                var $container = $j('#' + id + ' ul.products');
                $j('#' + id + ' .view-more-button').off('click tap').on('click tap', function (e) {
                    e.preventDefault();
                    var el = $(this);
                    $j('.loadmore-product').after('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
                    el.parent().addClass('hide-loadmore');
                    var $content = '.pagination_load_more ul.products';
                    var paged = $('#' + id + ' nav.woocommerce-pagination').attr('data-paged');
                    var data_totalpage = $('#' + id + ' nav.woocommerce-pagination').attr('data-totalpage');
                    paged++;
                    var link = window.location.href + '?product-page=' + paged;
                    $j.get(link + '', function (data) {
                        var $new_content = $j($content, data).wrapInner('').html();
                        if (config.show_slider == 'yes') {
                            $container.slick('slickAdd',$new_content);
                        }else{
                            $container.append($new_content);
                        }
                        $j('#' + id + '').find('.lds-ellipsis').remove();
                        el.parent().removeClass('hide-loadmore');
                        $j('#' + id + ' nav.woocommerce-pagination').attr('data-paged', paged);
                        if (paged == data_totalpage) {
                            $j('#' + id + ' .loadmore-product').remove();
                        }
                    });
                });
            }
    
            function enqueue_script_list(id, config) {
                if (!$('body').hasClass('woocommerce')) {
                    $('body').addClass('woocommerce');
                }
                if ($(window).width() < 768) {
                    $('#' + id + ' .title-list-product').next().hide();
    
                    if (config.show_content_mobile === 'yes') {
                        $('#' + id + ' .woocommerce.columns-1').addClass('show');
                        $('#' + id + '').addClass('active');
                        $('#' + id + ' .woocommerce.columns-1').show();
                    }
                    $('#' + id + ' .title-list-product').click(function () {
                        var $this = $(this);
                        if ($this.next().hasClass('show')) {
                            $this.next().removeClass('show');
                            $this.parent().removeClass('active');
                            $this.next().slideUp();
                        } else {
                            $('.woocommerce.columns-1').removeClass('show');
                            $('.apr-product').removeClass('active');
                            $('.woocommerce.columns-1').slideUp();
                            $this.next().toggleClass('show');
                            $this.parent().toggleClass('active');
                            $this.next().slideDown();
                        }
                    });
                }
            }
            $('.widget-product-warper').each(function () {
                var config = $(this).data('config');
                var id = $(this).attr('id');
                //console.log(config);
                if(config.product_layout === 'tab'){
                    rende_data_load_tabs(id, config);
                }else if(config.product_layout === 'list'){
                    enqueue_script_list(id, config);
                }
                lusionLoadMoreSc(id, config);
            });
            $(window).load(function() {
                $('.widget-product-warper').each(function () {
                    var config = $(this).data('config');
                    var id = $(this).attr('id');
                   //console.log(config);
                    if (config.show_slider == 'yes' & config.product_layout !== 'list') {
                        setTimeout(function () {
                            var height = $('#' + id + ' li.product .product-top').height() + 'px';
                            $('#' + id + ' .slick-slider .slick-arrow').css('height', height);
                        }, 100);
                        $(window).resize(function () {
                            setTimeout(function () {
                                var height = $('#' + id + ' li.product .product-top').height() + 'px';
                                $('#' + id + ' .slick-slider .slick-arrow').css('height', height);
                            }, 100);
                        });
                        render_slider_wp(id, config);
                    }
                });
            });
        }
    };
    $(document).ready(function () {
        custom_js.widget_product_js();
    });
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/apr_products.default', custom_js.widget_product_js);
    })

})(jQuery);