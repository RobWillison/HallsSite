function initMap() {
    var customMapType = new google.maps.StyledMapType([
        {
            stylers: [
                {hue: '#3E4081'},
                {visibility: 'simplified'},
                {gamma: 0.5},
                {weight: 0.5}
            ]
        },
        {
            elementType: 'labels',
            stylers: [{visibility: 'off'}]
        },
        {
            featureType: 'all',
            stylers: [{color: '#6887A0'}]
        },
        {
            featureType: 'water',
            stylers: [{color: '#EBF5F9'}]
        },
        {
            featureType: 'road',
            stylers: [{color: '#3E4081'}]
        }
    ], {
        name: 'Custom Style'
    });
    var customMapTypeId = 'custom_style';

    var map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 51.5032510, lng: -0.1278950},
        zoom: 6,
        zoomControl: false,
        mapTypeControl: false,
        scaleControl: false,
        streetViewControl: false,
        rotateControl: false,
        fullscreenControl: false,
        mapTypeControlOptions: {
            mapTypeIds: ['roadmap', customMapTypeId]
        }
    });

    setUpHallMarkers(map);

    map.mapTypes.set(customMapTypeId, customMapType);
    map.setMapTypeId(customMapTypeId);
}

function setUpHallMarkers(map) {
    hallsData = $('#map').data('halls');

    hallsData.forEach(
        function (item) {
            var infowindow = new google.maps.InfoWindow({
                content: item.content
            });

            var marker = new google.maps.Marker({
                position: {lat: item.latitude, lng: item.longitude},
                map: map,
                title: item.hall_name
            });

            marker.addListener('click', function() {
                infowindow.open(map, marker);
            });
        }
    )

}