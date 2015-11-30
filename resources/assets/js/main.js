var Vue = require('vue');
var $ = require('jquery');

var vm = new Vue({
    el: '#email',
    data: {
        placeholder: "youremail@gmail.com",
        url: "http://auth.app/checkEmailExists"
    },
    methods: {
        //self= this;
        checkEmailExists: function () {
            var email = $('#email').value();
            console.debug("checkEmailExists EXECUTED!");
            console.debug("A punt de cridar:");
            console.debug(this.url);
            console.debug(email);
            var url = this.url + '?email=' + email;
            console.debug(url);

            $.ajax(url).done(function(data) {
                //Ok
                console.debug(data);
                if (data == "true") {
                    //TODO email està lliure DO NOTHING!
                } else {
                    alert ('email ocupat!');
                }
            }).fail(function(data) {
                //error
                alert("Ha petat!");
            }).always(function(data) {
                //always
                console.debug('Xivato!');
            });


        }
    }

});

