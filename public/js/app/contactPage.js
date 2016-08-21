(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);throw new Error("Cannot find module '"+o+"'")}var f=n[o]={exports:{}};t[o][0].call(f.exports,function(e){var n=t[o][1][e];return s(n?n:e)},f,f.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
var vue = new Vue({

    el:'#app',

    data: {
        form: {
            name: '',
            email: '',
            message: '',
            valid: {
                email: false,
                name: false,
            }
        }
    },

    methods: {
        submit: function () {
            
            if (!this.validate()) {
                return;
            }
            
            $.ajax({
                dataType: "json",
                url: 'api/contact',
                context: this,
                method: 'POST',
                data: {
                    email: this.form.email,
                    name: this.form.name,
                    message: this.form.message
                },
                success: function (data) {
                    this.halls = data
                }
            });
        },

        validate: function () {
            this.form.valid.name = false;
            this.form.valid.email = false;

            var valid = true;

            if(this.form.name == '') {
                this.form.valid.name = true;
                valid = false;
            }

            if(this.form.email == '') {
                this.form.valid.email = true;
                valid = false;
            }

            return valid;

        }
    }


});
},{}]},{},[1])