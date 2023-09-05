(function ($) {
    "use strict";
    function lusionComingSoonCountdown() {
        if (lusion_params.coming_soon_countdown) {
            $("#clock_coming_soon").countdown(lusion_params.coming_soon_countdown, function (event) {
                $(this).html(event.strftime(''
                    + '<div class="countdown-section"><div class="countdown-number"><span>%D</span></div><div class="countdown-label">Days</div></div>'
                    + '<div class="countdown-section"><div class="countdown-number"><span>%H</span></div><div class="countdown-label">Hours</div></div>'
                    + '<div class="countdown-section"><div class="countdown-number"><span>%M</span></div><div class="countdown-label">Minutes</div></div>'
                    + '<div class="countdown-section"><div class="countdown-number"><span>%S</span></div><div class="countdown-label">Secs</div></div>'));
            });
        }
    }
    $(document).ready(function () {
        lusionComingSoonCountdown();
      });
})(jQuery);