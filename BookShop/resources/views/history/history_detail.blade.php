@extends('layouts.master')

@section('content')
<div class="breadcrumb_container">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">     
                <nav>
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a> ></li>
                        <li>history</li>
                    </ul>
                </nav>
            </div>
        </div> 
    </div>        
</div>
<div class="cart_main_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive-sm">
                    @if(session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                    @endif
                    @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif
                    <div class="panel-heading text-center mb-30">
                    <p style="font-size: 25px">Xem chi tiết đơn hàng đã đặt: <b>{{$order_code}}</b></p>
                    </div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Tên người nhận hàng</th>
                                <th scope="col">Số điện thoại</th>
                                <th scope="col">Địa chỉ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="product-name">{{$address->name}}</td>
                                <td>{{$address->phone}}</td>
                                <td>{{$address->address}}</td>
                            </tr>
                        </tbody>
                    
                    </table>
                </div>

                <div class="table-responsive-sm">
                    <div class="panel-heading text-center mb-30">
                        <p style="font-size: 25px">Chi tiết đơn hàng</p>
                    </div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col"> Giá</th>
                                <th scope="col">Thành tiền</th>
                                <th scope="col">Hình thức thanh toán</th>
                                <th scope="col">Ghi chú</th>

                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total = 0;
                            @endphp
                            @foreach($order_details_product as $key => $details)
                            @php 
                                $number = $details->count();
                                $subtotal = $details->price*$details->quantity;
                                $total+=$subtotal;
                            @endphp
                            <tr>
                                <td>{{$details->product->name}}</td>
                                <td>{{$details->quantity}}</td>
                                <td>{{number_format($details->price ,0,',','.')}}đ</td>

                                <td>{{number_format($subtotal,0,',','.') }} đ</td>
                                @endforeach
                                <td rowspan="{{ $number }}">
                                    @if($details->payment==0)
                                        Bằng ATM
                                    @elseif($details->payment==1)
                                        Tiền mặt 
                                    @else
                                        Bằng ví MOMO
                                    @endif
                                </td>
                                <td rowspan="{{ $number }}">{{ $details->note }}</td>
                            </tr>
                            
                        </tbody>
                        <tfoot>
                            
                            @php 
                                $total_coupon = 0;
                            @endphp
                            @if($coupon_condition == 1)
                                @php
                                    $total_after_coupon = ($total*$coupon_sale)/100;
                                    $total_coupon = $total + $details->shipping_fee - $total_after_coupon ;
                                @endphp
                            <tr>
                                <th>Mã giảm giá</th>
                                <td>-{{number_format($total_after_coupon,0,',','.')}}đ</td>
                            </tr>
                            @else
                                @php
                                    $total_coupon = $total + $details->shipping_fee - $coupon_sale ;
                                @endphp
                                 <tr>
                                    <th>Mã giảm giá</th>
                                    <td>-{{number_format($coupon_sale,0,',','.')}}đ</td>
                                </tr>
                            @endif
                            <tr>
                                <th> Phí giao hàng</th>
                                <td><strong>{{number_format($details->shipping_fee,0,',','.')}} đ </strong></td>
                            </tr>
                            <tr>
                                <th>Tổng tiền</th>
                                <td><strong>{{number_format($total_coupon,0,',','.')}} đ </strong></td>
                            </tr>
                        </tfoot>
                    
                    </table>
                    
                </div>
                
            </div>    
        </div>
    </div>   
</div>
@endsection
