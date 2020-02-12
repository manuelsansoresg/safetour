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
                            <li class="breadcrumb-item"> <a href="/admin/type-pays">PAGOS</a> </li>
                            <li class="breadcrumb-item active"> NUEVO</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">REGISTRAR PAGO</div>
                            <div class="card-body">
                                {{ Form::open(['route' => 'type-pays.store', 'method' => 'POST', 'class' => 'needs-validation', 'novalidate']) }}
                                <div class="row ">
                                    <div class="col-12">
                                        <small>Los campos marcados con * son obligatorios </small>
                                    </div>

                                    <div class="col-12 col-md-6 mt-2">
                                        <div class="form-group mb-2">
                                            <label class="small">*NOMBRE </label>
                                            <div class="w-100"></div>
                                            <input type="text" name="name" required class="form-control form-control-sm">
                                            <small>Ejemplo : PAYED ON LINE</small>
                                            <div class="invalid-feedback">
                                                El campo nombre es obligatorio
                                            </div>
                                            <div class="w-100"></div>

                                            @if($errors)
                                                <span class="text-danger"> {{$errors->first('name')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="w-100"></div>
                                    <div class="col-12 col-md-6 mt-2">
                                        <div class="form-group mb-2">
                                            <label class="small"> OPERACIÓN </label>
                                            <select name="type" id="" class="form-control">
                                                <option value="">Seleccione una opción</option>
                                                <option value="-">-</option>
                                                <option value="+">+</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-2 mt-2">
                                        <div class="form-group mb-2">
                                            <label class="small"> CANTIDAD </label>
                                            <input type="number" class="form-control" name="price">
                                        </div>
                                    </div>
                                    <div class="w-100"></div>
                                    <div class="col-12 col-md-6 mt-2">
                                        <div class="form-group mb-2">
                                            <label class="small"> LEYENDA </label>
                                            <input type="text" class="form-control"  name="legend">
                                        </div>
                                    </div>

                                </div>

                                <div class="row mt-3">
                                    <div class="col-12 col-md-8  text-right pb-4">
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

