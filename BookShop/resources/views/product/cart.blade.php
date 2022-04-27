@extends('frontend.layouts.master')

@section('content')
<div class="breadcrumb_container">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-12">     
                <nav>
            <ul>
                <li><a href="{{ route('home') }}">Home ></a></li>
                <li>Cart</li>
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
                <form action="{{ route('update_cart') }}" method="POST">  
                    {{ csrf_field() }}
                    <div class="table-content table-responsive">
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
                                @foreach($content as $v_content)
            
                                <tr>
                                    <td class="product-thumbnail"><img src="{{ asset('public/'.$v_content->options->image) }}" alt=""></td>
                                    <td class="product-name"><a href="#">{{ $v_content->name }}</a></td>
                                    <td class="product-price"><span class="amount">{{ number_format($v_content->price)  }} đ</span></td>
                                    <td class="product-quantity">
                                        <div class="quickview_plus_minus quick_cart">
                                            <div class="quickview_plus_minus_inner">
                                                <div class="cart-plus-minus cart_page">
                                                    {{-- <form action="{{ route('update_cart') }}" method="POST"> --}}
                                                        {{ csrf_field() }}
                                                        <input type="text" value="{{ $v_content->qty }}" name="qty_cart" class="cart-plus-minus-box">
                                                        <input type="hidden" value="{{ $v_content->rowId }}" name="rowId_cart" class="from-control">
                                                        {{-- <button class="update-cart" type="submit">Update Cart</button> --}}
                                                
                                                    {{-- </form> --}}
                                                </div>
                                            </div>    
                                        </div> 
                                    </td>
                                    <td class="product-subtotal">{{ number_format($v_content->price*$v_content->qty) }} đ</td>
                                    <td class="product-remove"><a href="{{ route('delete_cart', [$v_content->rowId]) }}">X</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        
                        </table>
                    </div>
                    <div class="row table-responsive_bottom">
                        <div class="col-lg-7 col-sm-7 col-md-7">
                           <div class="buttons-carts">
                                <button class="update-cart" type="submit">Update Cart</button>
                                <a href="#">Continue Shopping</a>   
                            </div> 
                            <div class="buttons-carts coupon">
                                <h3>Coupon</h3>
                                <p>Enter your coupon code if you have one.</p>
                                <input placeholder="Coupon code" type="text"> 
                                <input value="Apply Coupon" type="submit">     
                            </div>
                        </div> 
                        <div class="col-lg-5 col-sm-5 col-md-5">
                             <div class="cart_totals  text-right">
                                <h2>Cart Totals</h2>
                                <div class="cart-subtotal">
                                    <span>Subtotal</span>    
                                    <span>{{ Cart::subtotal().' '. 'đ' }}</span>    
                                </div>
                                <div class="cart-subtotal">
                                    <span>Taxt</span>    
                                    <span>{{ Cart::tax().' '. 'đ' }}</span>    
                                </div>
                                <div class="order-total">
                                    <span><strong>Total</strong> </span>          
                                    <span><strong>{{ Cart::total().' '. 'đ' }} </strong> </span>
                                </div>
                                <div class="wc-proceed-to-checkout">
                                    <?php 
                                        $customer_id = Session::get('id');
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
                </form>         
            </div>    
        </div>    
    </div>   
</div>
@endsection