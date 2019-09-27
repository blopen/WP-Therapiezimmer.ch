(function ($) {
    $(document).ready(function () {
        $('[data-play-video]').on('click', function () {
            var id = $(this).attr('data-play-video');
            $('[data-video-id="' + id + '"]').get(0).play();
            $(this).addClass('faded');
            $(this).parent().find('[data-uk-img]').addClass('faded');
        });
    });
})(jQuery);
