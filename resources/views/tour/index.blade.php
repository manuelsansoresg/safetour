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
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Tours</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h3 class="mr-auto">LISTA DE TOURS</h3>
                                    <div>
                                        <a href="/admin/tour/create" class="btn btn-block btn-primary btn-sm"><i class="far fa-file"></i> AGREGAR</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <table class="table-default table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                            <thead class="theade-danger">
                                            <tr>
                                                <th> <small>IMAGEN</small> </th>
                                                <th> <small>NOMBRE</small> </th>
                                                <th> <small>DESCRIPCIÓN</small> </th>
                                                <th> <small>PRECIO</small> </th>
                                                <th style="width: 70px"></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($tours as $tour)
                                                <tr>
                                                    <td>
                                                        <img src="{{ ($path.'/'.$tour->id.'/thumb_'.$tour->image) }}" alt="">
                                                    </td>
                                                    <td>{{ $tour->name }}</td>
                                                    <td><div class="bg-dark"> <small>{!!  $tour->description !!}</small> </div></td>
                                                    <td>{{ price( $tour->price) }}</td>
                                                    <td>
                                                        {{ Form::open(['route' => ['tour.destroy', $tour->id ],'class' => 'form-inline', 'method' => 'DELETE' ])}}
                                                        <a href="{{route('tour.edit', $tour->id)}}" class="btn btn-sm btn-primary">
                                                            <i class="far fa-edit"></i>
                                                        </a>
                                                        <button onclick="return confirm('¿Deseas eliminar el elemento?')" class="btn btn-sm btn-danger ml-md-2">
                                                            <i class="far fa-trash-alt"></i>
                                                        </button>
                                                        {{ Form::close() }}

                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    </div>
@endsection
