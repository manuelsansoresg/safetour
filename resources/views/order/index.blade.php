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
                                    <h3 class="mr-auto">LISTA DE PAGOS</h3>
                                    <div>
                                        <a href="/admin/tour/create" class="btn btn-block btn-primary btn-sm"><i class="far fa-file"></i> AGREGAR</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <table class="table table-bordered table-hover dataTable table-order" role="grid" aria-describedby="example2_info" style="width: 100%">
                                            <thead class="theade-danger">
                                            <tr>
                                                <th> <small> ALTA </small> </th>
                                                <th> <small> TOUR </small> </th>
                                                <th> <small> PRECIO </small> </th>
                                                <th> <small> # </small> </th>
                                                <th> <small> NOMBRE </small> </th>
                                                <th> <small> WATSAPP </small> </th>
                                                <th> <small> EMAIL </small> </th>
                                                <th> <small> FECHA </small> </th>
                                                <th> <small> TIPO </small> </th>
                                                <th> <small> STATUS </small> </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($orders as $order)
                                                <tr>
                                                    <td> <small>{{ date('d M, y', strtotime($order->created_at)) }}</small> </td>
                                                    <td> <small>{{ $order->name }}</small> </td>
                                                    <td> <small>{{ price( $order->total_price)  }}</small> </td>
                                                    <td> <small>{{ $order->quantity }}</small> </td>
                                                    <td> <small>{{ $order->name_client }}</small> </td>
                                                    <td> <small>{{ $order->watsapp }}</small> </td>
                                                    <td> <small> {{ $order->email }}</small></td>
                                                    <td> <small>{{ $order->date }}</small> </td>
                                                    <td><small>{{ ($order->type == 1)? 'Online' : 'Only Reservation' }}</small></td>
                                                    <td>
                                                        @switch($order->status)
                                                            @case('pendiente')
                                                                <span class="badge badge-warning">{{ $order->status }}</span>
                                                            @break
                                                            @case('only reservation')
                                                                <span class="badge badge-secondary">{{ $order->status }}</span>
                                                            @break
                                                            @case('approved')
                                                                <span class="badge badge-success">{{ $order->status }}</span>
                                                            @break
                                                            @default
                                                                <span class="badge badge-danger">{{ $order->status }}</span>
                                                            @break
                                                        @endswitch


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
