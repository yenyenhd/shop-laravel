@extends('admin::layouts.master')

@section('css')
<style>

input[type="file"] {
    display: none;
}

</style>
@endsection
@section('content')
<div class="content-header">
    <div class="row  mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Hi, welcome back!</h4>
                <span class="ml-1">Order</span>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home </a></li>
                <li class="breadcrumb-item"><a href="{{ route('list.order') }}">Order</a></li>
                <li class="breadcrumb-item active">list</li>
            </ol>
        </div>
    </div>
</div>

@if(session('message'))
    <div class="alert alert-success">
        {{session('message')}}
    </div>
 @endif

    <div class="card mb-4 mt-4">
        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTable" class="display" style="min-width: 845px" >
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Mã đơn hàng</th>
                            <th>Tình trạng đơn hàng</th>
                            <th width="20%">Xem chi tiết</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                                $i = 0; 
                            @endphp
                            @foreach($orders as $order)
                           @php
                               $i++;
                           @endphp
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{  strtoupper($order->code) }}</td>
                            <td>
                                @if ($order->status == 1)
                                {{ 'Đang chờ xử lý' }}
                                @else 
                                {{ 'Đã xử lý' }}
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('order.view', ['code'=> $order->code]) }}"><i class="ti-new-window" style="font-size: 25px;color: green;"></i></a>
                            </td>

                        </tr>
                       @endforeach

                    </tbody>

                </table>

            </div>
        </div>
    </div>

@endsection
