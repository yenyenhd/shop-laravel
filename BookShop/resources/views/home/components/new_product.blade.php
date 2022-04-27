<div class="new_product">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="section_title space_2 text-left">
                    <h3>New Product</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="features_product_active owl-carousel">
                @foreach($new_product as $new)
                <div class="col-lg-2">
                    <div class="single__product">
                        <div class="single_product__inner">
                            <span class="new_badge">new</span>
                            <div class="sale_off">
                                <span class="sale__off-percent">- {{ $new->sale }}%</span>
                            </div>
                            <div class="product_img">
                            <a href="#">
                                <img src="{{ asset('public'.$new->avatar_path) }}" alt="">
                                </a>
                            </div>
                            <div class="product__content text-center">
                                <div class="produc_desc_info">
                                    <div class="product_title">
                                        <h4><a href="{{ route('product_detail', ['slug' => $new->slug]) }}">{{ $new->name }}</a></h4>
                                    </div>
                                    <div class="product_price">
                                        @php
                                        $price_current = $new->price - ($new->price*$new->sale/100);
                                        @endphp
                                       <span class="product__price-current">{{ number_format($price_current,0,',','.')  }} đ</span>
                                       <span class="product__price-old">{{ number_format($new->price,0,',','.')  }} đ</span>
                                    </div>
                                </div>
                               
                                <div class="product__hover">
                                    
                                    <ul>
                                        <form action="">
                                            {{ csrf_field() }}
                                            <input type="hidden" value="{{$new->id}}" class="cart_product_id_{{$new->id}}">
                                            <input type="hidden" value="{{$new->name }}" id="product_viewed{{ $new->id }}" class="cart_product_name_{{ $new->id }}">
                                            <input type="hidden" value="{{$new->avatar_path}}" class="cart_product_image_{{$new->id}}">
                                            <input type="hidden" value="{{$price_current}}" class="cart_product_price_{{$new->id}}">
                                            <input type="hidden" value="{{$new->quantity}}" class="cart_product_quantity_{{$new->id}}">
                                            <input type="hidden" value="1" class="cart_product_qty_{{ $new->id }}">
                                            <li>
                                                <button type="button" class="home_cart_{{ $new->id }}" id="{{ $new->id }}" onclick="Addtocart(this.id);">
                                                    <i class="ion-android-cart"></i>
                                                </button>
                                            </li>
                                            
                                            <li>
                                                <button style="display:none" class=" rm_home_cart_{{ $new->id }}" id="{{ $new->id }}" onclick="Deletecart(this.id);">
                                                    <i class="ion-android-cart"></i>
                                                </button>
                                            </li>
                                            <li><button type="button" title="Quick View"class=" cart-fore quick_view" data-id_product="{{ $new->id }}" data-toggle="modal" data-target="#my_modal"><i class="ion-android-open"></i></button></li> 
                                            <li><a href="{{ route('product_detail', ['slug' => $new->slug]) }}"><i class="ion-clipboard"></i></a></li>
                                        </form>
                        
                                    </ul>
                                
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>