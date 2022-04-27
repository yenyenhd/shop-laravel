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
<div>
    <h3>Thông tin vận chuyển</h3>
    <div class="card mb-4 mt-4">
        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTable" class="display" style="min-width: 845px" >
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên người nhận hàng</th>
                            <th>Số điện thoại</th>
                            <th>Địa chỉ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>{{ $address->id }}</th>
                            <th>{{ $address->name }}</th>
                            <th>{{ $address->phone }}</th>
                            <th>{{ $address->address }}</th>
                        </tr>

                    </tbody>

                </table>

            </div>
        </div>
    </div>
</div>
    
<div>
    <h3>Thông tin đơn hàng</h3>
    <div class="card mb-4 mt-4">
        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTable" class="table table-bordered" style="min-width: 845px" >
                    <thead>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Số lượng kho</th>
                            <th>Mã giảm giá</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        
                        $total = 0;
                    @endphp
                    @foreach ($order_detail as $detail)
                        @php
                           
                            $subtotal = $detail->price*$detail->quantity;
                            $total+=$subtotal;
                        @endphp
                        <tr class="color_qty_{{ $detail->product_id }}">
                            
                                        <td>{{ $detail->product->name }}</td>
                                        <td>{{number_format($detail->price ,0,',','.')}}đ</td>
                                        <td width="12%">
                                            
                                            <input type="number" min="1" {{$status==2 ? 'disabled' : ''}} class="order_qty_{{ $detail->product_id }}" value="{{ $detail->quantity }}" name="quantity" style="width: 40px">
                                            <input type="hidden" name="order_qty_storage" class="order_qty_storage_{{ $detail->product_id }}" 
                                            value="{{ $detail->product->quantity }}">
                                            <input type="hidden" name="order_code" class="order_code" value="{{ $detail->order_code }}">
                                            <input type="hidden" name="order_product_id" class="order_product_id" value="{{ $detail->product_id }}">
                                            @if($status!=2) 
                                            <button style="padding:0;; margin-left: 10px" data-product_id="{{ $detail->product_id }}" class="btn btn-default update_quantity" name="update_quantity"><i style="font-size: 22px; color:blue" class="ti-save"></i></button>
                                            @endif
                                        </td>
                                        <td>{{ $detail->product->quantity }}</td>
                                        <td>
                                            @if ($detail->coupon != 'no')
                                            {{ $detail->coupon }}
                                            @else
                                            {{ 'Không có mã' }}
                                            @endif
                                        </td>
                                        <td>{{number_format($subtotal ,0,',','.')}}đ</td>
                                       

                        </tr>
                       @endforeach
                       <tr>
                        <td>&nbsp</td>
                        <td>&nbsp</td>
                        <td>&nbsp</td>
                        <td>&nbsp</td>
                        

                        <td colspan="3"> 
                            Hình thức thanh toán: 
                            @if($detail->payment==0)
                            Bằng ATM
                            @elseif($detail->payment==1)
                            Tiền mặt 
                            @else
                            Bằng ví MOMO
                            @endif
                            <br>
                        Ghi chú: {{ $detail->note }}
                        <br>
                            @php 
                            $total_coupon = 0;
                            @endphp
                            @if($condition==1)
                            @php
                            $total_after_coupon = ($total*$sale)/100;
                            echo 'Mã giảm giá : -'.number_format($total_after_coupon,0,',','.').' đ'.'</br>';
                            $total_coupon = $total + $detail->shipping_fee - $total_after_coupon ;
                            @endphp
                            @else 
                            @php
                            echo 'Mã giảm giá : -'.number_format($sale,0,',','.').' đ'.'</br>';
                            $total_coupon = $total + $detail->shipping_fee - $sale ;
                            @endphp
                            @endif
                           
                            Phí giao hàng : {{number_format($detail->shipping_fee,0,',','.')}} đ
                            <br> 
                            Tổng tiền: <b>{{number_format($total_coupon,0,',','.')}} đ </b>
                            
                      
                        </td>
                        
                    </tr>
                    <tr>
                        <td colspan="9">
                            @foreach ($order as $or)
                            @if ($or->status == 1)
                            <form>
                                {{ csrf_field() }}
                                <select name="" class="form-control order_detail">
                                    <option value="">--Chọn tình trạng đơn hàng--</option>
                                    <option id="{{ $or->id }}" selected value="1">Chưa xử lý</option>
                                    <option id="{{ $or->id }}" value="2">Đã giao hàng</option> 
                                </select>
                            </form>
                            @else
                            <form>
                                {{ csrf_field() }}
                                <select name="" class="form-control order_detail">
                                    <option value="">--Chọn tình trạng đơn hàng--</option>
                                    <option id="{{ $or->id }}" value="1">Chưa xử lý</option>
                                    <option id="{{ $or->id }}" selected value="2">Đã giao hàng</option>
                                </select>
                            </form>
                            @endif
                        @endforeach
                            
                        </td>
                    </tr>

                    </tbody>

                </table>
                <a target="_blank" href="{{route('order.print', ['code'=>$detail->order_code])}}">In đơn hàng</a>

            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
  <script>
    $('.update_quantity').click(function(){
        var order_product_id = $(this).data('product_id');
        var order_qty = $('.order_qty_' + order_product_id).val();
        var order_code = $('.order_code').val();
        var _token = $('input[name="_token"]').val();


        $.ajax({
            url : '{{url('/admin/order/update-qty')}}',
            method: 'POST',
            data:{_token:_token, order_qty:order_qty ,order_code:order_code, order_product_id:order_product_id},
            success:function(data){
                alert('Cập nhật số lượng thành công');
                location.reload();
            }
        });

    });
      $('.order_detail').change(function(){
        var status = $(this).val();
        var id = $(this).children(":selected").attr("id");
        var _token = $('input[name="_token"]').val();

        
        //lay ra so luong
        quantity = [];
        $("input[name='quantity']").each(function(){
            quantity.push($(this).val());
        });
        //lay ra product id
        order_product_id = [];
        $("input[name='order_product_id']").each(function(){
            order_product_id.push($(this).val());
        });
        j = 0;
        for(i=0; i < order_product_id.length; i++){
            //so luong khach dat
            var order_qty = $('.order_qty_' + order_product_id[i]).val();
            //so luong ton kho
            var order_qty_storage = $('.order_qty_storage_' + order_product_id[i]).val();

            if(parseInt(order_qty) > parseInt(order_qty_storage)){
                j = j + 1;
                if(j==1){
                    alert('Số lượng bán trong kho không đủ');
                }
                $('.color_qty_'+order_product_id[i]).css('background','#000');
            }
        }
        if(j == 0){
            $.ajax({
                url : '{{url('/admin/order/update-order-qty')}}',
                method: 'POST',
                data:{_token:_token, status:status ,id:id ,quantity:quantity, order_product_id:order_product_id},
                success:function(data){
                    alert('Thay đổi tình trạng đơn hàng thành công');
                    location.reload();
                }
            });
        }
        
    });
    
  </script>

@endsection
