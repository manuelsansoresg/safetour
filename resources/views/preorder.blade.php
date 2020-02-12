@extends('layouts.landing')

@section('content')
    <nav class="navbar navbar-dark bg-dark d-flex justify-content-center align-items-center text-center  py-3 mt-2">
        <p class="h1"> {{ $tour->name }} </p>
    </nav>

    <div class="container preorder pb-3">
        {{ Form::open(['method' => 'GET', 'class' => 'needs-validation', 'novalidate', 'id' => 'frm-order']) }}
        <div class="row mt-5 justify-content-center">
            <div class="col-12 col-md-6 ">
                <div class="card preorder__card">
                    <div class="card-header text-center">
                        <h4>RESERVATION</h4>
                    </div>
                    <div class="card-body">

                        <input type="hidden" name="price" id="price" value="{{ $data['price'] }}">
                        <input type="hidden"  id="payed_selected" name="payed_selected" value="{{ $data['id_percent_online'] }}">
                        <input type="hidden"  id="tour_slug" name="tour_slug" value="{{ $tour->slug }}">
                        <input type="hidden"  id="type_reservation" name="tour_slug" value="1">
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-5 col-form-label font-weight-bold">NAME</label>
                            <div class="col-sm-7">
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-5 col-form-label font-weight-bold">WATSAPP</label>
                            <div class="col-sm-7">
                                <input type="number" name="watsapp" id="watsapp"  class="form-control"  required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-5 col-form-label font-weight-bold">CHOSE POINT OF PICKUP</label>
                            <div class="col-sm-7">
                                <select name="point" id="point" class="form-control" required>
                                    <option value="">Select one option</option>
                                    @foreach($points as $point)
                                        <option value="{{ $point->id }}">{{ $point->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-5 col-form-label font-weight-bold">#PERSONS</label>
                            <div class="col-sm-7">
                                <input type="number" min="1" onchange="updateTotal()"  class="form-control" id="persons" name="persons" value="{{ $data['persons'] }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-5 col-form-label font-weight-bold">DATE TOUR</label>
                            <div class="col-sm-7">
                                <input type="text"  class="form-control datepicker_cotizador" name="date" id="date" value="{{ $data['date'] }}" required autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-5 col-form-label font-weight-bold">EMAIL</label>
                            <div class="col-sm-7">
                                <input type="email" name="email" id="email"  class="form-control"  required>
                            </div>
                        </div>
                        <?php $cont = 0; ?>
                        @foreach($type_pays as $type_pay)
                            <?php
                                $cont = $cont +1;
                                $checked = ($cont == 1) ? 'checked' : '';
                            ?>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-12 col-md-5 col-form-label font-weight-bold">{!! strtoupper($type_pay->name) !!}</label>
                            <div class="col-sm-7">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" onchange="changePayed('{{ $type_pay->id }}')" name="payed[]"  value="{{ $type_pay->id }}" {{ $checked }}>
                                    <label class="form-check-label" for="exampleRadios1">
                                        TOTAL {!! strtoupper($type_pay->legend) !!}
                                    </label>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-5 col-form-label font-weight-bold">TOTAL</label>
                            <div class="col-sm-7">
                                <?php
                                $percent = $data['percent_online']/100;
                                $sub_total = ($data['price'] * $percent );
                                $total = $data['price'] -$sub_total;
                                ?>
                                <div class="col-12 text-center bg-gray-light py-2 h5" id="d_total"> {{ $total }} MXN</div>
                            </div>
                        </div>
                        <div class="form-group row justify-content-center" id="spinner" style="display: none">
                            <div class="fa-2x">
                                <i class="fas fa-spinner fa-spin"></i>
                            </div>
                        </div>
                        <div class="form-group row justify-content-center text-center">
                            <button class="btn btn-warning btn-block font-weight-bold"> <span class="h3 font-weight-bold">BUY</span> <br>All Tours Include Pick Up Transportation </button>
                            <button  onclick="onlyReservation()" class="btn btn-primary btn-block font-weight-bold"> <span class="h3 font-weight-bold">RESERVE PAY AT PICK UP</span>  <br> Only for Playa del Carmen  </button>
                            <p class="text-success mt-2 order-small  font-weight-bold">YOU WILL RECIVE A  <span  class="text-dark">watsapp</span> TO CONFIRM YOUR RESERVATION </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        {{ Form::close() }}
    </div>
@endsection
