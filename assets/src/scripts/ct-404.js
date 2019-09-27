(function ($) {
    $(window).on('load.404', function () {
        var count = 10;
        var counter = null;

        var timer = function () {
            count = count - 1;
            $('[data-no-found-counter-index]').text(count);
            if (count === 1) {
                clearInterval(counter);
                window.location.href = '/';
            }
        }

        if ($('body').hasClass('error404')) {
            counter = setInterval(timer, 1000);
        }

    });
})(jQuery);
