@extends('layouts.landing')

@section('content')
    <nav class="navbar navbar-dark bg-dark d-flex justify-content-center align-items-center text-center  py-3 mt-2">
        <p class="h1"> {{ $tour->name }} </p>
    </nav>

    <div class="container preorder">

        <div class="row mt-5 justify-content-center">
            <div class="col-12 col-md-6 ">
                <div class="card preorder__card">

                    <div class="card-header text-center {{ $bg }}  text-white">
                        <h4>RESERVATION {{ strtoupper($title) }}</h4>
                    </div>
                    <div class="card-body">


                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-5 col-form-label font-weight-bold">NAME</label>
                            <div class="col-sm-7">
                                <input type="text" name="name" id="name" class="form-control" readonly value="{{ $order->name }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-5 col-form-label font-weight-bold">WATSAPP</label>
                            <div class="col-sm-7">
                                <input type="text" name="watsapp" id="watsapp"  class="form-control" readonly value="{{ $order->watsapp }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-5 col-form-label font-weight-bold">CHOSE POINT OF PICKUP</label>
                            <div class="col-sm-7">
                                <select name="point" id="point" class="form-control" required disabled>
                                    <option value="">Select one option</option>
                                    @foreach($points as $point)
                                        <option value="{{ $point->id }}" {{ ($order->pickuppoint_id == $point->id)? 'selected' : '' }}>{{ $point->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-5 col-form-label font-weight-bold">#PERSONS</label>
                            <div class="col-sm-7">
                                <input type="number" min="1" onchange="updateTotal()"  class="form-control" id="persons" name="persons" value="{{ $order->quantity }}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-5 col-form-label font-weight-bold">DATE TOUR</label>
                            <div class="col-sm-7">
                                <input type="text"  class="form-control" name="date" id="date" value="{{ $order->date }}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-5 col-form-label font-weight-bold">EMAIL</label>
                            <div class="col-sm-7">
                                <input type="email" name="email" id="email"  class="form-control"  readonly value="{{ $order->email }}">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-5 col-form-label font-weight-bold">TOTAL</label>
                            <div class="col-sm-7">

                                <div class="col-12 text-center bg-gray-light py-2 h5" id="d_total"> {{ price($order->total_price) }} MXN</div>
                            </div>
                        </div>




                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
