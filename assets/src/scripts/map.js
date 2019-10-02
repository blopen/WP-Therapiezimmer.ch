(function ($) {
    $(document).ready(function () {
        var once = true;
        $(window).on('load scroll', function () {
            if ($('[data-map]').isInViewport(500) && once) {
                initializeMap();
                once = false;
            }
        });
    ///next mission remov googel map leichen
        function initializeMap() {
            var mapElements = $('[data-map]');
    
            if (mapElements.length < 1) {
                return;
            }
    
            var maps = new Array();
            var mapId;
            var longitude;
            var latitude;
    
            mapElements.each(function () {
                mapId = $(this).attr('id');
                longitude = $(this).attr('data-map-lon');
                latitude = $(this).attr('data-map-lat');
                var map = new ol.Map({
                    target: mapId,
                    layers: [
                      new ol.layer.Tile({
                        source: new ol.source.OSM()
                      })
                    ],
                    view: new ol.View({
                      center: ol.proj.fromLonLat([latitude, longitude]),
                      zoom: 14
                    })
                  });
                maps.push(map);
            });
        }
    
    });
})(jQuery);