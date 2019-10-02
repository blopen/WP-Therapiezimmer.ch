/*jshint esversion: 6 */
window.UIkit = require('uikit');
require('uikit/dist/js/uikit-icons');
window.mapboxgl = require('mapbox-gl');

require('./ct-helper');
require('./ct-404');
require('./ct-video');
require('./map');

(function ($) {
    $(document).ready(function () {
        window.UIkit.icon('[data-uk-icon]', {});
    });
})(jQuery);
