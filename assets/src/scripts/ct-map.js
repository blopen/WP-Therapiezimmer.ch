mapboxgl.accessToken = 'pk.eyJ1IjoiY3ViZXRlY2giLCJhIjoiY2p1Y3A4OTN5MGhtYjQzcGRqMmM5djNjdiJ9.fGvz8ymLZ1Pd6Cmzo2VFxQ';
(function ($) {
    var once = true;
    $(window).on('load scroll', function () {
        if ($('[data-map]').isInViewport(500) && once) {
            initializeMap();
            once = false;
        }
    });

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
            var map = new mapboxgl.Map({
                container: mapId, // container id
                style: localized.MapboxStylePath, // defined in ScriptController
                center: [latitude, longitude], // starting position [lng, lat]
                zoom: 15, // starting zoom
                minZoom: 7, maxZoom: 18
            });
            //geojson for marker cordi
            var geojson = {
                type: 'FeatureCollection', features: [{
                    type: 'Feature', geometry: {
                        type: 'Point', coordinates: [latitude, longitude]
                    }
                }]
            };

            geojson.features.forEach(function (marker) {
                // create a HTML element for each feature
                var el = document.createElement('div');
                el.className = 'marker uk-icon';
                el.setAttribute('data-uk-icon', 'icon: location; ratio: 3');
                // make a marker for each feature and add to the map
                new mapboxgl.Marker(el)
                 .setLngLat(marker.geometry.coordinates)
                 .addTo(map);
            });

            maps.push(map);
        });
    }

})(jQuery);