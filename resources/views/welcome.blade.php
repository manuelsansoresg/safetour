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
                        <div class="mt-2 col col-md-3"> <a onclick="loadMore('{{ $cont  }}')"  class="btn btn-warning btn-lg btn-block text-dark"> <span class="font-weight-bold">INFORMATION</span> </a>  </div>
                    </div>

                    <div class="landing__img-tour__legend2 landing__img-tour__legend2big more" id="more{{ $cont }}" style="display: none">

                        <div class="col-12 col-md-3 text-center">
                             <span class="h1">{{ $tour->name }}</span> <sup><span class="badge badge-close"> <a class="cursor" onclick="closeMore('{{ $cont }}')"><i class="fas fa-times fa-2x"></i></a> </span></sup>
                        </div>
                        <div class="col-12 col-md-4 ">
                            <div class="scrollBody landing__img-tour__legend2content text-white">
                                {!! $tour->description !!}
                            </div>

                        </div>
                        <div class="col-md-5">
                            {{ Form::open(['route' => ['pay.preorder', $tour->slug], 'method' => 'GET', 'class' => 'needs-validation', 'novalidate']) }}
                            <div class="row mt-3 justify-content-center">
                               {{-- <div class="col-2 d-none">
                                    <input  type="number" onchange="setTotal('{{ $cont }}')" min="1"  class="input-number d-none"  value="1">
                                </div>--}}
                                <div class="col-5 col-md-3 pr-0">
                                    <div class="h5">
                                        <select class="form-control" name="persons[]" id="persons{{ $cont }}" onchange="setTotal({{ $cont }})" required>
                                            <option value="0">ADULTS</option>
                                            <option value="1">1 Person</option>
                                            <option value="2">2 Persons</option>
                                            <option value="3">3 Persons</option>
                                            <option value="4">4 Persons</option>
                                            <option value="5">5 Persons</option>
                                            <option value="6">6 Persons</option>
                                            <option value="7">7 Persons</option>
                                            <option value="8">8 Persons</option>
                                            <option value="9">9 Persons</option>
                                            <option value="10">10 Persons</option>
                                            <option value="11">11 Persons</option>
                                            <option value="12">12 Persons</option>
                                            <option value="13">13 Persons</option>
                                            <option value="14">14 Persons</option>
                                            <option value="15">15 Persons</option>
                                            <option value="16">16 Persons</option>
                                            <option value="17">17 Persons</option>
                                            <option value="18">18 Persons</option>
                                            <option value="19">19 Persons</option>
                                            <option value="20">20 Persons</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-5 col-md-3 pl-0">
                                    <div class="h5">
                                        <select class="form-control" name="kids[]" id="kids{{ $cont }}" onchange="setTotal({{ $cont }})" required>
                                            <option value="0">KIDS</option>
                                            <option value="1">1 kid</option>
                                            <option value="2">2 Kids</option>
                                            <option value="3">3 Kids</option>
                                            <option value="4">4 Kids</option>
                                            <option value="5">5 Kids</option>
                                            <option value="6">6 Kids</option>
                                            <option value="7">7 Kids</option>
                                            <option value="8">8 Kids</option>
                                            <option value="9">9 Kids</option>
                                            <option value="10">10 Kids</option>
                                            <option value="11">11 Kids</option>
                                            <option value="12">12 Kids</option>
                                            <option value="13">13 Kids</option>
                                            <option value="14">14 Kids</option>
                                            <option value="15">15 Kids</option>
                                            <option value="16">16 Kids</option>
                                            <option value="17">17 Kids</option>
                                            <option value="18">18 Kids</option>
                                            <option value="19">19 Kids</option>
                                            <option value="20">20 Kids</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2 justify-content-center">
                                {{--<div class="col-2">
                                    <i onclick="showCalendar('{{  $cont }}')" class="far fa-calendar-alt icon-calendar"></i>
                                </div>--}}
                                <div class="col-10 col-md-6  text-sm-left">
                                    <input type="text" name="date[]" placeholder="Tour Date" id="datepicker{{ $cont }}" class="datepicker" readonly autocomplete="off">
                                    <input type="hidden"  name="price[]"  id="price{{ $cont }}" value="{{ $tour->price }}">
                                    <input type="hidden"  name="price_kids[]"  id="price_kids{{ $cont }}" value="{{ $tour->price_kids }}">
                                    <input type="hidden"  name="slug[]"   value="{{ $tour->slug }}">
                                </div>
                            </div>
                            <div class="row mt-2 justify-content-center mt-4">

                                <div class="col-10 col-md-6 text-left text-sm-left">
                                    <input type="text" readonly name="total[]"  id="total{{ $cont }}" style="background-color: #D9D9D9" class="input"  value="TOTAL {{ $tour->price }} MXN" >
                                </div>

                            </div>

                            <div class="row mt-2 justify-content-center">
                                <div class="col-10 col-md-6 text-center">
                                    <span>{{ getPayedOnline() }}% disscount paying online</span>
                                </div>
                            </div>

                            <div class="row mt-2 justify-content-center">
                                <div class="col-10 col-md-6 text-center">
                                    <button class="btn btn-warning btn-lg btn-block font-weight-bold">
                                        BUY
                                    </button>
                                    <small class="text-center">  All Tours Include Pick Up Transportation</small>
                                </div>
                            </div>

                            <div class="row mt-2 mt-md-2 justify-content-center">
                                <div class="col-10 col-md-6 text-center">
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
                10% OFF PAYING ON LINE
            </div>
        @endforeach
    </div>
@endsection
