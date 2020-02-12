<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" rel="stylesheet" >
    <link rel="stylesheet" href="{{ asset('vendor_assets/jquery-ui-1.12.1.custom/jquery-ui.min.css') }}">

    <title>SafeTour</title>
</head>
<body>
<nav class="navbar navbar-dark  bg-gray">
    <a class="navbar-brand" href="/">Safe Tour {{  Request::segment(3) }} <img class="ml-1" src="{{ asset('img/mexico-flag-icon-16.png') }}" alt=""> </a>
    <form class="form-inline">
        <select  onchange="rTour(this)" class="form-control">
            <option value="0"> -- Choose an option --</option>
            @foreach($tour_input as $tour)
                <option value="{{ $tour->slug }}" {{ (Request::segment(3) == $tour->slug || Request::segment(2) == $tour->slug ) ? 'selected' : ''  }}> {{ $tour->name }} </option>
            @endforeach
        </select>
    </form>
</nav>

@yield('content')

<nav class="navbar navbar-dark  bg-gray mt-3">
    <a class="navbar-brand" href="/">Safe Tour <img class="ml-2" src="{{ asset('img/mexico-flag-icon-16.png') }}" alt=""> </a>
    <form class="form-inline">
        <select onchange="rTour(this)" class="form-control">
            <option value="0"> -- Choose an option --</option>
            @foreach($tour_input as $tour)
                <option value="{{ $tour->slug }}" {{ (Request::segment(3) == $tour->slug || Request::segment(2) == $tour->slug ) ? 'selected' : ''  }}> {{ $tour->name }} </option>
            @endforeach
        </select>
    </form>
</nav>


<nav class="navbar navbar-dark bg-dark  text-center justify-content-center align-items-center py-3 py-md-4">
    <div>
        <span class="landing__lbl-pickup"> <span class="font-weight-bold">Pick up Service at:</span>  Playa del Carmen Cancun Tulum Puerto Morelos Puerto Aventuras</span>
    </div>
</nav>

<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('vendor_assets/admin_lte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor_assets/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>

<script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
