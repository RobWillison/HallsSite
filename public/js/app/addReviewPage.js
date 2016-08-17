(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);throw new Error("Cannot find module '"+o+"'")}var f=n[o]={exports:{}};t[o][0].call(f.exports,function(e){var n=t[o][1][e];return s(n?n:e)},f,f.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){

Vue.component('rating', {
    template: '#rating',

    props: ['name', 'rating'],

    data: function(){
        return {selected: false};
    },

    methods: {
        mouseOver: function (event) {
            var element = $(event.srcElement);
            var divPosition = element.offset().left;
            var divWidth = element.width()
            var percentage = (event.clientX - divPosition) / divWidth;

            percentage = percentage.toFixed(1);
            percentage = parseFloat( percentage )
            
            if (!this.selected) {
                this.rating = percentage * 100
            }
        },
        
        mouseClick: function (event) {
            this.selected = !this.selected;

            if (!this.selected) {
                this.mouseOver(event)
            }
        }
    }

});

Vue.component('fileupload', {
    template: '#fileupload',

    props: {
        name: String,
        filetypes: {
            type: Array,
            default: ['image/png', 'image/jpeg'],
        },
        errortext: String,
        images: Array
    },

    data: function(){
        return {
            has_error: false,
        };
    },
    
    methods: {
        onFileChange: function (e) {
            var files = e.target.files || e.dataTransfer.files;
            var file = files[0];

            this.checkFileTypes(file);

            if (this.has_error) {
                return;
            }

            if (!files.length)
                return;

            this.addImage(file);
        },
        checkFileTypes: function (file) {
            this.has_error = false;

            if (this.filetypes.indexOf(file.type) == -1) {
                this.has_error = true;
            }
        },
        addImage: function(file) {
            var reader = new FileReader();

            var self = this;

            reader.onload = function(e){
                self.images.push(e.target.result);
            };

            reader.readAsDataURL(file);
        },
        removeImage: function (e) {
            item = $(e.srcElement).data('item');
            this.images.splice(item, 1);
        }
    }
});

var vue = new Vue({

    el:'#app',

    data: {
        hall: {},
        submitter: {
            name: '',
            location: 'Unknown Location'
        },
        review: {
            rating: {
                location: 100,
                community: 100,
                comfort: 100,
                valueformoney: 100,
                socialspace: 100
            },

            text: ''
        },
        form: {
            nameinvalid: false,
        },
        uploadedimages: []
    },

    created: function () {
        this.fetchData()
    },

    ready: function () {
        var path = window.location.pathname;
        this.id = path.split('/')[2]

        this.fetchData()

        this.getLocation()
    },

    methods: {
        fetchData: function () {
            if (this.id == undefined) {
                return;
            }
            $.ajax({
                dataType: "json",
                url: '/api/halls/' + this.id,
                context: this,
                success: function (data) {
                    this.hall = data
                }
            });
        },

        getLocation: function () {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(this.getCity);
            }
        },

        submit: function () {
            if (!this.validateForm()) {
                return;
            }
            waitingDialog.show('Uploading...');
            $.ajax({
                dataType: "json",
                url: '/api/halls/' + this.id + '/review',
                method: "POST",
                data: { reviewText: this.review.text,
                        ratingLocation: this.review.rating.location,
                        ratingCommunity: this.review.rating.community,
                        ratingComfort: this.review.rating.comfort,
                        ratingValue: this.review.rating.valueformoney,
                        ratingSocialSpace: this.review.rating.socialspace,

                        reviewer: this.submitter.name,
                        location: this.submitter.location,
                        uploadedImages: this.uploadedimages,
                },
                success: function (data) {
                    waitingDialog.hide();
                    window.location.href = window.location.href.replace('/review', '');
                }
            })
        },

        validateForm: function () {
            if (this.submitter.name == '') {
                this.form.nameinvalid = true;
                return false;
            }

            return true;
        },

        getCity: function (position) {
            var geocodingAPI = "https://maps.googleapis.com/maps/api/geocode/json?latlng=" + position.coords.latitude + "," + position.coords.longitude + "&key=AIzaSyDNXM2LhpycxtXQFYq0GxRr5LDUURhteH4";
            var self = this;
            $.getJSON(geocodingAPI, function (json) {
                if (json.status == "OK") {

                    var result = json.results[0];

                    result.address_components.forEach(function (item) {

                        if (self.submitter.location != 'Unknown Location') {
                            return;
                        }

                        if (item.types.indexOf('postal_town') != -1) {
                            self.submitter.location = item.long_name;
                            return;
                        }
                        if (item.types.indexOf('administrative_area_level_1') != -1) {
                            self.submitter.location = item.long_name;
                            return;
                        }
                    });
                }

            });
        },
    }


});
},{}]},{},[1])