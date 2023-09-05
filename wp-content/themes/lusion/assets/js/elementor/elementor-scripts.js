(function ($) {
    "use strict";

    function NavMenu() {
        var MenuMobile = $('.menu-dropdown').detach();
        var Page = $('#page');
        Page.before(MenuMobile);
        var timeout = null;
        $('.elementor-search-form__input').keyup(function(){ // catch event when typing search keyword
            clearTimeout(timeout); // clear time out
            timeout = setTimeout(function (){
                call_ajax(); // Call the ajax function
            }, 500);
        });
        function call_ajax(){ // Initialize the ajax search function
            var form = $('.elementor-search-form');
            var data = $('.search-ajax').val();
            if (data.length > 3){
                $.ajax({
                    type: 'POST',
                    async: true,
                    url: lusion_params.ajax_url,
                    data: {
                        'action': 'Product_filters',
                        'data': data
                    },
                    beforeSend:function () {
                        form.addClass('search-loading');
                    },
                    success: function (data) {
                        // Show returned data
                        $('.search-results-wrapper').html(data);
                        $('.search-results-wrapper').slideDown( "slow" );
                        form.removeClass('search-loading');
                    }
                })
            }else {
                $('.search-results-wrapper').stop().slideUp( "slow" ).empty();
            }
        }
    }

    function Category_dropdown(){

        $(".category-dropdown").on({
            mouseenter: function () {
                $('.list-cate').stop().slideDown();
            },
            mouseleave: function () {
                $('.list-cate').stop().slideUp();
            }
        });
    }
    $(window).ready(function () {
        NavMenu();
        Category_dropdown();
    });

})(jQuery);