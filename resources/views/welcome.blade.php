@extends('layouts.landing')

@section('content')
    <nav class="navbar navbar-dark bg-dark landing__tours py-3 d-none">
        <div>Can Pay at Pick Up</div>
        <div>We pick you up & we bring you back</div>
        <div>5% Disscount paying On Line</div>
        <div>Safe Tour Mx</div>
    </nav>

    <div class="container ">
        <div class="row py-3">
            <div class="col-12">
                {!! $lbl !!}
            </div>
        </div>
    </div>

    <nav class="navbar navbar-dark bg-dark  text-center justify-content-center align-items-center py-3 py-md-4">
       <div>
           <span class="landing__lbl-pickup"> <span class="font-weight-bold">Pick up Service at:</span> Playa del Carmen Cancun Tulum Puerto Morelos Puerto Aventuras</span>
       </div>
    </nav>
    <div class="landing">
        <?php $cont = 0; ?>
        @foreach($tours as $tour)
            <?php $cont = $cont +1; ?>
            <?php $image =  $path.'/'.$tour->id.'/'.$tour->image  ?>
            <div id="background-image-{{ $tour->id }}" class="landing__img-tour">
                <div class="landing__img-tour__legend">
                    <div class="text-center float-md-right px-3  minimize{{ $cont }} landing__information">TOUR INFORMATION / RESERVATION HERE</div>
                    <div class="landing__img-tour__legend2 minimize{{ $cont }}">
                        <div class="landing__information-movil">TOUR INFORMATION / RESERVATION HERE</div>
                        <div class="mt-2"> <h1>{{ $tour->name }}</h1> </div>
                        <div class="mt-2 col col-md-3"> <a onclick="loadMore('{{ $cont  }}')"  class="btn btn-warning btn-lg btn-block"> <span class="font-weight-bold">INFORMATION</span> </a>  </div>
                    </div>

                    <div class="landing__img-tour__legend2 landing__img-tour__legend2big more" id="more{{ $cont }}" style="display: none">

                        <div class="col-12 col-md-3 text-center">
                            <sup><span class="badge "> <a class="cursor" onclick="closeMore('{{ $cont }}')"><i class="fas fa-times-circle fa-3x"></i></a> </span></sup> <span class="h1">{{ $tour->name }}</span>
                        </div>
                        <div class="col-12 col-md-4 ">
                            <div class="scrollBody landing__img-tour__legend2content text-white">
                                {!! $tour->description !!}
                            </div>

                        </div>
                        <div class="col-md-5">
                            {{ Form::open(['route' => ['pay.preorder', $tour->slug], 'method' => 'GET', 'class' => 'needs-validation', 'novalidate']) }}
                            <div class="row mt-3">
                                <div class="col-2">
                                    <input type="number" onchange="setTotal('{{ $cont }}')" min="1"  class="input-number" name="persons[]" id="persons{{ $cont }}" value="1">
                                </div>
                                <div class="col-10">
                                    <div class="h5 label-white">#persons</div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-2">
                                    <i onclick="showCalendar('{{  $cont }}')" class="far fa-calendar-alt icon-calendar"></i>
                                </div>
                                <div class="col-10 text-sm-left">
                                    <input type="text" name="date[]" id="datepicker{{ $cont }}" class="datepicker" readonly autocomplete="off">
                                    <input type="hidden"  name="price[]"  id="price{{ $cont }}" value="{{ $tour->price }}">
                                    <input type="hidden"  name="slug[]"   value="{{ $tour->slug }}">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-2">

                                </div>
                                <div class="col-10 text-left text-sm-left">
                                    <input type="text" name="total[]"  id="total{{ $cont }}" class="input"  value="TOTAL {{ $tour->price }} MXN" >
                                </div>

                            </div>

                            <div class="row mt-2">
                                <div class="offset-md-2 col-12 col-md-6 text-center">
                                    <span>{{ getPayedOnline() }}% disscount paying online</span>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="offset-md-2 col-12 col-md-6 text-center">
                                    <button class="btn btn-warning btn-lg btn-block font-weight-bold">
                                        BUY
                                    </button>
                                    <small class="text-center">  All Tours Include Pick Up Transportation</small>
                                </div>
                            </div>

                            <div class="row mt-2 mt-md-2">
                                <div class="offset-md-2 col-12 col-md-6 text-center">
                                    <button class="btn btn-primary btn-lg btn-block font-weight-bold landing__btn-reserve">RESERVE PAY AT PICK UP</button>
                                    <small class="text-center">Only for Playa del Carmen</small>
                                </div>
                            </div>



                            {{ Form::close() }}
                        </div>
                    </div>

                </div>
            </div>
            <div class="bg-dark text-white py-3 px-2 landing__img-tour__bottom-info">
                THE RESERVATION NAME WILL BE THE SAME AS THE CARD HOLDER / <span class="font-weight-bold">YOU CAN PAY AT PICK UP 10% COMISSION PAYING WTH CREDIT / DEBIT CARD </span>
            </div>
        @endforeach
    </div>
@endsection
