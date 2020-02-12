@extends('layouts.default')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6"></div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/home">INICIO</a></li>
                            <li class="breadcrumb-item"> <a href="/admin/pickuppoints">PUNTOS</a> </li>
                            <li class="breadcrumb-item active"> EDITAR </li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">REGISTRAR TOUR</div>
                            <div class="card-body">
                                {{ Form::open(['route' => ['pickuppoints.update', $point->id], 'method' => 'PUT', 'class' => 'needs-validation', 'novalidate']) }}
                                <div class="row ">
                                    <div class="col-12">
                                        <small>Los campos marcados con * son obligatorios </small>
                                    </div>

                                    <div class="col-12 col-md-6 mt-2">
                                        <div class="form-group mb-2">
                                            <label class="small">*NOMBRE </label>
                                            <div class="w-100"></div>
                                            <input type="text" name="name" value="{{ $point->name }}" required class="form-control form-control-sm">
                                            <div class="invalid-feedback">
                                                El campo nombre es obligatorio
                                            </div>
                                            <div class="w-100"></div>

                                            @if($errors)
                                                <span class="text-danger"> {{$errors->first('name')}}</span>
                                            @endif
                                        </div>
                                    </div>




                                </div>

                                <div class="row mt-3">
                                    <div class="col-6  text-right pb-4">
                                        <!--<a href="/admin/color" id="cancel" name="cancel" class="btn btn-danger">CANCELAR</a>-->
                                        <button class="btn btn-primary">ACEPTAR</button>
                                    </div>
                                </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    </div>
@endsection

