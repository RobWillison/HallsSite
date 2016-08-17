(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);throw new Error("Cannot find module '"+o+"'")}var f=n[o]={exports:{}};t[o][0].call(f.exports,function(e){var n=t[o][1][e];return s(n?n:e)},f,f.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
Vue.component('rating', {
    template: '#rating',
    
    props: ['name', 'rating'],
    
    
    
});

Vue.component('review', {
    template: '#review',

    props: ['review'],

});

var vue = new Vue({

    el:'#app',

    data: {
        hall: {}
    },

    created: function () {
        this.fetchData()
    },

    ready: function () {
        var path = window.location.pathname;
        this.id = path.split('/')[2]

        this.fetchData()
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
        
        addReview: function () {
            window.location.href = window.location.href + '/review';
        }
    }


});

},{}]},{},[1])