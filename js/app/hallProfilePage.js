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
