(function ($) {
    "use strict";
	function lusionSalepopup() {
		var time_load = lusion_params.sale_popup_time_load;
		var time_load_item = lusion_params.sale_popup_time_load_item;
		var time_load_speed = Number(time_load) + Number(time_load_item);
		$('.x-close').on('click', function(){
			$('.sale-popup').remove();
		});
		var counter = 0;
		setInterval(function(){ 
			$('.sale-popup .product-items .item').removeClass('actived');
			var c = counter % $('.sale-popup .product-items .item').length;
			++counter;	
			setTimeout(function(){
				$('.sale-popup .product-items .item').eq(c).addClass('actived');
			}, time_load);
		}, time_load_speed);
	}
    $(document).ready(function () {
        if(lusion_params.sale_popup_show = 1){
			lusionSalepopup();
		}
    });
})(jQuery);