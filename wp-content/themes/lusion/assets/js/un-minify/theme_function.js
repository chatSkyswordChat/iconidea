/*!
 * Theme Function
 *
 * Js custom theme
 *
 * https://arrowtheme.com
 * Copyright 2010-2020 ArrowTheme
 */
(function ($) {
    "use strict";
    //Global variable
    var $body = $('body');
    var $rtl = false;
    if (lusion_params.lusion_rtl == 'yes') {
        $rtl = true;
    }
	function lusionAutocompleteSearch() {
        /*********** Search ajax **********/
        var timeout = null;
        $('.search-mobile-ajax').keyup(function () { // catch event when typing search keyword
            clearTimeout(timeout); // clear time out
            timeout = setTimeout(function () {
                call_ajax(); // Call the ajax function
            }, 500);
        });

        function call_ajax() { // Initialize the ajax search function
            var form = $('.mobile-search-form');
            var data = $('.search-mobile-ajax').val();
            if (data.length > 2) {
                $.ajax({
                    type: 'POST',
                    async: true,
                    url: lusion_params.ajax_url,
                    data: {
                        'action': 'Product_filters',
                        'data': data
                    },
                    beforeSend: function () {
                        form.addClass('search-loading');
                    },
                    success: function (data) {
                        // Show returned data
                        $('.search-results-wrapper').html(data); // Show returned data
                        $('.search-results-wrapper').slideDown("slow");
                        form.removeClass('search-loading');
                    }
                });
            } else {
                $('.search-results-wrapper').slideUp("slow").empty();
            }
        }

        $('.header-search').each(function () {
            $('.search-input').keyup(function () { // catch event when typing search keyword
                clearTimeout(timeout); // clear time out
                timeout = setTimeout(function () {
                    call_ajax_searchbox(); // Call the ajax function
                }, 500);

            });

            function call_ajax_searchbox() { // Initialize th ajax search function
                var form = $('.searchform');
                var data = $('.search-input').val();
                if (data.length > 2) {
                    $.ajax({
                        type: 'POST',
                        async: true,
                        url: lusion_params.ajax_url,
                        data: {
                            'action': 'Product_filters',
                            'data': data
                        },
                        beforeSend: function () {
                            form.addClass('search-loading');
                        },
                        success: function (data) {
                            // Show returned data
                            $('.search-results-wrapper').html(data);
                            $('.search-results-wrapper').stop().slideDown("slow");
                            form.removeClass('search-loading');
                        }
                    }).done(function () {
                        $('.view-all-seach').on('click', function () {
                            var url_home = $('.search-box .search-block-top .searchform').attr('action');
                            var key_search = $('.search-box .search-block-top .searchform .woosearch-input-box input.search-input').val();
                            var url_search = url_home + '/?s=' +  key_search +'&post_type=product';
                            $(this).attr('href',url_search);
                        });
                    });
                } else {
                    $('.search-results-wrapper').stop().slideUp("slow").empty();
                }
            }
        });
        $(".elementor-widget-apr-search-form, .header-search, .search-mobile").on('mouseleave', function () {
            $('.search-results-wrapper').stop().slideUp("slow");
        });
    }

    // Woocommer
    function lusionWoocommerceAddCartAjaxMessage() {
        if ($('.add_to_cart_button').length !== 0 && $('#cart_added_msg_popup').length === 0) {
            var message_div = $('<div>')
                    .attr('id', 'cart_added_msg'),
                popup_div = $('<div>')
                    .attr('id', 'cart_added_msg_popup')
                    .html(message_div)
                    .hide();
            $('body').prepend(popup_div);
        }
    }

    function lusionAccordion() {
        if ($(".accordion_holder").length) {
            $(".toggle").addClass("accordion")
                .find(".title-holder")
                .addClass("ui-theme-accordion-header")
                .click(function () {
                    $(this)
                        .toggleClass("ui-theme-accordion-header-active ui-theme-state-active")
                        .next().toggleClass("ui-theme-accordion-content-active").slideToggle(400);
                    return false;
                })
                .next()
                .addClass("ui-theme-accordion-content")
                .hide();

            $(".toggle").each(function () {
                var activeTab = parseInt($(this).data('active-tab'));
                if (activeTab !== "" && activeTab >= 1) {
                    activeTab = activeTab - 1; // - 1 because active tab is set in 0 index base
                    $(this).find('.ui-theme-accordion-content').eq(activeTab).show();
                    $(this).find('.ui-theme-accordion-header').eq(activeTab).addClass('ui-theme-state-active'); //set active accordion header
                }

            });
        }
    }

    function lusionWoocommer() {
        if (lusion_params.lusion_woo_enable == 'yes') {
			//sticky single product
            if (lusion_params.single_sticky_product != '') {
                var sticky_single = setInterval(function () {
                    var height_sticky = $('.sitcky-product').height() + 'px';
                    $('body.single-product').css('padding-bottom', height_sticky);
                    clearInterval(sticky_single);
                }, 100);
                $(window).resize(function () {
                    var sticky_single = setInterval(function () {
                        var height_sticky = $('.sitcky-product').height() + 'px';
                        $('body.single-product').css('padding-bottom', height_sticky);
                        clearInterval(sticky_single);
                    }, 100);
                });
            }
			/* Add css single 3,4 */
			if ($('.product-detail').hasClass('single_3')) {
				$('body').addClass('product_single_3');
			}
			if ($('.product-detail').hasClass('single_4')) {
				$('body').addClass('product_single_4');
			}

			/* Sidebar */
			$(".brand .widget-title").append('<span class="icon theme-icon-minus"></span>');
			var $title_brand = $(".brand  .widget-title");
			$title_brand.on('click', function () {
				var $div_brand = $(".brand ul.list-brand");
				if ($div_brand.is(':hidden') === true) {
					$div_brand.slideDown();
					$title_brand.find('span.icon').remove();
					$title_brand.append('<span class= "icon theme-icon-plus"></span>');
					$(this).find('span.icon').remove();
					$(this).append('<span class= "icon theme-icon-minus"></span>');
                    $title_brand.removeClass('remove_brand');
				} else {
					$div_brand.slideUp();
					$(this).find('span.icon').remove();
					$(this).append('<span class= "icon theme-icon-plus"></span>');
                    $title_brand.addClass('remove_brand')
				}
			});
			$(".widget_product_categories .widget-title").append('<span class="icon theme-icon-minus"></span>');
			var $title_cate = $(".widget_product_categories  .widget-title");
			$title_cate.on('click', function () {
				var $div_cate = $(".widget_product_categories ul.product-categories");
				if ($div_cate.is(':hidden') === true) {

					$div_cate.slideDown();
					$title_cate.find('span.icon').remove();
					$title_cate.append('<span class= "icon theme-icon-plus"></span>');
					$(this).find('span.icon').remove();
					$(this).append('<span class= "icon theme-icon-minus"></span>');
                     $title_cate.removeClass('remove_cat_product');
				} else {
					$div_cate.slideUp();
					$(this).find('span.icon').remove();
					$(this).append('<span class= "icon theme-icon-plus"></span>');
                    $title_cate.addClass('remove_cat_product');
				}
			});
            $(".bapf_ckbox .bapf_head h3").append('<span class="icon theme-icon-minus"></span>');
            var $bapf_ckbox = $(".bapf_ckbox .bapf_head h3 ");
            $bapf_ckbox.on('click', function () {
                var $div_bapf_ckbox = $(".bapf_ckbox .bapf_body");
                if ($div_bapf_ckbox.is(':hidden') === true) {

                    $div_bapf_ckbox.slideDown();
                    $bapf_ckbox.find('span.icon').remove();
                    $bapf_ckbox.append('<span class= "icon theme-icon-plus"></span>');
                    $(this).find('span.icon').remove();
                    $(this).append('<span class= "icon theme-icon-minus"></span>');
                } else {
                    $div_bapf_ckbox.slideUp();
                    $(this).find('span.icon').remove();
                    $(this).append('<span class= "icon theme-icon-plus"></span>');
                }
            });
			/* End Sidebar */

            $('.socials-list .ywsl-social.ywsl-google').each(function () {
                var data_img = $(".socials-list .socials-list .ywsl-social.ywsl-google img").attr('alt');
                $(this).append('<span class="text-social">' + $(".socials-list .ywsl-social.ywsl-google img").attr('alt') + '</span>');
            });
             $('.socials-list .ywsl-social.ywsl-facebook').each(function () {
                var data_img = $(".socials-list .socials-list .ywsl-social.ywsl-facebook img").attr('alt');
                $(this).append('<span class="text-social">' + $(".socials-list .ywsl-social.ywsl-facebook img").attr('alt') + '</span>');
            });
			/* List Grid Shop Pge */
			$('.list-view-as li').each(function () {
				$(this).find('a').on("click", function (e) {
					e.preventDefault();
					var data_show = $(this).data('layout');
					var data_column = $(this).data('column');
					var current_grid = $('.list-view-as li a.active').data('column');
					if (data_show == 'layout-grid') {
						$('ul.products').removeClass('columns-' + current_grid);
						$('ul.products').addClass('columns-' + data_column);
						$('ul.products').removeClass('product-list product-list-grid');
						 $('ul.products').removeClass('columns-1');
						$('ul.products').addClass('product-grid');
						$('ul.product-grid.products li.product .desc').css('display', 'none');
						var wdw = $(window).width();
						if (wdw > 1024) {
							$('ul.product-grid.products.columns-2 li.product').each(function () {
								var widthPrice = ($('ul.product-grid.products.columns-2 li.product .price').width()) + 15;
								$('ul.product-grid.products.columns-2 li.product .woocommerce-loop-product__title').css('padding-right', widthPrice + 'px');
							});
						} else {
							$('.site-main .woocommerce .product-style-default ul.products.columns-2 li.product').each(function () {
								$('.site-main .woocommerce .product-style-default ul.products.columns-2.product-grid li.product .woocommerce-loop-product__title').css('padding-right', '0px');
							});
						}
					} else if (data_show == 'layout-list') {
						$('ul.products').removeClass('columns-' + current_grid);
						$('ul.products').addClass('columns-' + data_column);
						$('ul.products').removeClass('product-grid');
						$('ul.products').addClass('product-list product-list-grid');
                        $('ul.product-list.products li.product .desc').css('display', 'block');
					}
					$('.list-view-as li a').removeClass('active');
					$(this).addClass('active');
					$('.products').find('>div').removeClass('active');
					$('.products' + ' .' + data_show).addClass('active').fadeIn("slow");
				});
			});
			/* End List Grid Shop Pge */
			/* Shop Page */
            setInterval(function () {
                var width_sc_product = $('.product-style.product-style-1.product-style-5 .product-top').width();
                var height_sc_product = $('.product-style.product-style-1.product-style-5 .product-top').height();
                var width_sc_product_hover = $('.product-style.product-style-1.product-style-5 div.wcvashopswatchlabel').width();
                var height_sc_product_hover = width_sc_product_hover * (height_sc_product / width_sc_product);
                var background_size_sc_product_hover = width_sc_product_hover + 'px ' + height_sc_product_hover + 'px';
                $(".product-style.product-style-1.product-style-5 div.wcvashopswatchlabel").each(function () {
                    $(this).css({
                        "height": height_sc_product_hover,
                        "background-size": background_size_sc_product_hover
                    });
                });
            }, 300);
            $('body').on('added_to_cart', function (response) {
                $('body').trigger('wc_fragments_loaded');
            });

            lusionWoocommerceAddCartAjaxMessage();

			/* Tabs */
            $("form.cart").on("change", "input.qty", function () {
                $(this.form).find("button[data-quantity]").data("quantity", this.value);
            });

            if ($('.active-sidebar').hasClass('not-active')) {
                $('.product-has-filter.product-has-filter-top .filter-top.active-sidebar').slideUp(600,'linear');
            }

            if ($(window).width() > 1199) {
                if ($('.main-sidebar').hasClass('has-sidebar')) {
                    $('.main-sidebar').addClass('show-filter');
                }
                $('.btn-filter-product').on('click', function () {

                    if ($('.main-sidebar').hasClass('show-filter')) {
                        $('.main-sidebar').removeClass('show-filter');
                    } else {
                        $('.main-sidebar').addClass('show-filter');
                    }
                    if ($('.active-sidebar').hasClass('not-active')) {
                        $('.active-sidebar').removeClass('not-active');
                         $('.product-has-filter.product-has-filter-top .filter-top.active-sidebar').slideDown(600,'linear');
                    } else {
                        $('.active-sidebar').addClass('not-active');
                        $('.product-has-filter.product-has-filter-top .filter-top.active-sidebar').slideUp(600,'linear');
                    }
                });
            }else{
                $('.product-has-filter.product-has-filter-top .btn-filter-product').on('click', function () {
                    if ($('.active-sidebar').hasClass('not-active')) {
                        $('.active-sidebar').removeClass('not-active');
                        $('.product-has-filter.product-has-filter-top .filter-top.active-sidebar').slideDown(600,'linear');
                    } else {
                        $('.active-sidebar').addClass('not-active');
                        $('.product-has-filter.product-has-filter-top .filter-top.active-sidebar').slideUp(600,'linear');
                    }
                    if ($('.main-sidebar').hasClass('show-filter')) {
                        $('.main-sidebar').removeClass('show-filter');
                    } else {
                        $('.main-sidebar').addClass('show-filter');
                    }

                });
            }

            /* quantily
            /* Target quantity inputs on product pages */
            $('input.qty:not(.product-quantity input.qty)').each(function () {
                var min = parseFloat($(this).attr('min'));

                if (min && min > 0 && parseFloat($(this).val()) < min) {
                    $(this).val(min);
                }
            });

            $(document).off('click', '.plus, .minus').on('click', '.plus, .minus', function () {
                /* Get values */
                var $qty = $(this).closest('.quantity').find('.qty'),
                    currentVal = parseFloat($qty.val()),
                    max = parseFloat($qty.attr('max')),
                    min = parseFloat($qty.attr('min')),
                    step = $qty.attr('step');

                /* Format values */
                if (!currentVal || currentVal === '' || currentVal === 'NaN')
                    currentVal = 0;
                if (max === '' || max === 'NaN')
                    max = '';
                if (min === '' || min === 'NaN')
                    min = 1;
                if (step === 'any' || step === '' || step === undefined || parseFloat(step) === 'NaN')
                    step = 1;

                /* Change the value */
                if ($(this).is('.plus')) {

                    if (max && (max === currentVal || currentVal > max)) {
                        $qty.val(max);
                    } else {
                        $qty.val(currentVal + parseFloat(step));
                    }

                } else {

                    if (min && (min === currentVal || currentVal < min)) {
                        $qty.val(min);
                    } else if (currentVal > 0) {
                        $qty.val(currentVal - parseFloat(step));
                    }

                }

                // Trigger change event
                $qty.trigger('change');
            });

            //Woocommerce pagination
            $('.woocommerce-pagination ul.page-numbers li a').each(function () {
                var woocommerce_pagination = $(this).attr('href');
                if(woocommerce_pagination == '#'){
                    $(this).css({'pointer-events':'none','opacity':'0.5'});
                }
            });

			/* End Shop Page */

			/* Single product */
			//Sort by
			$('.tab-full_width').appendTo($('.product-detail .row'));
			$(".summary .size-guide-product").appendTo('.summary .cart');
			$(".col-xl-12 .single_1 .yith-wcwl-add-to-wishlist").appendTo('.col-xl-12 .single_1 .cart');

            //Default Action
            $('.product-tab .entry-content').hide(); //Hide all content
            $('.product-tab ul.tabs li').removeClass('active');
            $('.product-tab ul.tabs li:first').addClass('active').show(); //Activate first tab
            $('.product-tab .entry-content:first').show(); //Show first tab content
            $('.product-tab ul.tabs li').on('click', function (e) {
                $('.product-tab ul.tabs li').removeClass('active'); //Remove any "active" class
                $(this).addClass('active'); //Add "active" class to selected tab
                $('.product-tab .entry-content').hide(); //Hide all tab content
                var activeTab = $(this).find('a').attr('href'); //Find the rel attribute value to identify the active tab + content
                $(activeTab).fadeIn(); //Fade in the active content
                return false;
            });
            $('a.woocommerce-add-review').click(function () {
                $('html, body').animate({
                    scrollTop: $('.reviews_tab').offset().top
                }, 1000);
                $('.product-tab ul.tabs li').removeClass('active'); //Remove any "active" class
                $('.product-tab ul.tabs li.reviews_tab').addClass('active');
                $('.product-tab .entry-content').hide();
                $('#tab-reviews').fadeIn();
                return false;
            });

			if (lusion_params.lusion_is_product_enable == 'yes') {
				if ($('.product-detail')) {
					var nextArrow = '<button class="btn-next">' + '<i class="' + lusion_params.single_product_next + '"></i>' + '</button>';
					var prevArrow = '<button class="btn-prev">' + '<i class="' + lusion_params.single_product_prev + '"></i>' + '</button>';
				}
				if ($('.active-sidebar #yith-wcwl-form .wishlist_table td').hasClass('wishlist-empty')) {
					$('.active-sidebar #yith-wcwl-form .wishlist_table').addClass('empty-wishlist');
				}
				var $productGallery_horizontal = $('.single-product .product-detail.single_1.product-thumbnails-horizontal .has-gallery .product-gallery-custom'),
					$productGalleryThumb_horizontal = $('.single-product .product-detail.single_1.product-thumbnails-horizontal .has-gallery .product-list-thumbnails');
				if ($('.product-detail.single_1.product-thumbnails-horizontal')) {
					$productGallery_horizontal.slick({
						slidesToShow: 1,
						slidesToScroll: 1,
						dots: false,
						arrows: false,
						infinite: true,
						rtl: $rtl,
						asNavFor: $productGalleryThumb_horizontal,
						responsive: [
							{
								breakpoint: 767.2,
								settings: {
									arrows: true,
									nextArrow: nextArrow,
									prevArrow: prevArrow
								}
							}
						]
					});
					$productGalleryThumb_horizontal.slick({
						slidesToShow: 3,
						slidesToScroll: 1,
						nextArrow: nextArrow,
						prevArrow: prevArrow,
						dots: false,
						arrows: true,
						focusOnSelect: true,
						infinite: true,
						centerMode: false,
						speed: 300,
						rtl: $rtl,
						asNavFor: $productGallery_horizontal,
						responsive: [
							{
								breakpoint: 767.2,
								settings: {
									arrows: false
								}
							}
						]
					});
				}

                if (lusion_params.number_thumbnail_show != '') { 
                    var $product_number_thumbnail_show = lusion_params.number_thumbnail_show;
                }else{
                    var $product_number_thumbnail_show = 4;
                }
				var $productGallery_vertical = $('.single-product .product-detail.single_1.product-thumbnails-vertical .has-gallery .woocommerce-product-gallery__wrapper'),
					$productGalleryThumb_vertical = $('.single-product .product-detail.single_1.product-thumbnails-vertical .has-gallery .product-list-thumbnails');
				if ($('.product-detail.single_1.product-thumbnails-vertical')) {
                    console.log($product_number_thumbnail_show)
					$productGallery_vertical.slick({
						slidesToShow: 1,
						slidesToScroll: 1,
						dots: false,
						arrows: false,
						infinite: true,
						rtl: $rtl,
						asNavFor: $productGalleryThumb_vertical,
						responsive: [
							{
								breakpoint: 767.2,
								settings: {
									arrows: true,
									nextArrow: nextArrow,
									prevArrow: prevArrow
								}
							}
						]
					});
					$productGalleryThumb_vertical.slick({
						slidesToShow: $product_number_thumbnail_show,
						vertical: true,
						slidesToScroll: 1,
						nextArrow: nextArrow,
						prevArrow: prevArrow,
						dots: false,
						arrows: true,
						focusOnSelect: true,
						infinite: true,
						centerMode: false,
						speed: 300,
						rtl: $rtl,
						asNavFor: $productGallery_vertical,
						responsive: [
                            {
                                breakpoint: 1800.2,
                                settings: {
                                    slidesToShow:$product_number_thumbnail_show
                                }
                            },
                            {
                                breakpoint: 1600.2,
                                settings: {
                                    slidesToShow:$product_number_thumbnail_show
                                }
                            },
							{
								breakpoint: 1365.2,
								settings: {
									slidesToShow:$product_number_thumbnail_show
								}
							},
                            {
                                breakpoint: 1199.2,
                                settings: {
                                    slidesToShow:$product_number_thumbnail_show
                                }
                            },
                            {
                                breakpoint: 900.2,
                                settings: {
                                    slidesToShow:$product_number_thumbnail_show
                                }
                            },
                            {
                                breakpoint: 767.2,
                                settings: {
                                    arrows: false,
                                    slidesToShow:3,
                                    vertical: false
                                }
                            }
						]
					});
				}
                var $productGalleryThumb_2 = $('.single-product .product-detail.single_3 .has-gallery .product-list-thumbnails');
                if ($('.product-detail.single_3')) {
                   $productGalleryThumb_2.slick({
                        slidesToShow: 4,
                        slidesToScroll: 1,
                        nextArrow: nextArrow,
                        prevArrow: prevArrow,
                        dots: false,
                        arrows: false,
                        focusOnSelect: true,
                        infinite: true,
                        centerMode: true,
                        variableWidth: true,
                        speed: 300,
                        rtl: $rtl,
                        responsive: [
                            {
                                breakpoint: 767,
                                settings: {
                                    slidesToShow: 2,
                                }
                            },
                            {
                                breakpoint: 480,
                                settings: {
                                    slidesToShow: 1,
                                }
                            }
                        ]
                    });
                }
				/* Product Images Zoom */
				if (lusion_params.single_zoom_image == 1 && $(window).width() > 1024) {
					var zoomOptions = {
						zoomType: "inner",
						cursor: "crosshair",
						zoomWindowFadeIn: 500,
						zoomWindowFadeOut: 750
					};
					$('.no-gallery .woocommerce-product-gallery__image img').elevateZoom(zoomOptions);
					$('.has-gallery .woocommerce-product-gallery__wrapper .slick-current img').elevateZoom(zoomOptions);
					$('.has-gallery .woocommerce-product-gallery__wrapper').on('beforeChange', function(event, slick, currentSlide, nextSlide){
						$.removeData(currentSlide, 'elevateZoom');
						$('.zoomContainer').remove();
					});
					$('.has-gallery .woocommerce-product-gallery__wrapper').on('afterChange', function() {
						$('.has-gallery .woocommerce-product-gallery__wrapper .slick-current img').elevateZoom(zoomOptions);
					});
				}
				/* End Product Images Zoom */
				if (lusion_params.single_ajax_add_to_cart == 1) {
					// Ajax add to cart on the product page
					var $warp_fragment_refresh = {
						url: wc_cart_fragments_params.wc_ajax_url.toString().replace('%%endpoint%%', 'get_refreshed_fragments'),
						type: 'POST',
						success: function (data) {
							if (data && data.fragments) {
								$.each(data.fragments, function (key, value) {
									$(key).replaceWith(value);
								});
								$(document.body).trigger('wc_fragments_refreshed');
							}
						}
					};

					$('.product:not(.product-type-external) .entry-summary form.cart, .product:not(.product-type-external) + .sitcky-product form.cart').on('submit', function (e) {
						e.preventDefault();
						var $this = $(this);
						$this.block({
							message: null,
							overlayCSS: {
								cursor: 'none'
							}
						});
						if ($('div').hasClass('elementor-single-product')) {
							var product_url = $('.link-more-detail').attr('href'), form = $(this);
						} else {
							var product_url = window.location,
								form = $(this);
						}
						$.post(product_url, form.serialize() + '&_wp_http_referer=' + product_url, function (result) {
							var cart_dropdown = $('.widget_shopping_cart', result);

							var msg = $('#cart_added_msg_popup');
							$('#cart_added_msg').html(lusion_params.ajax_cart_added_msg);
							msg.css('margin-left', '-' + $(msg).width() / 2 + 'px').fadeIn();

							// update dropdown cart
							$('.widget_shopping_cart').replaceWith(cart_dropdown);

							// update fragments
							$.ajax($warp_fragment_refresh).done(function () {
                                $("html").addClass("opencart");
                                $(".overlay").addClass("overlay-menu");
                            });
							$this.unblock();
							window.setTimeout(function () {
								msg.fadeOut();
							}, 3000);

						});
					});
					// Related Product
					if (($('.col-xl-9').find('.product-extra').length) != 0) {
						$('body').addClass('margin-sidebar');
					}
				};
				/* End Single Product */

				/* Related, Upsel Product */
				if($('.other-product').hasClass('col-md-12')){
					var slidesToShowProduct = lusion_params.single_per_limit;
				}else{
					var slidesToShowProduct = 3;
				}

				var slick_arrow = setInterval(function () {
					var height = $('.related .products li.product .product-top, .up-sells .products li.product .product-top').height() + 'px';
					$('.related .slick-slider .slick-arrow, .up-sells  .slick-slider .slick-arrow').css('height', height);
					clearInterval(slick_arrow);
				}, 100);
				$(window).resize(function () {
					var slick_arrow = setInterval(function () {
						var height = $('.related .products li.product .product-top, .up-sells .products li.product .product-top').height() + 'px';
						$('.related .slick-slider .slick-arrow, .up-sells  .slick-slider .slick-arrow').css('height', height);
						clearInterval(slick_arrow);
					}, 100);
				});
				$('.related ul.products').slick({
					slidesToShow: slidesToShowProduct,
					slidesToScroll: 1,
					arrows: true,
					nextArrow: '<button class="btn-next"><i class="theme-icon-next"></i></button>',
					prevArrow: '<button class="btn-prev"><i class="theme-icon-back"></i></button>',
					dots: false,
					fade: false,
					rtl: $rtl,
					infinite: true,
					variableWidth: false,
					responsive: [
						{
							breakpoint: 1200,
							settings: {
								slidesToShow: 3
							}
						},
						{
							breakpoint: 767,
							settings: {
								arrows: false,
								slidesToShow: 2
							}
						}
					]
				});
				$('.up-sells ul.products').slick({
					slidesToShow: slidesToShowProduct,
					slidesToScroll: 1,
					arrows: true,
					nextArrow: '<button class="btn-next"><i class="theme-icon-next"></i></button>',
					prevArrow: '<button class="btn-prev"><i class="theme-icon-back"></i></button>',
					dots: false,
					fade: false,
					rtl: $rtl,
					infinite: true,
					variableWidth: false,
					responsive: [
						{
							breakpoint: 1200,
							settings: {
								slidesToShow: 3
							}
						},
						{
							breakpoint: 767,
							settings: {
								arrows: false,
								slidesToShow: 2
							}
						}
					]
				});
				/* End Related, Upsel Product */
			}


            /* Woocommerce update cart sidebar */
            $('body').on('added_to_cart', function (response) {
                $('body').trigger('wc_fragments_loaded');
                $('ul.products li .added_to_cart').remove();
                var msg = $('#cart_added_msg_popup');
                $('.search-form').each(function () {
                    $(this).parent().find('.ui-autocomplete').removeClass('show');
                });
                $('#cart_added_msg').html(lusion_params.ajax_cart_added_msg);
                msg.css('margin-left', '-' + $(msg).width() / 2 + 'px').fadeIn();
				$("html").addClass("opencart");
				$(".overlay").addClass("overlay-menu");
                window.setTimeout(function () {
                    msg.fadeOut();
                }, 2000);
            });
			/* End Woocommerce update cart sidebar */
        }

		/* Ajax add quantily */
        $(document).on('change', 'input.mini-qty', function () {
            var item_hash = $(this).attr('id').replace('mini-qty-', '');
            var item_quantity = $(this).val();
            var currentVal = parseInt(item_quantity);
            var form = $(this).closest('div.quantity');

            function qty_cart() {
                $.ajax({
                    type: 'POST',
                    url: lusion_params.ajax_url,
                    data: {
                        action: 'qty_cart',
                        hash: item_hash,
                        quantity: currentVal
                    },
                    beforeSend: function () {
                        form.addClass('loading');
                    },
                    success: function (data) {
                        var response = $.parseJSON(data);
                        $('.widget_shopping_cart_content').html(response.html);
                        $('.shopping-cart-button .count').html(response.count);
                        $('.count-product-cart').html(response.count);
                        form.removeClass('loading');
                    }
                });
            }
            qty_cart();
        });
		/* End Ajax add quantily */

		/* Add and Remove Count Wishlist Ajax */
        $(document).on('added_to_wishlist removed_from_wishlist', function () {
            var counter = $('.ajax-wishlist');
            $.ajax({
                url: yith_wcwl_l10n.ajax_url,
                data: {
                    action: 'yith_wcwl_update_wishlist_count'
                },
                dataType: 'json',
                success: function (data) {
                    counter.html(data.count);
                },
                beforeSend: function () {
                    counter.block();
                },
                complete: function () {
                    counter.unblock();
                }
            });
        });
		/* End Add and Remove Count Wishlist Ajax */

        $('.yith-woocompare-widget .clear-all').on('click', function () {
            if ($('.compare_product .add_to_compare').hasClass('added')) {
                $('.compare_product .add_to_compare').addClass('removed');
            } else {
                $('.compare_product .add_to_compare').removeClass('removed');
            }
        });
		if($('.other-product').hasClass('col-md-12')){
			var slidesToShowProduct = lusion_params.single_per_limit;
		}else{
			var slidesToShowProduct = 3;
		}

        var slick_arrow = setInterval(function () {
            var height = $('.cross-sells .products li.product .product-top').height() + 'px';
            $('.cross-sells .slick-slider .slick-arrow').css('height', height);
            $('.home-furniture-sc-product-slider .slick-slider .slick-arrow').css({'height': 44, 'top': -70});
            clearInterval(slick_arrow);
        }, 100);
        $(window).resize(function () {
            var slick_arrow = setInterval(function () {
                var height = $('.cross-sells .products li.product .product-top').height() + 'px';
                $('.cross-sells .slick-slider .slick-arrow').css('height', height);
                $('.home-furniture-sc-product-slider .slick-slider .slick-arrow').css({'height': 44, 'top': -83});
                clearInterval(slick_arrow);
            }, 100);
        });

        $('.cross-sells .products').slick({
            slidesToShow: slidesToShowProduct,
            slidesToScroll: 1,
            arrows: true,
            nextArrow: '<button class="btn-next"><i class="theme-icon-next"></i></button>',
            prevArrow: '<button class="btn-prev"><i class="theme-icon-back"></i></button>',
            dots: false,
            fade: false,
            rtl: $rtl,
            infinite: true,
            variableWidth: false,
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 767,
                    settings: {
                        arrows: false,
                        slidesToShow: 2
                    }
                }
            ]
        });
        $('.cate-archive').slick({
            nextArrow: '<button class="btn-next"><i class="fas fa-chevron-right"></i></button>',
            prevArrow: '<button class="btn-prev"><i class="fas fa-chevron-left"></i></button>',
            slidesToShow: lusion_params.lusion_number_cate,
            slidesToScroll: 1,
            rtl: $rtl,
            dots: false,
            arrows: true,
            infinite: true,
            speed: 300,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });

        $('.col-xl-9.has-sidebar .product-detail.single_1 div.entry-summary form.cart').append($('.col-xl-9.has-sidebar .product-detail.single_1 div.entry-summary .yith-wcwl-add-to-wishlist'));
        $('.product-detail.single_2 div.entry-summary form.grouped_form').append($('.product-detail.single_2 div.entry-summary .yith-wcwl-add-to-wishlist'));
        $('.col-xl-9.has-sidebar .product-detail.single_1 div.entry-summary .woocommerce-product-details__short-description').append($('.col-xl-9.has-sidebar .product-detail.single_1 div.entry-summary .availability'));
        $('.col-xl-9.has-sidebar .product-detail.single_1 div.entry-summary .woocommerce-product-details__short-description').append($('.col-xl-9.has-sidebar .product-detail.single_1 div.entry-summary .product_meta'));
         $('ul.product-list.products li.product').each(function () {
            $(this).find('.product-price .shopswatchinput').insertAfter($(this).find('.desc'));
       });
        var maxHeight = 0;
        var height_content_slider_sc_product = $('.home-furniture-sc-product-slider .slick-slider .slick-slide div.product-desc');
        height_content_slider_sc_product.each(function () {
            if ($(this).height() > maxHeight) maxHeight = $(this).height();
        });
        height_content_slider_sc_product.css('height', maxHeight);

        $(window).resize(function () {
            var maxHeight = 0;
            var height_content_slider_sc_product = $('.home-furniture-sc-product-slider .slick-slider .slick-slide div.product-desc');
            height_content_slider_sc_product.each(function () {
                if ($(this).height() > maxHeight) maxHeight = $(this).height();
            });
            height_content_slider_sc_product.css('height', maxHeight);
        });
    }
    function lusionLoadMoreProduct() {
        //Loadmore Ajax
        if (lusion_params.lusion_woo_enable == 'yes') {
            $('.apr-product').find('.products').removeClass('pagination_infinite_scrolling');
            if ($('.products').hasClass('pagination_infinite_scrolling') || $('.products').hasClass('pagination_load_more') ) {
                $('.woocommerce-pagination').addClass('pagination_scrolling');
                $('.popup-sale-wapper').remove();
                var next_Selector = '.next' ;
                var item_Selector = '.product' ;
                if($('#site-main .products').hasClass('pagination_infinite_scrolling')){
					var content_Selector = '.pagination_infinite_scrolling.products';
				}else if($('#site-main .apr-product').hasClass('products-by-categories')){
					var content_Selector = '.products-by-categories .products';
				}else{
					var content_Selector = '';
				}
                var image_loader = '<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>';
                var scroll_options = $.extend(
                    {
                        scroll_item_selector   : false,
                        scroll_content_selector: false,
                        scroll_next_selector   : false,
                        is_shop        : false,
                        loader         : false
                    },
                    {
                    'scroll_item_selector'      : item_Selector,
                    'scroll_content_selector'   : content_Selector,
                    'scroll_next_selector'      : next_Selector,
                    'is_shop'           : true,
                    'loader'            : image_loader
                    }
                    ),
                    under_loading  = false,
                    loading_finished = false,
                    target_url  = $( scroll_options.scroll_next_selector ).attr( 'href' );
                if( !$( scroll_options.scroll_next_selector ).length  && !$( scroll_options.scroll_item_selector ).length && !$( scroll_options.scroll_content_selector ).length )
                {
                    loading_finished = true;
                }

                if($( scroll_options.scroll_next_selector ).length == 0){ loading_finished = true; return; }

                var first_product_unit  = $( scroll_options.scroll_content_selector ).find( scroll_options.scroll_item_selector ).first(),
                    columns = first_product_unit.nextUntil( '.first-item', scroll_options.scroll_item_selector ).length + 1;

                var call_ajax = function ()
                {
                    var last_product_unit   = $( scroll_options.scroll_content_selector ).find( scroll_options.scroll_item_selector ).last();

                    if( scroll_options.loader ){
                        $( scroll_options.scroll_content_selector ).after( '<div class="scroll-loader"><center>'+scroll_options.loader+'</center><br></div>' );
                        under_loading = true;
                    }

                    $.ajax({

                        url         : target_url,
                        dataType    : 'html',
                        success     : function (response) {

                            var obj  = $( response),
                                product_unit = obj.find( scroll_options.scroll_item_selector ),
                                next = obj.find( scroll_options.scroll_next_selector );

                            if( next.length )
                            {
                                target_url = next.attr( 'href' );
                            }
                            else
                            {
                                loading_finished = true;
                            }

                            if( ! last_product_unit.hasClass( 'last-item' ) && scroll_options.is_shop )
                            {
                                position_product_unit( last_product_unit, columns, product_unit );
                            }

                             product_unit.css({
                                'opacity':'0'
                             });

                            last_product_unit.after( product_unit );

                            $( '.scroll-loader, .popup-sale-wapper' ).remove();
                            product_unit.fadeTo(2000,1,function() { under_loading = false;});

                        }
                    });
                };

                var position_product_unit = function( last, columns, product_unit ) {

                    var off_set  = ( columns - last.prevUntil( '.last-item', scroll_options.scroll_item_selector ).length ),
                        loop    = 0;

                    product_unit.each(function () {

                        var y = $(this);
                        loop++;

                        y.removeClass('first-item');
                        y.removeClass('last-item');

                        if ( ( ( loop - off_set ) % columns ) === 0 )
                        {
                            y.addClass('first-item');
                        }
                        else if ( ( ( loop - ( off_set - 1 ) ) % columns ) === 0 )
                        {
                            y.addClass('last-item');
                        }
                    });
                };

                $( window ).on( 'scroll touchstart', function (){
                    var y       = $(this),
                        off_set  = $( scroll_options.scroll_item_selector ).last().offset();
                    if ( !under_loading  &&  !loading_finished  && y.scrollTop() >= Math.abs( off_set.top - ( y.height() - 150 ) ) )
                    {
                        call_ajax();
                    }
                });

                var wdw = $(window).width();
                if (wdw > 1024) {
                    $('.site-main .woocommerce .product-style-default ul.product-grid.products.columns-2 li.product').each(function () {
                        var widthPrice = ($('.site-main .product-style-default .product-grid.products.columns-2 li.product .price').width()) + 15;
                        $('.site-main .woocommerce .product-style-default ul.product-grid.products.columns-2 li.product .woocommerce-loop-product__title').css('padding-right', widthPrice + 'px');
                    });
                } else {
                    $('.site-main .woocommerce .product-style-default ul.product-grid.products.columns-2 li.product').each(function () {
                        $('.site-main .woocommerce .product-style-default ul.products.columns-2 li.product .woocommerce-loop-product__title').css('padding-right', '0px');
                    });
                }

            }

        }
    }

    function lusionGallerySlider(page) {
         $(".list_post_sticky").on('init reInit afterChange', function(event, slick, currentSlide, nextSlide) {

          var $elSlide = $(slick.$slides[currentSlide]);

          var sliderObj = $elSlide.closest('.slick-slider');

          if (sliderObj.hasClass('blog-gallery')) {
            return;
          }

          var pager = (currentSlide ? currentSlide : 0) + 1 + "/6";

        });


        $('.item').each(function () {
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
            });
        });
        $('.item-page' + page).each(function () {
            if ($(this).find('.blog-img').hasClass('blog-gallery')) {
                var id = $(this).find('.blog-img').attr('id');
                $('#' + id).slick({
                    dots: false,
                    arrows: true,
                    adaptiveHeight: false,
                    nextArrow: '<button class="btn-next"><span class="theme-icon-next"></span></button>',
                    prevArrow: '<button class="btn-prev"><span class="theme-icon-back"></span></button>',
                    rtl: $rtl,
                    infinite: true,
                    autoplay: false,
                    autoplaySpeed: 2000,
                    slidesToShow: 1,
                    slidesToScroll: 1
                });
            }
        });
         $('.list_post_sticky.blog-list-style-3').slick({
            dots: false,
            arrows: true,
            adaptiveHeight: false,
            nextArrow: '<button class="btn-next"><span class="theme-icon-next"></span></button>',
            prevArrow: '<button class="btn-prev"><span class="theme-icon-back"></span></button>',
            rtl: $rtl,
            infinite: true,
            autoplay: false,
            autoplaySpeed: 2000,
            slidesToShow: 1,
            slidesToScroll: 1,
        });
        $('.slider.blog-gallery').on('touchstart touchmove mousemove mouseenter', function(e) {
          $('.list_post_sticky > .item').slick('slickSetOption', 'swipe', false, false);
        });

        $('.slider.blog-gallery').on('touchend mouseover mouseout', function(e) {
          $(' .list_post_sticky > .item').slick('slickSetOption', 'swipe', true, false);
        });
        if ($('.blog-img').hasClass('blog-gallery')) {
            $('.blog-shortcode .blog-gallery').slick({
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
        }

    }

    function lusionPostGallery() {

        $('.blog-gallery-single').slick({
            dots: false,
            arrows: true,
            nextArrow: '<button class="btn-next"><span class="theme-icon-next"></span></button>',
            prevArrow: '<button class="btn-prev"><span class="theme-icon-back"></span></button>',
            rtl: $rtl,
            infinite: true,
            autoplay: false,
            autoplaySpeed: 2000,
            slidesToShow: 1,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 767,
                    settings: {
                        arrows: false,
                    }
                }
            ]
        });
         $('.portfolio-single.portfolio-layout3 .portfolio-height').slick({
            dots: false,
            arrows: true,
            nextArrow: '<button class="btn-next"><span class="theme-icon-next"></span></button>',
            prevArrow: '<button class="btn-prev"><span class="theme-icon-back"></span></button>',
            rtl: $rtl,
            infinite:false,
            slidesToShow: 1,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 767,
                    settings: {
                        arrows: false,
                    }
                }
            ]
        });


        $('.portfolio-single .post-type-archive-portfolio .portfolio-container .load-item').slick({
            dots: false,
            arrows: false,
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
    }


    // Srcoll Top
    function lusionScrollTop() {
        if ($('.scroll-to-top').length) {
            $(window).scroll(function () {
                var height = $(window).height();
                var heightNavMenu = $('.mega-menu').height();
				if ($(this).scrollTop() > height) {
					$('.sitcky-product').addClass('in-sticky');
					$('body').addClass('sticky-page');
				}else{
					$('.sitcky-product').removeClass('in-sticky');
					$('body').removeClass('sticky-page');
				}
                if ($(this).scrollTop() > $('#page:not(.fixed-header) .site-header').height() + 40) {
                    if (!$('header').hasClass('header-sticky')) {
                        $('html').removeClass('openmenu');
                    } else {
                        $('.scroll-to-top').css({bottom: "60px"});
                    }
                    if ($('header').hasClass('header-bottom')) {
                        $('.scroll-to-top').css({bottom: "90px"});
                    } else {
                        $('.scroll-to-top').css({bottom: "60px"});
                    }
                    $('html').addClass('has-scroll');
                    if (heightNavMenu > height) {
                        $('.apr-nav-menu--layout-dropdown').addClass('header-scroll');
                    }
                } else {
                    $('.scroll-to-top').css({bottom: "-100px"});
                    $('html').removeClass('has-scroll');
                    $('.apr-nav-menu--layout-dropdown').removeClass('header-scroll');
                }
            });

            $('.scroll-to-top').on('click', function () {
                $('html, body').animate({scrollTop: '0px'}, 800);
                return false;
            });
        }
    }


    // Sticky Menu
    function lusionStickyMenu() {
        var header_wp = $(".site-header");
        var header_sticky = $(".header-sticky");
        var menuH = header_wp.outerHeight();
        var current = 0;
        $(window).scroll(function () {
            if ($(this).scrollTop() <= menuH) {
                header_sticky.removeClass('is-sticky hidden-menu');
                $body.removeClass('enable-sticky');
            } else {
                var next = $(this).scrollTop();
                if ((current - next) > 0) {
                    header_sticky.addClass('is-sticky header-sticky').removeClass('hidden-menu');
                    $body.addClass('enable-sticky');
                } else {
                    header_sticky.removeClass('is-sticky').addClass('hidden-menu');
                    $body.removeClass('enable-sticky');
                }
                current = next;
            }
        });
    }

    // Megamenu
    function lusionMegamenu() {
        setTimeout(function () {
            var headerH = $(".site-header").height();
            var megamenusub = $("#page .mega-menu .megamenu");
            var height = $(window).height();
            var wdw = $(window).width();
            if (wdw > 1024) {
                for (var i = 0; i < megamenusub.length; i++) {
                    var megamenu_sub = $('.' + megamenusub[i].getAttribute('class').replace(/\s+/g, '.') + ' .megamenu_sub');
                    var getClassMegamenu = megamenusub[i].getAttribute('class');
                    if (getClassMegamenu.includes("menu_fullw") === true) {
                        megamenu_sub.offset({left: 0});
                        megamenu_sub.css('width', wdw);
                    }
                    var megamenu_sub_content = $('.' + megamenusub[i].getAttribute('class').replace(/\s+/g, '.') + ' .megamenu_sub .megamenu-content');
                    var heightMegamenu_sub = megamenu_sub.height();
                    var megamenu_subH = megamenu_sub.height();

                    if ((megamenu_subH + headerH) >= height) {
                        var megamenuH = height - headerH;
                        if (height < heightMegamenu_sub) {
                            megamenu_sub.css({
                                'height': megamenuH
                            });
                        }
                        megamenu_sub_content.slimScroll({
                            alwaysVisible: true,
                            railVisible: true,
                            railColor: '#f0f1f0',
                            distance: '0',
                            height: '100%',
                            width: '100%',
                            position: 'right',
                            size: '5px',
                        });
                    }
                }
            }
            $('.product-has-filter.product-has-filter-top .widget>div, .product-has-filter.product-has-filter-top .widget>form, .product-has-filter.product-has-filter-top .widget>ul').slimScroll({
                alwaysVisible: false,
                railVisible: false,
                railColor: '#ebeeee',
                distance: '0',
                height: '100%',
                width: '100%',
                position: 'right',
                size: '5px',
                color: '#d7d7d7',
            });
            $('.sub-cart .widget_shopping_cart_content ul.woocommerce-mini-cart').slimScroll({
                alwaysVisible: false,
                railVisible: true,
                railColor: '#ebeeee',
                distance: '0',
                height: '100%',
                width: '100%',
                position: 'right',
                size: '5px',
                color: '#d7d7d7',
            });
        }, 100);



    }



    // Submenu hover left
    function lusionFixSubMenu() {
        $('.mega-menu > li:not(.megamenu)').mouseover(function () {
            var wapoMainWindowWidth = $(window).width();
            // checks if third level menu exist
            var subMenuExist = $(this).children('.sub-menu').length;
            if (subMenuExist > 0) {
                var subMenuWidth = $(this).children('.sub-menu').width();
                var subMenuOffset = $(this).children('.sub-menu').parent().offset().left + subMenuWidth;
                // if sub menu is off screen, give new position
                if ((subMenuOffset + subMenuWidth + 50) > wapoMainWindowWidth) {
                    var newSubMenuPosition = subMenuWidth;
                    $(this).addClass('left_side_menu');
                } else {
                    var newSubMenuPosition = subMenuWidth;
                    $(this).removeClass('left_side_menu');
                }
            }
        });
    }



    // Fix Height Content
    function lusionHeightContent() {
        // Fix Height Blog
        var wdw = $(window).width();

        var heightHeader = $('.site-header').height();
        var heightFooter = $('footer').height();
        if ($(window).width() < 992) {
            if ($('.site-header').hasClass('header-bottom')) {
                $('footer').css('margin-bottom', heightHeader + 'px');
            }
        }
        if ($(window).width() > 767) {
            if ($('#page').hasClass('footer-fixed')) {
                $('#page').css('margin-bottom', heightFooter + 'px');
            }
        }
        // Fix Height menu vertical
        var height = $(window).height();
        var heightNavMenu = $('.mega-menu').height();
        var heightMenu = $('.site-header').height();
        if ($('body').hasClass('admin-bar')) {
            var wpadminbar = $('#wpadminbar').height();
            heightMenu = heightMenu + wpadminbar;
        }
        if (heightNavMenu > height) {
            $('.apr-nav-menu--layout-dropdown').addClass('header-scroll');
        }
        $('.apr-nav-menu--layout-dropdown').css({
            "height": height - heightMenu + 'px',
            "top": heightMenu
        });


        var heightHeaderItem1 = $('.header-item-1').height();
        var heightHeaderItem2 = $('.header-item-2').height();
        var heightHeaderItem4 = $('.header-item-4').height();
        var heightTotalHeaderItem = heightHeaderItem1 + heightHeaderItem2 + heightHeaderItem4;
         var heightTotalHeaderItem2 = heightHeaderItem1 + heightHeaderItem2;

        if ($(window).width() > 1025) {
            if ($('body').hasClass('admin-bar')) {
                $('.header-fullheight').css({
                    "height": height - 32 + 'px',
                });
                $('.header-item-3').css({
                    "height": height - heightTotalHeaderItem - 32 + 'px',
                });
                $('.header-item-3 .megamenu_sub').css({
                    "height": height - 32 + 'px',
                });
                $('.header-item-3 .apr-nav-menu--layout-vertical .megamenu_sub').css({
                    "top": 0 - heightTotalHeaderItem2  + 'px',
                });

            }else{
                $('.header-fullheight').css({
                    "height": height + 'px',
                });
                 $('.header-item-3').css({
                    "height": height - heightTotalHeaderItem  + 'px',
                });
                 $('.header-item-3 .megamenu_sub').css({
                    "height": height  + 'px',
                });
                 $('.header-item-3 .apr-nav-menu--layout-vertical .megamenu_sub').css({
                    "top": 0 - heightTotalHeaderItem2  + 'px',
                });
            }
        }else{
            $('.header-fullheight').removeAttr('style');
        }
        if ($(window).width() > 1025) {
            if ($('body').hasClass('admin-bar')) {
                 var heightHeaderSlide = $('.header-hslide').height();
                $('.cascade-slider_container').css({
                    "height": height -  heightHeaderSlide - 66 + 'px'
                });
            }else{
                 var heightHeaderSlide = $('.header-hslide').height();
                $('.cascade-slider_container').css({
                    "height": height -  heightHeaderSlide - 34 + 'px'
                });
            }

        }


        if (wdw < 992) {
            if (heightNavMenu > height) {
                $('.header-center').addClass('header-scroll');
            }
        }
        if (lusion_params.lusion_woo_enable == 'yes') {
            var li = $('.woocommerce  .product-style-default ul.product-grid.products.columns-2 li.product');
            for (var i = 0; i < li.length; i++) {
                var widthPrice = $('.' + $(li[i].className.trim().replace(/\s+/g, '.') + ' .product-desc .product-price .top-desc span.price').selector).width() + 15;
                if (wdw > 1024) {
                    if ($rtl == false) {
                        $('.' + li[i].className.trim().replace(/\s+/g, '.') + ' .product-desc .woocommerce-loop-product__title').css('padding-right', widthPrice + 'px');
                    } else {
                        $('.' + li[i].className.trim().replace(/\s+/g, '.') + ' .product-desc .woocommerce-loop-product__title').css('padding-left', widthPrice + 'px');
                    }
                } else {
                    if ($rtl == false) {
                        $('.' + li[i].className.trim().replace(/\s+/g, '.') + ' .product-desc .woocommerce-loop-product__title').css('padding-right', '0px');
                    } else {
                        $('.' + li[i].className.trim().replace(/\s+/g, '.') + ' .product-desc .woocommerce-loop-product__title').css('padding-left', '0px');
                    }
                }
            }

            var sc_li = $('.apr-product.product-default.price-position ul.products.slick-slider li.product');
            for (var i = 0; i < sc_li.length; i++) {
                var widthPrice = $('.' + $(sc_li[i].className.trim().replace(/\s+/g, '.') + ' .product-desc .product-price .top-desc span.price').selector).width() + 15;
                if (wdw > 1024) {
                    if ($rtl == false) {
                        $('.' + sc_li[i].className.trim().replace(/\s+/g, '.') + ' .product-desc .woocommerce-loop-product__title').css('padding-right', widthPrice + 'px');
                    } else {
                        $('.' + sc_li[i].className.trim().replace(/\s+/g, '.') + ' .product-desc .woocommerce-loop-product__title').css('padding-left', widthPrice + 'px');
                    }
                } else {
                    if ($rtl == false) {
                        $('.' + sc_li[i].className.trim().replace(/\s+/g, '.') + ' .product-desc .woocommerce-loop-product__title').css('padding-right', '0px');
                    } else {
                        $('.' + sc_li[i].className.trim().replace(/\s+/g, '.') + ' .product-desc .woocommerce-loop-product__title').css('padding-left', '0px');
                    }
                }
            }

        //swatchcolor bottom

            var sc_li_attr = $('.apr-product.product-default:not(".price-position") ul.products li.product  .product-desc .product-price');
            for (var i = 0; i < sc_li_attr.length; i++) {
                var height_swatchcolor = $('.apr-product.product-default:not(".price-position") ul.products li.product  .product-desc .product-price').eq(i).find('.shopswatchinput').height();
                if (height_swatchcolor != null) {
                    if (wdw > 1024) {
                        $('.apr-product.product-default:not(".price-position") ul.products li.product  .product-desc').eq(i).css('padding-bottom', height_swatchcolor + 'px');

                    } else {
                        $('.apr-product.product-default:not(".price-position") ul.products li.product  .product-desc').eq(i).css('padding-bottom', '0px');
                    }
                }
            }

            var sc_li_attr_style1 = $('.apr-product.product-style-1:not(".product-style-5"):not(".price-position") ul.products li.product .product-desc .product-price');
            for (var i = 0; i < sc_li_attr_style1.length; i++) {
                var height_swatchcolor2 = $('.apr-product.product-style-1:not(".product-style-5"):not(".price-position") ul.products li.product  .product-desc .product-price').eq(i).find('.shopswatchinput').height();
                if (height_swatchcolor2 != null) {
                    if (wdw > 1024) {
                        $('.apr-product.product-style-1:not(".product-style-5"):not(".price-position") ul.products li.product .product-desc').eq(i).css('padding-bottom', height_swatchcolor + 'px');

                    } else {
                        $('.apr-product.product-style-1:not(".product-style-5"):not(".price-position") ul.products li.product .product-desc').eq(i).css('padding-bottom', '0px');
                    }
                }
            }
        }

    }

    // Menu
    function lusionMenu() {

        $(".mega-menu .caret-submenu").on('click', function (e) {
            $(this).toggleClass('active');
            $(this).siblings('.sub-menu').toggle(300);
            $(this).siblings('.megamenu_sub').toggle(300);
            $(this).siblings('.cate-list').toggle(300);
            $(this).siblings('.mega-menu').toggle(300);
            $(this).parent().toggleClass('sub-menu-active');
        });

        $('ul.mega-menu > li.megamenu .menu-bottom').hide();
        $('ul.mega-menu > li.megamenu .menu-bottom').each(function () {
            var className = $(this).parent().parent().attr('id');
            if ($(this).hasClass(className)) {
                $(this).show();
            }
        });

        //Add class category
        $('.widget_categories ul').each(function () {
            if ($(this).hasClass('children')) {
                $(this).parent().addClass('cat-item-parent');
            }
        });
        if ($('div').hasClass('header-moblie-show')) {
            $('body').addClass('show-menu-bottom-fixed');
        }
        var $title_box_shipping = $(".box-shipping .title-hdwoo");
        $title_box_shipping.on('click', function () {
            var $div_shipping = $(".box-shipping .form-shipping-cs");
            if ($div_shipping.is(':hidden') === true) {

                $div_shipping.slideDown();
                $title_box_shipping.find('span').remove();
                $title_box_shipping.append('<span class= "ti-angle-up"></span>');
                $(this).find('span').remove();
                $(this).append('<span class= "ti-angle-down"></span>');
            } else {
                $div_shipping.slideUp();
                $(this).find('span').remove();
                $(this).append('<span class= "ti-angle-up"></span>');
            }
        });
        // Menu Category Sidebar
        $("<p></p>").insertAfter(".widget_product_categories ul.product-categories > li > a");
        var $p = $(".widget_product_categories ul.product-categories > li p");
        $(".widget_product_categories ul.product-categories > li:not(.current-cat):not(.current-cat-parent) p").append('<span class= "theme-icon-plus"></span>');
        $(".widget_product_categories ul.product-categories > li.current-cat p").append('<span class= "theme-icon-plus"></span>');
        $(".widget_product_categories ul.product-categories > li.current-cat-parent p").append('<span class= "theme-icon-plus"></span>');
        $(".widget_product_categories ul.product-categories > li:not(.current-cat):not(.current-cat-parent) > ul").hide();

        $(".widget_product_categories ul.product-categories > li").each(function () {
            if ($(this).find("ul > li").length == 0) {
                $(this).find('p').remove();
            }
        });


        $p.on('click', function () {
            var $accordion = $(this).nextAll('ul');

            if ($accordion.is(':hidden') === true) {

                $(".widget_product_categories ul.product-categories > li > ul").slideUp();
                $accordion.slideDown();

                $p.find('span').remove();
                $p.append('<span class= "theme-icon-plus"></span>');
                $(this).find('span').remove();
                $(this).append('<span class= "theme-icon-minus"></span>');
                $(this).parent().find('> .children').toggleClass('opening');
            } else {
                $accordion.slideUp();
                $(this).parent().find('> .children').toggleClass('opening');
                $(this).find('span').remove();
                $(this).append('<span class= "theme-icon-plus"></span>');
            }
        });

        // Menu Lever 2
        $("<p></p>").insertAfter(".widget_product_categories ul.product-categories > li > ul > li > a");
        var $pp = $(".widget_product_categories ul.product-categories > li > ul > li p");
        $(".widget_product_categories ul.product-categories > li >ul >li > ul").hide();
        $(".widget_product_categories ul.product-categories > li > ul > li p").append('<span class= "theme-icon-plus"></span>');

        $(".widget_product_categories ul.product-categories > li > ul > li").each(function () {
            if ($(this).find("ul > li").length == 0) {
                $(this).find('p').remove();
            }
        });

        $pp.on('click', function () {
            var $accordions = $(this).nextAll('ul');

            if ($accordions.is(':hidden') === true) {

                $(".widget_product_categories ul.product-categories > li > ul > li > ul").slideUp();
                $accordions.slideDown();

                $pp.find('span').remove();
                $pp.append('<span class= "theme-icon-plus"></span>');
                $(this).find('span').remove();
                $(this).append('<span class= "theme-icon-minus"></span>');
            } else {
                $accordions.slideUp();
                $(this).find('span').remove();
                $(this).append('<span class= "theme-icon-plus"></span>');
            }
        });

        $(".widget_product_categories ul.product-categories > li > ul > li").each(function () {
            if($(this).hasClass('current-cat') || $(this).hasClass('current-cat-parent')){
                $(this).find('p').nextAll('ul').slideDown();
            }
        });

        // Menu Lever 3
        $("<p></p>").insertAfter(".widget_product_categories ul.product-categories > li > ul > li > ul > li > a");
        var $ppp = $(".widget_product_categories ul.product-categories > li > ul > li > ul > li p");
        $(".widget_product_categories ul.product-categories > li > ul > li > ul > li > ul").hide();
        $(".widget_product_categories ul.product-categories > li > ul > li > ul > li p").append('<span class= "theme-icon-plus"></span>');

        $(".widget_product_categories ul.product-categories > li > ul > li > ul > li").each(function () {
            if ($(this).find("ul > li").length == 0) {
                $(this).find('p').remove();
            }
        });

        $ppp.on('click', function () {
            var $accordions = $(this).nextAll('ul');

            if ($accordions.is(':hidden') === true) {

                $(".widget_product_categories ul.product-categories > li > ul > li > ul > li > ul").slideUp();
                $accordions.slideDown();

                $ppp.find('span').remove();
                $ppp.append('<span class= "theme-icon-plus"></span>');
                $(this).find('span').remove();
                $(this).append('<span class= "theme-icon-minus"></span>');
            } else {
                $accordions.slideUp();
                $(this).find('span').remove();
                $(this).append('<span class= "theme-icon-plus"></span>');
            }
        });

        $(".widget_product_categories ul.product-categories > li > ul > li > ul > li").each(function () {
            if($(this).hasClass('current-cat') || $(this).hasClass('current-cat-parent')){
                $(this).find('p').nextAll('ul').slideDown();
            }
        });

        // Categories Blog Sidebar
        $("<p></p>").insertAfter(".widget_categories ul > li > a");
        var $p = $(".widget_categories ul > li p");
        $(".widget_categories ul > li:not(.current-cat):not(.current-cat-parent) p").append('<span class= "theme-icon-plus"></span>');
        $(".widget_categories ul > li.current-cat p").append('<span class= "theme-icon-plus"></span>');
        $(".widget_categories ul > li.current-cat-parent p").append('<span class= "theme-icon-plus"></span>');
        $(".widget_categories ul > li:not(.current-cat):not(.current-cat-parent) > ul").hide();

        $(".widget_categories ul > li").each(function () {
            if ($(this).find("ul > li").length == 0) {
                $(this).find('p').remove();
            }
        });

        $(".widget_categories ul > li").each(function () {
            if($(this).hasClass('current-cat') || $(this).hasClass('current-cat-parent')){
                if ($(this).find("ul > li").length != 0) {
                    $(".widget_categories ul > li > ul").slideUp();
                    $(this).find('p').nextAll('ul').slideDown();
                    $(this).find('p').find('span').remove();
                    $(this).find('p').append('<span class= "theme-icon-plus"></span>');
                    $(this).find('p').find('span').remove();
                    $(this).find('p').append('<span class= "theme-icon-minus"></span>');
                    $(this).find('p').parent().find('> .children').toggleClass('opening');
                }
            }
        });

        $p.on('click', function () {
            var $accordion = $(this).nextAll('ul');

            if ($accordion.is(':hidden') === true) {

                $(".widget_categories ul > li > ul").slideUp();
                $accordion.slideDown();

                $p.find('span').remove();
                $p.append('<span class= "theme-icon-plus"></span>');
                $(this).find('span').remove();
                $(this).append('<span class= "theme-icon-minus"></span>');
                $(this).parent().find('> .children').toggleClass('opening');
            } else {
                $accordion.slideUp();
                $(this).parent().find('> .children').toggleClass('opening');
                $(this).find('span').remove();
                $(this).append('<span class= "theme-icon-plus"></span>');
            }
        });

        // Menu Lever 2
        $("<p></p>").insertAfter(".widget_categories ul > li > ul > li > a");
        var $pp = $(".widget_categories ul > li > ul > li p");
        $(".widget_categories ul > li >ul >li > ul").hide();
        $(".widget_categories ul > li > ul > li p").append('<span class= "theme-icon-plus"></span>');

        $(".widget_categories ul > li > ul > li").each(function () {
            if ($(this).find("ul > li").length == 0) {
                $(this).find('p').remove();
            }
        });

        $pp.on('click', function () {
            var $accordions = $(this).nextAll('ul');

            if ($accordions.is(':hidden') === true) {

                $(".widget_categories ul > li > ul > li > ul").slideUp();
                $accordions.slideDown();

                $pp.find('span').remove();
                $pp.append('<span class= "theme-icon-plus"></span>');
                $(this).find('span').remove();
                $(this).append('<span class= "theme-icon-minus"></span>');
            } else {
                $accordions.slideUp();
                $(this).find('span').remove();
                $(this).append('<span class= "theme-icon-plus"></span>');
            }
        });

        $(".widget_categories ul > li > ul > li").each(function () {
            if($(this).hasClass('current-cat') || $(this).hasClass('current-cat-parent')){
                $(this).find('p').nextAll('ul').slideDown();
            }
        });

        // Menu Lever 3
        $("<p></p>").insertAfter(".widget_categories ul > li > ul > li > ul > li > a");
        var $ppp = $(".widget_categories ul > li > ul > li > ul > li p");
        $(".widget_categories ul > li > ul > li > ul > li > ul").hide();
        $(".widget_categories ul > li > ul > li > ul > li p").append('<span class= "theme-icon-plus"></span>');

        $(".widget_categories ul > li > ul > li > ul > li").each(function () {
            if ($(this).find("ul > li").length == 0) {
                $(this).find('p').remove();
            }
        });

        $ppp.on('click', function () {
            var $accordions = $(this).nextAll('ul');

            if ($accordions.is(':hidden') === true) {

                $(".widget_categories ul > li > ul > li > ul > li > ul").slideUp();
                $accordions.slideDown();

                $ppp.find('span').remove();
                $ppp.append('<span class= "theme-icon-plus"></span>');
                $(this).find('span').remove();
                $(this).append('<span class= "theme-icon-minus"></span>');
            } else {
                $accordions.slideUp();
                $(this).find('span').remove();
                $(this).append('<span class= "theme-icon-plus"></span>');
            }
        });
        var wdw = $(window).width();
        if (wdw > 768 && wdw < 1025) {
            $(".show-toggle-tablet.footer-menu-title + .mega-menu").hide();
            $('.show-toggle-tablet.footer-menu-title').append('<i class= "theme-icon-next"></i>');
            $('.show-toggle-tablet.footer-menu-title').click(function (e) {
                e.stopPropagation();
                if (!$(this).siblings(".show-toggle-tablet.footer-menu-title + .mega-menu").is(":visible")) {
                    $(this).find('i').remove();
                    $(this).append('<i class= "theme-icon-download"></i>');
                    $(this).parent().find(".show-toggle-tablet.footer-menu-title + .mega-menu").show();
                } else {
                    $(this).find('i').remove();
                    $(this).append('<i class= "theme-icon-next"></i>');
                    $(this).parent().find(".show-toggle-tablet.footer-menu-title + .mega-menu").hide();
                }
                ;
            });
        }
        if (wdw < 768) {
            $(".show-toggle-mb.footer-menu-title + .mega-menu").hide();
            $('.show-toggle-mb.footer-menu-title').append('<i class= "theme-icon-next"></i>');
            $('.show-toggle-mb.footer-menu-title').click(function (e) {
                e.stopPropagation();
                if (!$(this).siblings(".show-toggle-mb.footer-menu-title + .mega-menu").is(":visible")) {
                    $(this).find('i').remove();
                    $(this).append('<i class= "theme-icon-download"></i>');
                    $(this).parent().find(".show-toggle-mb.footer-menu-title + .mega-menu").show();
                } else {
                    $(this).find('i').remove();
                    $(this).append('<i class= "theme-icon-next"></i>');
                    $(this).parent().find(".show-toggle-mb.footer-menu-title + .mega-menu").hide();
                }
                ;
            });
        }
        // Vertical Menu
        if ($('.site-header').hasClass('header-2')) {
            $('html').addClass('customize-header2');
        }
        if ($('.header-language').hasClass('header-language-icon')) {
            $('html').addClass('language-icon-open');
        }
        if ($('#page').hasClass('wide')) {
            $('header').addClass('header-wide');
        }
        if ($('span').hasClass('wishlist-empty')) {
            $('html').addClass('page-empty-wishlist');
        }
        var $bdy = $('html');

        $('.menu-icon').on('click', function (e) {
            $('.overlay').addClass('overlay-menu');
            if ($bdy.hasClass('openmenu')) {
                jsAnimateMenu('close');
            } else {
                jsAnimateMenu('open');
            }
        });
        $('.close-menu').on('click', function (e) {
            if ($bdy.hasClass('openmenu')) {
                jsAnimateMenu('close');
            } else {
                jsAnimateMenu('open');
            }
        });
        $('.shopping-cart-button').on('click', function (e) {
            $('.overlay').addClass('overlay-menu');
            if ($bdy.hasClass('opencart')) {
                jsAnimateCart('close');
            } else {
                jsAnimateCart('open');
            }
        });
        var wdw = $(window).width();
        if (wdw < 1025) {
            $('.header-account .icon-login').on('click', function (e) {
                $('.overlay').addClass('overlay-menu');
                if ($bdy.hasClass('openaccount')) {
                    jsAnimateAccount('close');
                } else {
                    jsAnimateAccount('open');
                }
            });
        }
        $('.languges-flags .lang-1').on('click', function (e) {
            $('.overlay').addClass('overlay-menu');
            if ($bdy.hasClass('openlanguage')) {
                jsAnimateLanguage('close');
            } else {
                jsAnimateLanguage('open');
            }
        });
        $('a[href$="#"]').on('click', function (e) {
            e.preventDefault();
        });

        $('.overlay').on('click', function () {
            if ($('html').hasClass('openmenu')) {
                jsAnimateMenu('close');
            }
            if ($('html').hasClass('opencart')) {
                jsAnimateCart('close');
            }
            if ($('html').hasClass('openlanguage')) {
                jsAnimateLanguage('close');
            }
            if ($('html').hasClass('openaccount')) {
                jsAnimateAccount('close');
            }
            if ($('html').hasClass('openfilter')) {
                jsAnimateFilter('close');
            }
            if ($('html').hasClass('openlogin')) {
                jsAnimateLogin('close');
            }
        });

        $('.close-sub-cart').on('click', function () {
            if ($('html').hasClass('opencart')) {
                jsAnimateCart('close');
            }
        });
    }

    //Tooltip
    function lusionTooltip() {
        $('[data-toggle="tooltip"]').tooltip();

        if (lusion_params.lusion_woo_enable == 'yes') {
            $('.entry-summary a.compare.button').append('<span class= "tooltiptext">Compare</span>');
        }
    }

    // Preloader
    function lusionPreloader() {
	  $('.preloader').fadeOut(500,function(){$(this).remove();});
	}

    // FancyBox
    function lusionFancyBox() {
        $('.menu_open_box > a').fancybox({});
        $('.fancybox-link').fancybox({});
        $('img').on('hover', function (e) {
            $(this).data("title", $(this).attr("title")).removeAttr("title");
        });
    }

    //Validate Form
    function lusionValidateForm() {
        if (lusion_params.lusion_valid_form == 'yes') {
            $('#commentform').validate();
        }
    }

    function navMenuD() {
        var hasChildMenu = $('.apr-nav-menu--main').find('li:has(ul)');
        hasChildMenu.children('a').append('<span class="sub-arrow"><i class="theme-icon-next"></i></span>');
    }

    //One Page
    function lusionOnePage() {
        $('ul.mega-menu > li > a[href*="#"]:not([href="#"]), .site-header .mega-menu .children li a[href*="#"]:not([href="#"])').on('click', function () {
            $('ul.mega-menu > li > a[href*="#"]:not([href="#"]), .site-header .mega-menu .children li a[href*="#"]:not([href="#"])').removeClass('active');
            $(this).addClass('active');
            $('html').removeClass('openmenu');
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
                || location.hostname == this.hostname) {
                var target = $(this.hash),
                    target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html,body').animate({
                        scrollTop: target.offset().top - 20
                    }, 500);
                    return false;
                }
            }
        });
        if($('#fullpage').length > 0){
            $('#fullpage').fullpage({
                'scrollingSpeed': 800,
                'verticalCentered': true,
                'css3': true,
                responsiveWidth: 1025,
            });
        }
        if ($('section').hasClass('fullpage-wrapper')) {
            $('html').addClass('fullpage');
        }
    }

    // Fix Width Height Swatch Option
    function lusionColorSwatch() {
        setTimeout(function () {
            var width_sc_product = $('.apr-product.product-style-1.product-style-5 .product-top').width();
            var height_sc_product = $('.apr-product.product-style-1.product-style-5 .product-top').height();
            var width_sc_product_hover = $('.apr-product.product-style-1.product-style-5 div.wcvashopswatchlabel').width();
            var height_sc_product_hover = width_sc_product_hover * (height_sc_product / width_sc_product);
            var background_size_sc_product_hover = width_sc_product_hover + 'px ' + height_sc_product_hover + 'px';
            $(".apr-product.product-style-1.product-style-5 div.wcvashopswatchlabel").css({
                "height": height_sc_product_hover,
                "background-size": background_size_sc_product_hover
            });
        }, 1000);
    }

    // Fix Height Content
    function lusionHeightContentResize() {

        var heightHeader = $('.site-header').height();
        var heightFooter = $('footer').height();
        var wdw = $(window).width();
        if ($(window).width() < 992) {
            if ($('.site-header').hasClass('header-bottom')) {
                $('footer').css('margin-bottom', heightHeader + 'px');
            }
        }
        if ($(window).width() > 767) {
            if ($('#page').hasClass('footer-fixed')) {
                $('#page').css('margin-bottom', heightFooter + 'px');
            }
        }
        //Height banner decor
        if (wdw > 768) {
            var fix_height_banner_decor = $('.fix-height-banner-decor').height();
            var height_content_banner_decor = $('.height-content-banner-decor').height();
            var distance_difference = fix_height_banner_decor - height_content_banner_decor;
            $('.fix-height-banner-decor .height-content-banner-decor .apr-banner .bn-content').css('bottom','-'+distance_difference+'px');
        }
        // Fix height header vertical
        var height = $(window).height();
        var width = $(window).width();
        var heightNav = $('.header-sidebar').height();
        var heightNavMenu = $('.mega-menu').height();
        var heightMenu = $('.site-header').height();
        if ($('body').hasClass('admin-bar')) {
            var wpadminbar = $('#wpadminbar').height();
            heightMenu = heightMenu + wpadminbar;
        }
        var heightHeaderItem1 = $('.header-item-1').height();
        var heightHeaderItem2 = $('.header-item-2').height();
        var heightHeaderItem4 = $('.header-item-4').height();
        var heightTotalHeaderItem = heightHeaderItem1 + heightHeaderItem2 + heightHeaderItem4;
        var heightTotalHeaderItem2 = heightHeaderItem1 + heightHeaderItem2;

        if ($(window).width() > 1025) {
            if ($('body').hasClass('admin-bar')) {
                $('.header-fullheight').css({
                    "height": height - 32 + 'px',
                });
                $('.header-item-3').css({
                    "height": height - heightTotalHeaderItem - 32 + 'px',
                });
                $('.header-item-3 .megamenu_sub').css({
                    "height": height - 32 + 'px',
                });
                $('.header-item-3 .apr-nav-menu--layout-vertical .megamenu_sub').css({
                    "top": 0 - heightTotalHeaderItem2  + 'px',
                });

            }else{
                $('.header-fullheight').css({
                    "height": height + 'px',
                });
                 $('.header-item-3').css({
                    "height": height - heightTotalHeaderItem  + 'px',
                });
                 $('.header-item-3 .megamenu_sub').css({
                    "height": height  + 'px',
                });
                 $('.header-item-3 .apr-nav-menu--layout-vertical .megamenu_sub').css({
                    "top": 0 - heightTotalHeaderItem2  + 'px',
                });
            }
        }
        if ($(window).width() > 1025) {
            if ($('body').hasClass('admin-bar')) {
                 var heightHeaderSlide = $('.header-hslide').height();
                $('.cascade-slider_container').css({
                    "height": height -  heightHeaderSlide - 66 + 'px'
                });
            }else{
                 var heightHeaderSlide = $('.header-hslide').height();
                $('.cascade-slider_container').css({
                    "height": height -  heightHeaderSlide - 34 + 'px'
                });
            }

        }
        $('.apr-nav-menu--layout-dropdown').css('height', height - heightMenu + 'px');
        if (heightNav > height) {
            $('.header-ver').addClass('header-scroll');
        }
        if (width < 992) {
            if (heightNavMenu > height) {
                $('.header-center').addClass('header-scroll');
            }
        }
        // Fix Height Category Menu Home 1
        var heightSliderHomeResize = $('.slider-home .rev_slider_wrapper').height();
        if ($(window).width() > 991) {
            $('.wpb_text_column .product-categories').css('height', heightSliderHomeResize + 'px');
        }
        //Fix  padding right title product
        if (width > 1024) {
            $('.site-main .woocommerce .product-style-default ul.product-grid.products.columns-2 li.product').each(function () {
                var widthPrice = ($('.site-main .product-style-default .product-grid.products.columns-2 li.product .price').width()) + 15;
                $('.site-main .woocommerce .product-style-default ul.products.product-grid.columns-2 li.product .woocommerce-loop-product__title').css('padding-right', widthPrice + 'px');
            });
        } else {
            $('.site-main .woocommerce .product-style-default ul.products.columns-2 li.product').each(function () {
                $('.site-main .woocommerce .product-style-default ul.products.columns-2 li.product .woocommerce-loop-product__title').css('padding-right', '0px');
            });
        }

		var wdw = $(window).width();

		var li = $('.woocommerce .product-style-default ul.product-grid.products.columns-2 li.product');
		for (var i = 0; i < li.length; i++) {
			var widthPrice = $('.' + $(li[i].className.trim().replace(/\s+/g, '.') + ' .product-desc .product-price .top-desc span.price').selector).width() + 15;
			if (wdw > 1024) {
				if ($rtl == false) {
					$('.' + li[i].className.trim().replace(/\s+/g, '.') + ' .product-desc .woocommerce-loop-product__title').css('padding-right', widthPrice + 'px');
				} else {
					$('.' + li[i].className.trim().replace(/\s+/g, '.') + ' .product-desc .woocommerce-loop-product__title').css('padding-left', widthPrice + 'px');
				}
			} else {
				if ($rtl == false) {
					$('.' + li[i].className.trim().replace(/\s+/g, '.') + ' .product-desc .woocommerce-loop-product__title').css('padding-right', '0px');
				} else {
					$('.' + li[i].className.trim().replace(/\s+/g, '.') + ' .product-desc .woocommerce-loop-product__title').css('padding-left', '0px');
				}
			}
		}

		var sc_li = $('.apr-product.product-default.price-position ul.product-grid.products.columns-2.slick-slider li.product');
		for (var i = 0; i < sc_li.length; i++) {
			var widthPrice = $('.' + $(sc_li[i].className.trim().replace(/\s+/g, '.') + ' .product-desc .product-price .top-desc span.price').selector).width() + 15;
			if (wdw > 1024) {
				if ($rtl == false) {
					$('.' + sc_li[i].className.trim().replace(/\s+/g, '.') + ' .product-desc .woocommerce-loop-product__title').css('padding-right', widthPrice + 'px');
				} else {
					$('.' + sc_li[i].className.trim().replace(/\s+/g, '.') + ' .product-desc .woocommerce-loop-product__title').css('padding-left', widthPrice + 'px');
				}
			} else {
				if ($rtl == false) {
					$('.' + sc_li[i].className.trim().replace(/\s+/g, '.') + ' .product-desc .woocommerce-loop-product__title').css('padding-right', '0px');
				} else {
					$('.' + sc_li[i].className.trim().replace(/\s+/g, '.') + ' .product-desc .woocommerce-loop-product__title').css('padding-left', '0px');
				}
			}
		}

		//swatchcolor bottom
		var sc_li_attr = $('.apr-product.product-default:not(".price-position") ul.products li.product  .product-desc .product-price');
		for (var i = 0; i < sc_li_attr.length; i++) {
			var height_swatchcolor = $('.apr-product.product-default:not(".price-position") ul.products li.product  .product-desc .product-price').eq(i).find('.shopswatchinput').height();
			if (height_swatchcolor != null) {
				if (wdw > 1024) {
					$('.apr-product.product-default:not(".price-position") ul.products li.product  .product-desc').eq(i).css('padding-bottom', height_swatchcolor + 'px');

				} else {
					$('.apr-product.product-default:not(".price-position") ul.products li.product  .product-desc').eq(i).css('padding-bottom', '0px');
				}
			}
		}

		var sc_li_attr_style1 = $('.apr-product.product-style-1:not(".product-style-5"):not(".price-position") ul.products li.product .product-desc .product-price');
		for (var i = 0; i < sc_li_attr_style1.length; i++) {
			var height_swatchcolor2 = $('.apr-product.product-style-1:not(".product-style-5"):not(".price-position") ul.products li.product  .product-desc .product-price').eq(i).find('.shopswatchinput').height();
			if (height_swatchcolor2 != null) {
				if (wdw > 1024) {
					$('.apr-product.product-style-1:not(".product-style-5"):not(".price-position") ul.products li.product .product-desc').eq(i).css('padding-bottom', height_swatchcolor + 'px');

				} else {
					$('.apr-product.product-style-1:not(".product-style-5"):not(".price-position") ul.products li.product .product-desc').eq(i).css('padding-bottom', '0px');
				}
			}
		}
    }

    // Sticky Sidebar For Single Product Layout 4
    function lusionStickySidebar() {
        var $bdy = $('html');
        var wdw = $(window).width();
        if (wdw < 1200) {
            $('.product-has-filter:not(.product-has-filter-top) .btn-filter-product').on('click', function (e) {
                $('.overlay').addClass('overlay-menu');
                if ($bdy.hasClass('openmenu')) {
                    jsAnimateFilter('close');
                } else {
                    jsAnimateFilter('open');
                }
            });
        }
    }

    // Sticky Sidebar For Single Portfolio
    function lusionStickySidebarPortfolio() {
        var wdw = $(window).width();
        if (wdw > 575) {
            if ($('.portfolio-single .portfolio-content.col-xl-6.col-md-6 .portfolio-desc').height() < $('.portfolio-single .portfolio-gallery-single.portfolio-gallery-single-img .portfolio-height').height()) {
                $('.portfolio-single .portfolio-content.col-xl-6.col-md-6 .portfolio-desc').stick_in_parent({offset_top: 100});
            }
        }
        if (wdw > 575) {
            if ($('.portfolio-single .portfolio-content.col-xl-6.col-md-6 .portfolio-desc').height() > $('.portfolio-single .portfolio-gallery-single.portfolio-gallery-single-img .portfolio-height').height()) {
                $('.portfolio-single .portfolio-gallery-single.portfolio-gallery-single-img .portfolio-height').stick_in_parent({offset_top: 100});
            }
        }
        if (wdw > 992) {
            if ($('.checkout_content-right').height() > $('.checkout_content-right .checkout-col-right').height() ) {
                $('.checkout_content-right .checkout-col-right').stick_in_parent({offset_top: 130});
            }
        }
        if (wdw > 1200) {
            var height_cart_left = $('.cart-left').height();
            var height_cart_right = $('.cart-right').height();
            if ($('.cart-left').height() < $('.cart-right').height() ) {
                var height_margin = height_cart_left - height_cart_right - 50;
                $('.page.woocommerce-cart .box-shipping-cs.box-shipping-large').css('margin-top', height_margin + 'px');
            }
        }
        if (wdw > 768) {
            if ($('.single_4 .product-detail-summary').height() > $('.single_4 .product-detail-summary .entry-summary').height() ) {
                $('.single_4 .product-detail-summary .entry-summary').stick_in_parent({offset_top: 130});
            }
        }

        $('a.showlogin').click(function(){
            $('html').addClass('open-login');
            $('html').removeClass('close-coupon-overlay');
        });
        $('a.showcoupon').click(function(){
            $('html').addClass('open-coupon');
        });
        $(".overlay").on('click', function () {
               $('html').removeClass('open-login');
               $('html').addClass('close-login');
               $('html').removeClass('open-coupon');
               $('html').addClass('close-coupon');
         });
         $(".woocommerce-form-coupon button.button").on('click', function () {
              $('html').addClass('close-coupon-overlay');
              $('html').removeClass('open-coupon');
              $('html').removeClass('open-login');
         });

    }

    function lusionInsertTags() {
        $(window).load(function () {
            $(".open-newsletter").on('click', function () {
                $('.mc4wp-form').show();
            });

            $('.close-newsletter').on('click', function () {
                $('.mc4wp-form').hide();
            });
            $('.close-popup').on('click', function () {
                $('.popup-account, .popup-newsletter, .fancybox-is-open').hide();
                $('.fancybox-is-open').css('display','none');
            });
        });
        $('.comment-item').each(function () {
            var container = $(this);
            container.find('.wpulike.wpulike-default ').appendTo(container.find('.comment-actions'));

        });
        $('#respond').find('#reply-title').appendTo($('#respond').find('.comment-form-rating'));
        if ($('.elementor-toggle-icon').hasClass('elementor-toggle-icon-left')) {
            $('.elementor-toggle').addClass('elementor-toggle-left');
        }
        if ($('.elementor-toggle-icon').hasClass('elementor-toggle-icon-right')) {
            $('.elementor-toggle').addClass('elementor-toggle-right');
        }

        $(".tooltip").removeClass('.bs-tooltip-bottom');
        $('.text-content-language').each(function () {
            $(".tm-contact-widget").removeAttr("id");
            $(".tm-social-widget").removeAttr("id");
        });

        $('.header-language-icon').each(function () {
            var headerLanguage = $('.header-language-icon .language-content').detach();
            var Page = $('#page');
            Page.before(headerLanguage);

        });

        if ($('div').hasClass('.elementor-widget-video ')) {
            $('body').addClass('show_elememtor-lightbox');
        }
    }

    // Search box
    function lusionSearchBox() {

        $('.toggle-search').on('click', function (e) {
            e.preventDefault();
            $('.search-box').slideToggle();
            $('.search-box').parent().append('<div class="overlay"></div>');
        });

        $('#page').on('click', '.close-search-box', function () {
            $('.search-box').slideToggle();
            $('.search-box + .overlay').remove();
            $('.not-show-field .search-box .search-form .search-input').val('');
            $('.not-show-field .search-box .search-results-wrapper').css('display','none');
        });

        $('#page').on('click', '.search-box + .overlay', function () {
            $('.search-box').slideToggle();
            $('.search-box + .overlay').remove();
            $('.not-show-field .search-box .search-form .search-input').val('');
            $('.not-show-field .search-box .search-results-wrapper').css('display','none');
        });

        $(".product-number > .arrow-item").on("click", function () {
            $('#order_review tbody').slideToggle();
            $(this).toggleClass("theme-icon-download active");
        });
    }

    function lusionHandlerPageNotFound() {
        var height = $(window).height();
        var width = $(window).width();
        var page_404 = $('.error-page');
        var page_404_ad_bar = $('.error-page').hasClass('admin-bar');
        var coming_soon_ad_bar = $('.content-coming-soon').hasClass('admin-bar');
        var h_content = $('.coming-soon').height();
        var h_content_404 = $('.page-content-404').height();
        if (height <= h_content_404) {
            page_404.css({
                'min-height': h_content_404 + 50
            });
        } else {
            if (page_404_ad_bar && width <= 599) {
                page_404.css({
                    'min-height': height - 46
                });
            } else {
                page_404.css({
                    'min-height': height
                });
            }
        }
        if (height <= h_content) {
            $('.content-coming-soon .coming-soon-container').css({
                'min-height': h_content + 50
            });
        } else {
            if (coming_soon_ad_bar && width <= 768) {
                $('.content-coming-soon .coming-soon-container').css({
                    'min-height': height - 14
                });
            } else {
                $('.content-coming-soon .coming-soon-container').css({
                    'min-height': height
                });
            }
        }
    }
	// Sale popup
	function getCookie(cname) {
		var name = cname + "=";
		var ca = document.cookie.split(';');
		for(var i=0; i<ca.length; i++) {
			var c = ca[i];
			while (c.charAt(0)==' ') c = c.substring(1);
			if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
		}
		return "";
	}

	function lusionRecommendedProducts() {
		var time = lusion_params.popup_sale_time_load;
		if(getCookie('lusion_recommended_product')!='nevershow'){
			setTimeout(function () {
				$('.popup-sale-wapper').addClass('active');
			}, time);

		}
		$('.close-box, .popup-sale-wapper .close-popup').on('click', function () {
			$('.popup-sale-wapper').removeClass('active');
			closeRecommendedProductsPopup();
		});
	}

	function closeRecommendedProductsPopup(){
		var d = new Date();
		var time = lusion_params.popup_sale_time_load_close;
		d.setTime(d.getTime() + (time));
		var expires = "expires="+d.toUTCString();
		document.cookie = 'lusion_recommended_product' + "=" + 'nevershow' + "; " + expires;
	}


	function lusionPopup() {
		if(getCookie('apr_newsletter_popup')!='nevershow'){
			var delay = 300;
			var $form = $('form');
			$("input#not_show_popup_again").change(function () {
				if ($(this).is(":checked")) {
					document.cookie = "dont_show = Don't show this popup again";
				}
			});
			if (getCookie('dont_show')) {
				$(".popup-newsletter, #list-builder").hide();
			} else {
				setTimeout(function(){
					$("#list-builder").delay(delay).fadeIn("fast", function (e) {
						$(".popup-newsletter").fadeIn("fast", function (e) {
						});
					});

					$(".close-popup").on('click', function (e) {
						$(".popup-newsletter, #list-builder, .fancybox-is-open").hide();
					});
				}, 5000);
				closePopup();
			}
		}
	}

	function closePopup(){
		var d = new Date();
		d.setTime(d.getTime() + (24*60*60*1000*365));
		var expires = "expires="+d.toUTCString();
		document.cookie = 'apr_newsletter_popup' + "=" + 'nevershow' + "; " + expires;
	}

    function lusionFeatures() {
        //features
        var li = $('.features-pagination .elementor-icon-list-item');
        for (var i = 0; i < li.length; i++) {
            var href = $(li[i]).find('a').attr('href');
            var url = location.href;
            if (href == url) {
                $(li[i]).addClass('active');
            }
        }
        $('.header-address address').each(function () {
            var link = "<a href='http://maps.google.com/maps?q=" + encodeURIComponent($(this).text()) + "' target='_blank'>" + '<i class="theme-icon-pin"></i>' + $(this).text() + "</a>";
            $(this).html(link);
        });
    }

    function facemask_section2() {
        if ($(window).width() < 1025) {
            $('.fm-section2 .elementor-container').slick({
                dots: true,
                arrows: false,
                infinite: true,
                speed: 300,
                slidesToShow: 2,
                slidesToScroll: 2,
                centerMode: true,
                centerPadding: '58px',
                responsive: [
                    {
                        breakpoint: 1025,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2,
                            centerMode: true,
                            centerPadding:'58px',
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            centerMode: true,
                            centerPadding: '58px',
                        }
                    }
                ]
            });
        }
    }

    /**
     * DOMready event.
     */

    $(document).ready(function () {
        lusionWoocommer();
        lusionLoadMoreProduct();
        lusionAccordion();
        lusionStickyMenu();
        lusionMenu();
        if (lusion_params.popup_newsletter_show == '1') {
            lusionPopup();
        }
        lusionFixSubMenu();
        lusionTooltip();
        lusionPreloader();
        lusionPostGallery();
        navMenuD();
        if (lusion_params.lusion_fancybox_enable == 'yes') {
            lusionFancyBox();
        }
        lusionValidateForm();
        lusionOnePage();
        lusionStickySidebar();
        lusionStickySidebarPortfolio();
        lusionAutocompleteSearch();
        lusionmoveBackground();
        lusionInsertTags();
        lusionSearchBox();
        lusionHandlerPageNotFound();
        // lusionMegamenu();
        lusionFeatures();
        facemask_section2();

		if(lusion_params.popup_sale_show = 1){
			lusionRecommendedProducts();
		}
        var slick_slider = $('.slick-slider.product-grid');
        $(".slick-slide:not(.slick-active)").removeClass('is-slick-active');
        slick_slider.find('.slick-active').last().addClass('is-slick-active');
        slick_slider.on('beforeChange', function (event, slick, currentSlide, nextSlide) {
            $(this).find('.slick-active').removeClass('is-slick-active');
        });
        slick_slider.on('afterChange', function (event, slick, currentSlide, nextSlide) {
            $(this).find('.slick-active').last().addClass('is-slick-active');
        });

		$('.slider-icon-box').slick('unslick');

		$('.slider-banner-landing-valentine > .elementor-container > .elementor-row').slick({
				slidesToShow: 3,
				slidesToScroll:1,
				row:1,
				dots:true,
				arrows: false,
				responsive: [
					{
						breakpoint: 1200,
						settings: {
							slidesToShow: 2,
						}
					},
					{
						breakpoint: 767,
						settings: {
							slidesToShow: 1,
						}
					},
				]
		});
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
        $('.slide-top-cate .elementor-container').slick({
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
                        slidesToShow: 2,
                    }
                },
                {
                    breakpoint: 480.2,
                    settings: {
                        slidesToShow: 1,
                    }
                },
            ]
        });
        $('.flower-mothers-day-slider > .elementor-container > .elementor-row').slick({
            slidesToShow: 3,
            slidesToScroll:1,
            row:1,
            dots: false,
            arrows: false,
            centerMode: true,
            centerPadding: '0px',
            responsive: [
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 1,
                        centerPadding: '24px',
                        dots: true,
                    }
                },
            ]
        });
		if ( /^((?!chrome|android).)*safari/i.test(navigator.userAgent)) {
			$('body').addClass('safari');
		}
        var lFollowX = 0,
            lFollowY = 0,
            x = 0,
            y = 0,
            friction = 1 / 30;

        function lusionmoveBackground() {
          x += (lFollowX - x) * friction;
          y += (lFollowY - y) * friction;

          var translate = 'translate(' + x + 'px, ' + y + 'px) scale(1.1)';

          $('.hover-on-mouse > .elementor-widget-container').css({
            '-webit-transform': translate,
            '-moz-transform': translate,
            'transform': translate
          });
          window.requestAnimationFrame(lusionmoveBackground);
        }

        $(window).on('mousemove click', function(e) {

          var lMouseX = Math.max(-100, Math.min(100, $(window).width() / 2 - e.clientX));
          var lMouseY = Math.max(-100, Math.min(100, $(window).height() / 2 - e.clientY));
          lFollowX = (30 * lMouseX) / 100; // 100 : 12 = lMouxeX : lFollow
          lFollowY = (15 * lMouseY) / 100;

        });
    });
    $(window).resize(function () {
        lusionHeightContent();
        lusionHeightContentResize();
        lusionStickySidebarPortfolio();
        lusionHandlerPageNotFound();
        // lusionMegamenu();
        lusionColorSwatch();
        facemask_section2();
    });
    $(window).load(function () {
		lusionGallerySlider();
        lusionScrollTop();
        lusionColorSwatch();
        lusionStickySidebarPortfolio();
		lusionHeightContent();
    });
})(jQuery);

function jsAnimateCart(tog) {
    if (tog == 'open') {
        jQuery('html').addClass('opencart');
    }
    if (tog == 'close') {
        jQuery('html').removeClass('opencart');
    }
}

function jsAnimateAccount(tog) {
    if (tog == 'open') {
        jQuery('html').addClass('openaccount');
    }
    if (tog == 'close') {
        jQuery('html').removeClass('openaccount');
    }
}

function jsAnimateLanguage(tog) {
    if (tog == 'open') {
        jQuery('html').addClass('openlanguage');
    }
    if (tog == 'close') {
        jQuery('html').removeClass('openlanguage');
    }
}

function jsAnimateMenu(tog) {
    if (tog == 'open') {
        jQuery('html').addClass('openmenu');
    }
    if (tog == 'close') {
        jQuery('html').removeClass('openmenu');
    }
}

function jsAnimateFilter(tog) {
    if (tog == 'open') {
        jQuery('html').addClass('openfilter');
    }
    if (tog == 'close') {
        jQuery('html').removeClass('openfilter');
    }
}
function jsAnimateLogin(tog) {
    if (tog == 'open') {
        jQuery('html').addClass('openlogin');
    }
    if (tog == 'close') {
        jQuery('html').removeClass('openlogin');
    }
}
