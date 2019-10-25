(function ($) {
    $(document).ready(function () {
        $('.tz-burger').on('click', function(){
          $('.uk-navbar.tz-navbar-mobile').toggleClass('open');
          var position = $('a.ct-menu-link.uk-active.active').position();
            console.log(position);
            $('.tz-burger').css({top: position.top});
        });
    });
})(jQuery);