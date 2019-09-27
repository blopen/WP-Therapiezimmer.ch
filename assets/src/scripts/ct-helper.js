(function ($) {
    $.fn.isInViewport = function (tolerance) {
        if (typeof tolerance !== 'number') {
            tolerance = 0;
        }

        if ($(this).length > 0) {
            var elementTop = $(this).offset().top - tolerance;
            var elementBottom = elementTop + $(this).height() + tolerance;
            var viewportTop = $(window).scrollTop();
            var viewportBottom = viewportTop + $(window).height();

            return elementBottom > viewportTop && elementTop < viewportBottom;
        }

        return false;
    };
})(jQuery);