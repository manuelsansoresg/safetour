const axios = require('axios');

$(document).ready(function() {
    if ( $(".preorder").length > 0 ) {

        getTotalPreorder();

        $( "#frm-order" ).submit(function( event ) {

            event.preventDefault();
            btnPay();

        });

        window.changePayed = function (id) {
            var payed = $('#payed_selected').val(id);
            if(id == 2 || id == 3  ){
                $('#btn-buy').hide();
            }else{
                $('#btn-buy').show();
            }
            getTotalPreorder();
        }

        window.updateTotal = function () {
            getTotalPreorder();
        }

        window.onlyReservation = function () {

            var type_reservation = $('#type_reservation').val(0);

        }

        function getTotalPreorder (){

            var price       = $('#price').val();
            var persons     = $('#persons').val();
            var kids        = $('#kids').val();
            var payed       = $('#payed_selected').val();
            var tour_slug   = $('#tour_slug').val();

            var url         = '/tour/calculate/send?kids='+kids+'&persons='+persons+'&payed='+payed+'&tour_slug='+tour_slug;
            //var url  = '/tour/order/calculate?price='+price+'&persons='+persons+'&payed='+payed+'&name='+name+'&watsapp='+watsapp+'&point='+point+'&date='+date+'&email='+email;

            axios.get(url)
                .then(function (response) {
                    var result = response.data;
                    $('#d_total').html(result.total+' MXN');
                })
                .catch(function (error) {

                })
        }

        function btnPay() {
            var price           = $('#price').val();
            var persons         = $('#persons').val();
            var kids            = $('#kids').val();
            var payed           = $('#payed_selected').val();

            var name             = $('#name').val();
            var watsapp          = $('#watsapp').val();
            var point            = $('#point').val();
            var date             = $('#date').val();
            var email            = $('#email').val();
            var tour_slug        = $('#tour_slug').val();
            var type_reservation = $('#type_reservation').val();

            var url  = '/tour/btn-pay/send?price='+price+'&persons='+persons+'&payed='+payed+'&name='+name+'&watsapp='+watsapp+'&point='+point+'&date='+date+'&email='+email+'&tour_slug='+tour_slug+'&type_reservation='+type_reservation+'&kids='+kids;

            if(name != '' && watsapp!= '' && point != '' && email != ''){
                $('#spinner').show();

                axios.get(url)
                    .then(function (response) {
                        var result = response.data;
                        $('#spinner').hide();
                        window.location = result.url;

                    })
                    .catch(function (error) {

                        $('#spinner').hide();
                    })
            }


        }

    }
});

