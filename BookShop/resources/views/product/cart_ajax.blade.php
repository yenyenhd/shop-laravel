@extends('layouts.master')

@section('content')
<div class="breadcrumb_container">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">     
                <nav>
            <ul>
                <li>
                    <a href="{{ route('home') }}">Home ></a>
                </li>
                <li> cart </li>
            </ul>
        </nav>
            </div>
        </div> 
    </div>        
</div>
 <!--breadcrumb area end-->
<div class="cart_main_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="{{ route('update_cart_ajax') }}" method="POST">  
                    {{ csrf_field() }}
                    <div class="table-content table-responsive">
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
                        <table>
                            <thead>
                                <tr>
                                    <th class="img-thumbnail">Hình ảnh</th>
                                    <th class="product-name">Sản phẩm</th>
                                     <th class="product-price">Giá</th>
                                    <th class="product-quantity">Số lượng</th>
                                    <th class="product-subtotal">Thành tiền</th>
                                    <th class="product-remove">Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(Session::get('cart'))
                                @php
								    $total = 0;
						        @endphp
						        @foreach(Session::get('cart') as $key => $cart)
							    @php 
								    $subtotal = $cart['price']*$cart['quantity'];
								    $total+=$subtotal;
							    @endphp
                                <tr>
                                    <td width="15%" class="product-thumbnail"><img src="{{ asset('public/'.$cart['avatar_path']) }}" alt=""></td>
                                    <td width="25%" class="product-name"><a href="#">{{$cart['name']}}</a></td>
                                    <td width="15%" class="product-price"><span class="amount">{{ number_format($cart['price'],0,',','.')  }} đ</span></td>
                                    <td width="15%" class="product-quantity">
                                        <div class="quickview_plus_minus quick_cart">
                                            <div class="quickview_plus_minus_inner">
                                                <div class="cart-plus-minus cart_page">
                                                    <input type="text" value="{{$cart['quantity']}}" name="qty_cart[{{ $cart['session_id'] }}]" class="cart-plus-minus-box">
                                                </div>
                                            </div>    
                                        </div> 
                                    </td>
                                    <td width="15%" class="product-subtotal">{{number_format($subtotal,0,',','.')}}đ</td>
                                    <td width="10%" class="product-remove"><a href="{{ route('delete_cart_ajax', [$cart['session_id']]) }}">X</a></td>
                                </tr>
                                @endforeach
                            @else
                                @php 
                                echo 'Làm ơn thêm sản phẩm vào giỏ hàng';
                                @endphp
                               
                            @endif
                            </tbody>
                        
                        </table>
                    </div>
                    @if(Session::get('cart'))
                    <div class="row table-responsive_bottom">
                        <div class="col-lg-7 col-sm-7 col-md-7">
                           <div class="buttons-carts">
                                <button class="update-cart" type="submit">Update Cart</button>
                                <a href="{{ route('home') }}">Continue Shopping</a>
                                <a href="{{ route('delete_all') }}">Delete All</a>  
                                
                            </div> 
                        </div> 
                        <div class="col-lg-5 col-sm-5 col-md-5">
                             <div class="cart_totals  text-right">
                                <h2>Cart Totals</h2>
                                <div class="cart-subtotal">
                                    <span>Tiền hàng</span>    
                                    <span>{{number_format($total,0,',','.')}}đ</span>    
                                </div>
                                <div class="cart-subtotal">
                                    <span>Thuế</span>    
                                    <span>{{ Cart::tax().' '. 'đ' }}</span>    
                                </div>
                                @if(Session::get('coupon'))
                                    @foreach (Session::get('coupon') as $key => $cou)
                                        @if ($cou['condition'] == 1)
                                            @php
                                                $total_coupon = ($total*$cou['sale'])/100;
                                            @endphp
                                            <div class="cart-subtotal">
                                                <span>Mã giảm giá</span>
                                                <span>- {{ number_format($total_coupon,0,',','.') }} đ</span>
                                            </div>
                                            <div class="cart-subtotal">
                                                @php
                                                    $total_order = $total - $total_coupon;
                                                @endphp
                                                <span><strong>Tổng</strong></span>
                                                <span>{{ number_format($total_order,0,',','.') }} đ</span>
                                            </div>  
                                        @elseif($cou['condition'] == 2)
                                            @php
                                                $total_coupon = $cou['sale'];
                                            @endphp
                                            <div class="cart-subtotal">
                                                <span>Mã giảm giá</span>
                                                <span>- {{ number_format($total_coupon,0,',','.') }} đ</span>
                                            </div>
                                            <div class="cart-subtotal">
                                                <span><strong>Tổng</strong></span>
                                                @php
                                                    $total_order = $total - $total_coupon;
                                                @endphp
                                                <span>{{ number_format($total_order,0,',','.') }} đ</span>
                                            </div>
                                        @endif
                                    @endforeach 
                                @else
                                    <div class="cart-subtotal">
                                        <span><strong>Tổng</strong></span>    
                                        <span>{{number_format($total,0,',','.')}}đ</span>    
                                    </div>
                                @endif
                                <div class="wc-proceed-to-checkout">
                                    <?php 
                                        $customer_id = Session::get('customer_id');
                                        if($customer_id != NULL){
                                        ?>
                                            <a href="{{ route('checkout') }}">Thanh toán</a>
                                        
                                        <?php } else{ ?>
                                            <a href="{{ route('login_checkout') }}">Thanh toán</a>
                                        <?php } ?>
                                    
                                </div>
                             </div>    
                        </div>    
                    </div>
                    @endif
                </form>
                @if (Session::get('cart'))
                <form action="{{ route('check_coupon') }}" method="POST">
                    {{ csrf_field() }}
                    @if(session('error'))
                        <div class="alert alert-danger mt-30">
                            {{session('error')}}
                        </div>
                    @endif
                        <div class="buttons-carts coupon">
                            <h3>Coupon</h3>
                            <p>Enter your coupon code if you have one.</p>
                            <input placeholder="Coupon code" type="text" name="coupon"> 
                            <input value="Apply Coupon" type="submit">
                            @if (Session::get('coupon'))
                                <a href="{{ route('delete_coupon') }}">Delete Coupon</a>
                             @endif    
                        </div>
                    </form>
                @endif
                       
            </div>    
        </div>    
    </div>   
</div>
@endsection
