(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);throw new Error("Cannot find module '"+o+"'")}var f=n[o]={exports:{}};t[o][0].call(f.exports,function(e){var n=t[o][1][e];return s(n?n:e)},f,f.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
Vue.component('map', {
        template: '<div id="map"></div>',

        props: ['marker'],

        ready: function () {
            $.ajax({
                context: this,
                url: "https://maps.googleapis.com/maps/api/js?key=AIzaSyDbvK8BomzmCBb7J0w6kEd2u3qDGbEj74A&timestamp=" + Date.now(),
                dataType: "script",
                success: function () {
                    this.mapInit()
                }
            })

            this.$watch('marker', function () {
                this.setUpMarker()
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
                    },
                    {
                        featureType: "all",
                        elementType: "labels.icon",
                        stylers: [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        elementType: 'labels.text',
                        stylers: [
                            {
                                visibility: "on"
                            },
                            {
                                color: "#ffffff"
                            },
                            {
                                lightness: 16
                            }
                        ]
                    }
                ], {
                    name: 'Custom Style'
                });
                var customMapTypeId = 'custom_style';

                this.map = new google.maps.Map(document.getElementById('map'), {
                    center: {lat: 54.593948, lng: -2.406006},
                    zoom: 5,
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

                this.map.mapTypes.set(customMapTypeId, customMapType);
                this.map.setMapTypeId(customMapTypeId);
            },
            setUpMarker: function () {
                var map = this.map;

                if(map == undefined) {
                    return;
                }
                if(this.markerObject != undefined) {
                    this.markerObject.setMap(null);
                }

                this.markerObject = new google.maps.Marker({
                    position: {lat: parseFloat(this.marker.latitude), lng: parseFloat(this.marker.longitude)},
                    map: map,
                    draggable: true,
                });

                var self = this;

                this.markerObject.addListener('dragend', function(event) {
                    lat = event.latLng.lat();
                    lng = event.latLng.lng();

                    self.marker.latitude = lat;
                    self.marker.longitude = lng;

                    $(window).trigger('marker-move', []);
                });

                this.map.setCenter({lat: parseFloat(this.marker.latitude), lng: parseFloat(this.marker.longitude)})
                this.map.setZoom(12);

                $(window).trigger('marker-move', []);

                console.log('thrown');

            }
        }
    }
);

Vue.directive('select', {
    twoWay: true,
    priority: 1000,

    params: ['options'],

    bind: function () {
        var self = this
        $(this.el)
            .select2({
                width: '100%'
            })
            .on('change', function () {
                self.set(this.value)
            })
    },
    update: function (value) {
        $(this.el).val(value).trigger('change')
    },
    unbind: function () {
        $(this.el).off().select2('destroy')
    }
})


var vue = new Vue({
   el: '#app',

    data: {
        universities: [],
        selectedUni: -1,
        map: '',
        name: '',
        uploadedimages: [],
        invalidFields: [],
        address: {
            firstLine: '',
            secondLine: '',
            city: '',
            postcode: '',
        }
    },

    ready: function () {
        this.getUniversitiesList();

        $(window).on('marker-move', this.autofillAddress);
    },

    methods: {
        getUniversitiesList: function () {
            $.ajax({
                dataType: "json",
                url: '/api/universities',
                context: this,
                success: function (data) {
                    this.universities = data;
                }
            });
        },
        submitForm: function () {
            if (!this.validateForm()) {
                return;
            }

            waitingDialog.show('Uploading...');
            $.ajax({
                dataType: "json",
                url: '/api/add',
                method: "POST",
                data: {
                    name: this.name,
                    universityId: this.universities[this.selectedUni].id,
                    longitude: this.universities[this.selectedUni].longitude,
                    latitude: this.universities[this.selectedUni].latitude,

                    addressFirstLine: this.address.firstLine,
                    addressSecondLine: this.address.secondLine,
                    addressCity: this.address.city,
                    addressPostcode: this.address.postcode,

                    uploadedImages: this.uploadedimages,
                },
                success: function (data) {
                    waitingDialog.hide();
                    window.location.href = window.location.href.replace('/add', '/halls/' + data.id);
                }
            })

        },
        validateForm: function (){
            
            this.invalidFields = []

            if (this.uploadedimages.length == 0) {
                this.invalidFields.push('images');
            }
            if (this.name == '') {
                this.invalidFields.push('name');
            }
            if (this.selectedUni == -1) {
                this.invalidFields.push('selectedUni');
            }
            if (this.address.firstLine == '') {
                this.invalidFields.push('address.firstLine');
            }
            if (this.address.secondLine == '') {
                this.invalidFields.push('address.secondLine');
            }
            if (this.address.city == '') {
                this.invalidFields.push('address.city');
            }
            if (this.address.postcode == '') {
                this.invalidFields.push('address.postcode');
            }


            return this.invalidFields.length == 0;
        },
        autofillAddress: function () {
            console.log('caught');
            var geocodingAPI = "https://maps.googleapis.com/maps/api/geocode/json?latlng=" + this.universities[this.selectedUni].latitude + "," + this.universities[this.selectedUni].longitude + "&key=AIzaSyDNXM2LhpycxtXQFYq0GxRr5LDUURhteH4";
            var self = this;
            $.getJSON(geocodingAPI, function (json) {
                if (json.status == "OK") {

                    var result = json.results[0];
                    console.log(result)
                    result.address_components.forEach(function (item) {

                        if (item.types.indexOf('route') != -1) {
                            self.address.secondLine = item.long_name;
                            return;
                        }

                        if (item.types.indexOf('postal_town') != -1) {
                            self.address.city = item.long_name;
                            return;
                        }

                        if (item.types.indexOf('postal_code') != -1) {
                            self.address.postcode = item.long_name;
                            return;
                        }
                    });
                }

            });
        }
    }
});
},{}]},{},[1])