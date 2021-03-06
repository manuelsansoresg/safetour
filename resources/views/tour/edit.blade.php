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
                            <li class="breadcrumb-item"> <a href="/admin/tour">TOUR</a> </li>
                            <li class="breadcrumb-item active"> EDITAR</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">REGISTRAR TOUR</div>
                            <div class="card-body">

                                {{ Form::open(['route' => ['tour.update', $tour->id], 'method' => 'PUT', 'files' => true, 'class' => 'needs-validation', 'novalidate']) }}

                                <div class="row ">
                                    <div class="col-12">
                                        <small>Los campos marcados con * son obligatorios </small>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group mb-2">
                                            <label class="small">*IMAGEN </label>
                                            <div class="w-100"></div>
                                            <input type="file" name="image"  class="form-control">
                                            @if($image!= '')
                                               <div class="py-3">
                                                   <img src="{{ $image }}" alt="">
                                               </div>
                                            @endif
                                            <div class="invalid-feedback">
                                                El campo imagen es obligatorio
                                            </div>
                                            <div class="w-100"></div>

                                            @if($errors)
                                                <span class="text-danger"> {{$errors->first('name')}}</span>
                                            @endif
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="small">*IMAGEN MOVIL 414px ancho *  alto 657px </label>
                                            <div class="w-100"></div>
                                            <input type="file" name="name_movil"  class="form-control">
                                            @if($image_movil!= '')
                                               <div class="py-3">
                                                   <img src="{{ $image_movil }}" alt="">
                                               </div>
                                            @endif
                                            <div class="invalid-feedback">
                                                El campo imagen es obligatorio
                                            </div>
                                            <div class="w-100"></div>

                                            @if($errors)
                                                <span class="text-danger"> {{$errors->first('image_movil')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 mt-2">
                                        <div class="form-group mb-2">
                                            <label class="small">*NOMBRE </label>
                                            <div class="w-100"></div>
                                            <input type="text" name="name" value="{{ $tour->name }}" required class="form-control form-control-sm">
                                            <div class="invalid-feedback">
                                                El campo nombre es obligatorio
                                            </div>
                                            <div class="w-100"></div>

                                            @if($errors)
                                                <span class="text-danger"> {{$errors->first('name')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-3 mt-2">
                                        <div class="form-group mb-2">
                                            <label class="small">PRECIO </label>
                                            <div class="w-100"></div>
                                            <input type="text" name="price" data-behaviour="decimal" class="form-control form-control-sm" value="{{price( $tour->price) }}">
                                            <div class="w-100"></div>
                                            @if($errors)
                                                <span class="text-danger"> {{$errors->first('price')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3 mt-2">
                                        <div class="form-group mb-2">
                                            <label class="small">PRECIO NIÑOS </label>
                                            <div class="w-100"></div>
                                            <input type="text" name="price_kids" data-behaviour="decimal" required class="form-control form-control-sm" value="{{price( $tour->price_kids ) }}">
                                            <div class="w-100"></div>
                                            @if($errors)
                                                <span class="text-danger"> {{$errors->first('price_kids')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group mb-2">
                                            <label class="small"> DECRIPCIÓN </label>
                                            <div class="w-100"></div>
                                            <textarea class="form-control summer" name="description" cols="30" rows="50">{{ $tour->description }}</textarea>
                                            <div class="w-100"></div>
                                            @if($errors)
                                                <span class="text-danger"> {{$errors->first('name')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-12 text-right pb-4">
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
