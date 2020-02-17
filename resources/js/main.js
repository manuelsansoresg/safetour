const axios = require('axios');
var isMovil = false;
/* saber si viene de escritorio o movil */
function myFunction(x) {
    if (x.matches) { // If media query matches
        isMovil = true;
    }else{
    }
}

var x = window.matchMedia("(max-width: 700px)");
myFunction(x); // Call listener function at run time
x.addListener(myFunction); // Attach listener function on state changes

$(document).ready(function() {
    /* datatable*/
    if ( $(".table-order").length > 0 ) {
        $('.table-order').DataTable({
            "scrollX": true,

            "order": [ 0, 'desc' ],
            language: {
                "decimal": "",
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Entradas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "BUSCAR:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
        });
    }

    if ( $(".table-default").length > 0 ) {
        $('.table-default').DataTable({
            responsive: true,

            language: {
                "decimal": "",
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Entradas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "BUSCAR:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
        });
    }

    /* datatable*/
    if ( $(".summer").length > 0 ) {
        $('.summer').summernote(
            {
                height: 200,
                fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Campton-Medium', 'Roboto-Regular', 'Campton-Light' , 'Campton-Book', 'Campton-ExtraBold', 'Campton-SemiBoldItalic'],
                fontNamesIgnoreCheck: ["Campton-Medium", "Campton-Light", 'Campton-Book', 'Roboto-Regular', 'Campton-ExtraBold', 'Campton-SemiBoldItalic']
            }
        );
    }
    if ( $(".datepicker").length > 0 ) {
        $( ".datepicker" ).datepicker({ dateFormat: 'd M, y', minDate: '+1d' });

    }

    $('.datepicker_cotizador').datepicker({ dateFormat: 'd M, y', minDate: '+1d' });


    if ( $(".landing").length > 0 ) {

        setBanner();


        window.setTotal = function (count) {

            var persons =  parseInt( $('#persons'+count).val());
            var datepicker = $('#datepicker'+count).val();
            var price = parseFloat($('#price'+count).val());

            var total = persons * price;

            $('#total'+count).val('TOTAL '+ total + ' MXN');

            console.log('persons'+persons);
        }

    }

    if ( $(".more").length > 0 ) {

        window.loadMore = function (divId) {
            $('#more'+divId+'').fadeIn('slow');
            $('.minimize'+divId+'').hide();

            $('html, body').animate({
                scrollTop: $("#more"+divId).offset().top
            }, 2000);
        }

        window.showCalendar = function(id)
        {
            $('#datepicker'+id).datepicker('show');
        }
        window.closeMore = function (divId) {
            $('#more'+divId+'').hide();
            $('.minimize'+divId+'').fadeIn('slow');

        }

    }

    window.rTour = function(selectObject){
        var value = selectObject.value;
       if (value != '0'){
           window.location = '/tour/'+value;
       }
    }

});

function setBanner() {
    var url  = '/set-banner';

    axios.get(url)
        .then(function (response) {
            var result = response.data;
            console.log('isMovil', isMovil);
            result.forEach( function(valor, indice, array) {
                if(isMovil == false){
                    $('#background-image-'+valor.tour_id).css('background-image', 'url(/img/tour/'+valor.tour_id+'/' + valor.name + ')');
                    $('#background-image-'+valor.tour_id).css('background-repeat', 'none');
                    $('#background-image-'+valor.tour_id).css('background-position', 'center');
                }else{
                    $('#background-image-'+valor.tour_id).css('background-image', 'url(/img/tour/'+valor.tour_id+'/' + valor.name_movil + ')');
                    $('#background-image-'+valor.tour_id).css('background-repeat', 'none');
                    $('#background-image-'+valor.tour_id).css('background-position', 'center');
                }

            });


        })
        .catch(function (error) {

        })
}

(function () {
    'use strict';
    window.addEventListener('load', function () {
        //Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        //Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function (form) {
            form.addEventListener('submit', function (event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();


require('./components/order');
