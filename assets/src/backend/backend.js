(function ($) {
    $(document).ready(function () {
        $('#page_template').on('change', function () {
            if (this.value != 'template-pagebuilder.php') {
                tinyMCE.get('content').setContent('');
            }
        });

        //TOOLTIP
        if ($('.ct-acf-wrapper')[0]) {

            $('.ct-acf-wrapper').parent().parent().parent().addClass('ct-acf-wrapper-block');

            $('.ct-acf-wrapper .acf-label label').each(function () {
                if ($(this).next().hasClass('description')) {
                    $(this).append('<span class="dashicons-before dashicons-editor-help"></span>');
                    $(this).next().hide();
                }
            });

            $('.ct-acf-wrapper .dashicons-before').mouseenter(function () {
                $(this).parent().next().css('display', 'inline-block');
            }).mouseleave(function () {
                $(this).parent().next().css('display', 'none');
            });

        }

    });
})(jQuery);
