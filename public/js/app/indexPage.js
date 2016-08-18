(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);throw new Error("Cannot find module '"+o+"'")}var f=n[o]={exports:{}};t[o][0].call(f.exports,function(e){var n=t[o][1][e];return s(n?n:e)},f,f.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){

Vue.component('map', {
        template: '<div id="map"></div>',

        props: ['markers'],

        data: {

        },
    
        ready: function () {
            $.ajax({
                context: this,
                url: "https://maps.googleapis.com/maps/api/js?key=AIzaSyDbvK8BomzmCBb7J0w6kEd2u3qDGbEj74A&timestamp=" + Date.now(),
                dataType: "script",
                success: function () {
                    this.mapInit()
                }
            })

            this.$watch('markers', function () {
                this.setUpMarkers()
            })
        },

        methods: {
            mapInit: function () {
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

                this.map = new google.maps.Map(document.getElementById('map'), {
                    center: {lat: 54.593948, lng: -2.406006},
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

                this.setUpMarkers()

                this.map.mapTypes.set(customMapTypeId, customMapType);
                this.map.setMapTypeId(customMapTypeId);
            },

            setUpMarkers: function () {
                var map = this.map;

                if(map == undefined) {
                    return;
                }
                console.log(this.markers);
                this.markers.forEach(
                    function (item) {
                        var infowindow = new google.maps.InfoWindow({
                            content: '<div><a href="/halls/' + item.id + '">' + item.name + '</a></div>'
                        });
                        console.log(item);
                        var marker = new google.maps.Marker({
                            position: {lat: item.latitude, lng: item.longitude},
                            map: map,
                            title: item.name
                        });

                        marker.addListener('click', function() {
                            infowindow.open(map, marker);
                        });
                    }
                )
            }
        }
    }
);

var vue = new Vue({

    el:'#app',

    data: {
        halls: []
    },

    created: function () {
        this.fetchData()
    },

    ready: function () {
        this.fetchData()
    },

    methods: {
        fetchData: function () {
            $.ajax({
                dataType: "json",
                url: 'api/halls',
                context: this,
                success: function (data) {
                    this.halls = data
                }
            });
        },
        
        mapSetup: function () {

        }
    }


});

},{}]},{},[1])