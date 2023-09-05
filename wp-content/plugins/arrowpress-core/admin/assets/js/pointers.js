;(function($) {

    $(document).ready(function() {
        arrowpress_open_pointer(0);
        function arrowpress_open_pointer(i) {
            var pointer = arrowpress_pointers.pointers[i];
            var options = $.extend( pointer.options, {
                close: function() {
                    $.post( ajaxurl, {
                        pointer: pointer.pointer_id,
                        action: 'dismiss-wp-pointer'
                    });
                }
            });

            $(pointer.target).pointer( options ).pointer('open');
        }
    });
})(jQuery);