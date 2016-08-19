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