<!doctype html>
<html lang="en">
<head>
    <title>RESERVATION {{$order->name_tour}}</title>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

</head>
<body>
<style>
    .VERY-SMALL{
        font-size: 0.8em;
        font-weight: 600;
    }

    table {
        border-collapse: collapse !important;
        width: 100% !important;
        font-size: 12px;
    }

    th, td {
        padding: 8px !important;;
        text-align: left !important;
        border: 1px solid #dddddd !important;
        /*border-bottom: 1px solid #ddd !important;*/
        /*border: none !important;*/
    }

    tr:hover {background-color:#f5f5f5; !important; }

    i {
        border: solid black;
        border-width: 0 3px 3px 0;
        display: inline-block;
        padding: 3px;
    }

    .right {
        transform: rotate(-45deg) !important;
        -webkit-transform: rotate(-45deg) !important;
    }

    .bg-success{
        background-color: green;
        color: white;
        padding: 1px;
        text-align: center;
        font-size: 1.5em;
    }

    .bg-warning{
        background-color: yellow;
        color: white;
        padding: 1px;
        text-align: center;
        font-size: 1.5em;
    }

    .mt-3{
        margin-top: 30px;
    }

</style>
<nav class="" style="">
    Safe Tour  <img class="ml-1" style="margin-left: 20px" src="{{ asset('img/mexico-flag-icon-16.png') }}" alt="">

</nav>
<br><br>
<div class="container">

    <div class="row mt-5 justify-content-center">
        <div class="col-12 col-md-6 ">
            <div class="card-header text-center {{ $bg }}  text-white">
                <h4>RESERVATION {{ ( $order->name_tour) }}</h4>
            </div>

        </div>
    </div>
    <div class="row mt-3 ">
        <div class="col-12">
            <table class="table">
                <tr>
                    <td>NAME </td>
                    <td> {{ $order->name_user }} </td>
                </tr>
                <tr>
                    <td>WATSAPP </td>
                    <td> {{ $order->watsapp }} </td>
                </tr>
                <tr>
                    <td>CHOSE POINT OF PICKUP </td>
                    <td> {{ $order->pays_name }} </td>
                </tr>
                <tr>
                    <td>#PERSONS </td>
                    <td> {{ $order->persons }} </td>
                </tr>
                <tr>
                    <td>DATE TOUR </td>
                    <td> {{ $order->date }} </td>
                </tr>
                <tr>
                    <td> EMAIL  </td>
                    <td> {{ $order->email }} </td>
                </tr>
                <tr>
                    <td colspan="2"> &nbsp; </td>
                </tr>
                @foreach($type_pays as $type_pay)
                    <?php


                    ?>
                        <tr>
                            <td> {!! strtoupper($type_pay->name) !!}

                            </td>
                            <td>
                                @if($order->type_pay_id == $type_pay->id)
                                    <span> <img style="width: 20px" src="{{ asset('img/check.png') }}" alt=""> </span>
                                @endif
                            </td>

                        </tr>
                @endforeach
                <tr>
                    <td>TOTAL</td>
                    <td>{{ $order->total_price }}MXN</td>
                </tr>
            </table>

        </div>
    </div>
</div>


</div>
</body>
</html>
