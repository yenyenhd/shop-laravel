@extends('layouts.master')

@section('content')
<div class="breadcrumb_container">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">     
                <nav>
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a> ></li>
                        <li>checkout</li>
                    </ul>
                </nav>
            </div>
        </div> 
    </div>        
</div>
<div class="Checkout_page_section">
    <div class="container">
        <div class="row">
           <div class="col-12">
            @if(session('message'))
            <div class="alert alert-success">
                {{session('message')}}
            </div>
        @endif
           </div>
           <div class="col-12">
            <div class="customer-login mb-40">
                <h3> 
                    <i class="fa fa-file-o" aria-hidden="true"></i>
                    Returning customer?
                    <a class="Returning" href="#" data-toggle="collapse" data-target="#Returning_customer" aria-expanded="true">Thêm mới địa chỉ giao hàng</a>     
                </h3>
                 <div id="Returning_customer" class="collapse" data-parent="#accordion">
                    <div class="card-bodyfive">
                        <div class="col-lg-6">
                            <form>  
                                {{ csrf_field() }} 
                                <div class="row">
                                    <div class="col-lg-6 col-sm-6 col-md-6 mb-30">
                                        <div class="input_text">
                                            <label for="R_N">Họ tên <span>*</span></label>
                                            <input id="R_N" type="text" name="name" class="name @error('name') is-invalid @enderror" value="{{ old('name') }}"> 
                                            @if($errors->has('name'))
                                                <div class="error-text">
                                                    {{$errors->first('name')}}
                                                </div>
                                            @endif
                                        </div>   
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-md-6 mb-30">
                                        <div class="input_text">
                                            <label for="R_N">Số điện thoại <span>*</span></label>
                                            <input id="R_N" type="text" name="phone_number" class="phone_number @error('phone_number') is-invalid @enderror" value="{{ old('phone_number') }}"> 
                                            @if($errors->has('phone_number'))
                                                <div class="error-text">
                                                    {{$errors->first('phone_number')}}
                                                </div>
                                            @endif
                                        </div>   
                                    </div>
                                    <div class="col-12 mb-30">
                                        <div class="input_text">
                                            <label for="R_N7">Tỉnh/Thành phố<span>*</span></label>
                                            <select class="form-control choose province" name="province" id="province">
                                                <option value="">---Chọn tỉnh/thành phố---</option>
                                                @foreach ($province as $pro)
                                                <option value="{{ $pro->matp }}">{{ $pro->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-30">
                                        <div class="input_text">
                                            <label for="R_N7">Quận/Huyện<span>*</span></label>
                                            <select class="form-control choose district" name="district" id="district">
                                                {{-- <option value="">Vui lòng chọn quận/huyện</option> --}}
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-30">
                                        <div class="input_text">
                                            <label for="R_N7">Phường/Xã<span>*</span></label>
                                            <select class="form-control commune" name="commune" id="commune">
                                                {{-- <option value="">Vui lòng chọn xã/phường</option> --}}
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-30">
                                        <div class="input_text">
                                            <label for="R_N7">Địa chỉ<span>*</span></label>
                                            <input id="R_N7" placeholder="Street address" type="text" 
                                            name="address" class="address @error('address') is-invalid @enderror" value="{{ old('address') }}"> 
                                            @if($errors->has('address'))
                                                <div class="error-text">
                                                    {{$errors->first('address')}}
                                                </div>
                                            @endif   
                                        </div>
                                    </div>
                                    
                                
                                    <div class="order-button">
                                        <button  type="button" name="send-address" class="send-address">Lưu</button> 
                                    </div> 	    	    	    	    	    	    
                                </div>
                             </form>     
                        </div>
                    </div>
                </div>    
            </div>   
       </div>
        </div>
        
            {{-- <div id='bsw_popup'>
                <div class='bsw_popup_'>
                    <h2>Hướng dẫn bình luận</h2>
                    <h3>Chèn link</h3>
                    <p>Sử dụng thẻ <code>&amp;lt;a href=&amp;#39;LINK&amp;#39;&amp;gt;TÊN_HIỂN_THỊ&amp;lt;/a&amp;gt;</code></p>
                    <h3>Chèn hình ảnh</h3>
                    <p><code>[img] LINK_ANH [/img]</code> - sử dụng công cụ bên dưới để upload ảnh.</p>
                    <h3>Định dạng chữ</h3>
                    <p> &amp;lt;b&amp;gt; <b>Chữ in đậm</b> &amp;lt;/b&amp;gt;<br/> &amp;lt;i&amp;gt; <i>Chữ in nghiêng</i> &amp;lt;/i&amp;gt;<br/> &amp;lt;u&amp;gt; <u>Chữ gạch chân</u> &amp;lt;/u&amp;gt;<br/> &amp;lt;strike&amp;gt; <strike>Chữ gạch ngang</strike> &amp;lt;/strike&amp;gt;<br/> </p>
                    <h3>Chèn một đoạn Code</h3>
                    <p>Đầu tiên sử dụng <a href='//bacsiwindows.com/mahoahtml' target='blank'>công cụ này</a> để mã hóa đoạn code muốn chèn.<br/>Sau đó dùng thẻ <code>[code] CODE_ĐÃ_MÃ_HÓA [/code]</code></p><a class='close' href='#close' title='Close'><i aria-hidden='true' class='fa fa-check'/> Đã hiểu</a> </div>
            </div>
            <a href="#bsw_popup">Mở Popup</a> --}}
        <div class="checkout-form">
            @if(session('error'))
                        <div class="alert alert-danger mt-30">
                            {{session('error')}}
                        </div>
                    @endif
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <form>
                        <h3>Địa chỉ giao hàng</h3>
                        <div id="load_address"></div>
                        <div class="order-button">
                            <button type="button" name="select-address-" class="select-address">Hoàn thành</button> 
                        </div>
                    </form>
                    <div class="coupon-form-two mt-30 mb-30">
                        <h3>mã giảm giá</h3>
                        <p>Nhập mã giảm giá...</p> 
                        <form action="{{ route('check_coupon') }}" method="POST">
                           {{ csrf_field() }}
                            <input placeholder="Coupon code" type="text" name="coupon">
                            <input value="Áp dụng" type="submit">
                            @if (Session::get('coupon'))
                               <a href="{{ route('delete_coupon') }}">Xóa</a>
                            @endif    
                        </form>  
                   </div>
                </div>
                @if(Session::get('cart'))
                <div class="col-lg-6 col-md-6">
                    <div class="order-wrapper mb-30">
                        <h3>Thông tin đơn hàng</h3>
                        <div class="order-table table-responsive mb-30">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="product-name">Sản phẩm</th>
                                        <th class="product-total">Tổng</th>
                                    </tr>
                                </thead>
                               
                                <tbody>
                                    @php
                                    $total = 0;
                                    @endphp
                                    @foreach(Session::get('cart') as $key => $cart)
                                    @php 
                                        $subtotal = $cart['price']*$cart['quantity'];
                                        $total+=$subtotal;
                                    @endphp
                                    <tr>
                                        <td class="product-name">{{$cart['name']}} <strong> × {{$cart['quantity']}}</strong></td>
                                        <td class="amount"> {{ number_format($cart['price'],0,',','.')  }} đ</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Tiền hàng</th>
                                        <td>{{number_format($total,0,',','.')}}đ</td>
                                    </tr>
                                    @if(Session::get('coupon'))
                                        @foreach (Session::get('coupon') as $key => $cou)
                                            @if ($cou['condition'] == 1)
                                                @php
                                                    $total_coupon = ($total*$cou['sale'])/100;   
                                                @endphp
                                                <tr>
                                                    <th>Mã giảm giá</th>
                                                    <td>- {{ number_format($total_coupon,0,',','.') }} đ</td>
                                                </tr>
                                            @elseif($cou['condition'] == 2)
                                                    @php
                                                        $total_coupon = $cou['sale'];   
                                                    @endphp
                                                <tr>
                                                    <th>Mã giảm giá</th>
                                                    <td>- {{ number_format($cou['sale'],0,',','.') }} đ</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endif
                                    @if (Session::get('fee'))
                                    <tr>
                                        <th>Phí giao hàng</th>
                                        <td>{{number_format(Session::get('fee'),0,',','.')}}đ</td>
                                    </tr>
                                    @endif
                                   @php
                                       if(Session::get('fee') && !Session::get('coupon')){
                                           $total_order = $total + Session::get('fee');
                                       }elseif(!Session::get('fee') && Session::get('coupon')){
                                            $total_order = $total - $total_coupon;
                                       }elseif(Session::get('fee') && Session::get('coupon')){
                                            $total_order = $total - $total_coupon + Session::get('fee');
                                       }elseif(!Session::get('fee') && !Session::get('coupon')){
                                            $total_order = $total;
                                       }
                                   @endphp
                                    <tr>
                                        <th>Tổng tiền</th>
                                        <td><strong>{{number_format($total_order,0,',','.')}}đ</strong></td>
                                    </tr>
                                </tfoot>
                               
                            </table>    
                        </div>
                        
                    </div>
                    <form>
                        <div class="order-wrapper">
                            <div class="mb-30">
                                <h3>Hình thức thanh toán</h3>
                                    <label><input name="payment" value="1" type="radio" class="payment"> Thanh toán bằng thẻ ATM</label>
                                    <label><input name="payment" value="2" type="radio" class="payment"> Thanh toán bằng tiền mặt</label>
                                    <label><input name="payment" value="3" type="radio" class="payment"> Thanh toán qua MoMo</label>
                                    
                            </div>
                            <div class="">
                                <h3>Ghi chú</h3>
                                <div class="order-notes">
                                    <textarea id="order_note" class="note" placeholder="Ghi chú..." name="note" rows="2"></textarea>
                                </div> 
                            </div>
                            <div class="">
                                @if (Session::get('fee'))
                                    <input type="hidden" name="order_fee" class="order_fee" value="{{ Session::get('fee') }}">
                                @else
                                    <input type="hidden" name="order_fee" class="order_fee" value="250000">
                                @endif
                                @if (Session::get('coupon'))
                                    @foreach (Session::get('coupon') as $key => $cou) 
                                        <input type="hidden" name="order_coupon" class="order_coupon" value="{{ $cou['code'] }}">  
                                    @endforeach
                                    @else
                                        <input type="hidden" name="order_coupon" class="order_coupon" value="no">
                                @endif
                            </div>
                        </div>
                        <div class="order-button">
                            <button  type="button" name="send-order-" class="send-order">Đặt hàng</button> 
                        </div>
                    </form>
                    
                </div>
                @endif
            </div> 
        </div>     
    </div>    
</div>
@endsection
@section('js')
    <script>
        $(document).ready(function(){

            fetch_address();

            function fetch_address(){
            var _token = $('input[name="_token"]').val();
             $.ajax({
                url : '{{url('/checkout')}}',
                method: 'POST',
                data:{_token:_token},
                success:function(data){
                   $('#load_address').html(data);
                }
            });
        }
            $('.choose').on('change', function(){
                var action = $(this).attr('id');
                var ma_id = $(this).val();
                var _token = $('input[name="_token"]').val();
                var result = '';
                
                if(action=='province'){
                    result = 'district';
                    
                }else{
                    result = 'commune';
                } 
                $.ajax({
                    url : '{{url('/billing-address')}}',
                    method: 'POST',
                    data:{action:action,ma_id:ma_id,_token:_token},
                    success:function(data){
                        $('#'+result).html(data);     
                    }
                });
            });
            $('.send-address').click(function(){
                var matp = $('.province').val();
                var maqh = $('.district').val();
                var xaid = $('.commune').val();
                var name = $('.name').val();
                var phone = $('.phone_number').val();
                var address = $('.address').val();
            
                var _token = $('input[name="_token"]').val();
                if(matp == '' && maqh =='' && xaid ==''){
                    alert('Làm ơn chọn để tính phí vận chuyển');
                }else{
                    $.ajax({
                        url : '{{url('/send-address')}}',
                        method: 'POST',
                        data:{matp:matp,maqh:maqh,xaid:xaid,_token:_token,name:name,phone:phone,address:address},
                        success:function(){
                        location.reload(); 
                        }
                    });
                } 
            });
            $('.select-address').click(function(){
                var id = $("input[type='radio'][name='shipping_fee']:checked").val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url : '{{url('/select-address')}}',
                    method: 'POST',
                    data:{id:id,_token:_token},
                    success:function(){
                    location.reload(); 
                    }
                });
                
            });
            $('.send-order').click(function(){
                swal({
                    title: "Xác nhận mua hàng?",
                    text: "You will not be able to recover this imaginary file!",
                    type: "info",
                    showCancelButton: true,
                    confirmButtonClass: "btn-success",
                    confirmButtonText: "Đồng ý!",
                    cancelButtonText: "Không!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                    },
                    function(isConfirm) {
                    if (isConfirm) {
                        var payment = $("input[type='radio'][name='payment']:checked").val();
                        var note = $('.note').val();
                        var order_fee = $('.order_fee').val();
                        var order_coupon = $('.order_coupon').val();
                    
                        var _token = $('input[name="_token"]').val();

                        $.ajax({
                            url : '{{url('/confirm-order')}}',
                            method: 'POST',
                            data:{_token:_token, payment:payment, note:note, order_fee:order_fee, order_coupon:order_coupon},
                            success:function(){
                                swal("Thành công!", "Đơn hàng của bạn đã được xác nhận.", "success");
                            }
                        });
                        window.setTimeout(function(){ 
                             window.location.href = "{{url('/history')}}";
                        } ,3000);
                    } else {
                        swal("Đóng!", "Đơn hàng chưa hoàn thành.", "error");
                    }
                });
                
            
            });
        })
    </script>
@endsection