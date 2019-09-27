(function ($) {
    $(document).ready(function () {
        console.log('66');
        $('.tz-burger').on('click', function(){
            console.log('666');
          $('.uk-navbar.tz-navbar-mobile').toggleClass('open');
          var position = $('a.ct-menu-link.uk-active.active').position();
            console.log(position);
            $('.tz-burger').css({top: position.top});
        });
    });
})(jQuery);
