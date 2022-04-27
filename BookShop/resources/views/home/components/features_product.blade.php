<div class="features_product pt-90">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="section_title text-center">
                    <h3> Featured products </h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="features_product_active owl-carousel">
                @foreach($feature_product as $product)
                <div class="col-lg-2">
                    <div class="single__product">
                        <div class="single_product__inner">
                            <span class="new_badge">new</span>
                            <div class="sale_off">
                                <span class="sale__off-percent">- {{ $product->sale }}%</span>
                            </div>
                            <div class="product_img">
                            <a href="{{ route('product_detail', ['slug' => $product->slug]) }}">
                                <img src="{{ asset('public'.$product->avatar_path) }}" alt="">
                                </a>
                            </div>
                            <div class="product__content text-center">
                                <div class="produc_desc_info">
                                    <div class="product_title">
                                        <h4><a href="{{ route('product_detail', ['slug' => $product->slug]) }}">{{ $product->name }}</a></h4>
                                    </div>
                                    <div class="product_price">
                                        @php
                                            $price_current = $product->price - ($product->price*$product->sale/100);
                                        @endphp
                                        <span class="product__price-current">{{ number_format($price_current,0,',','.')  }} đ</span>
                                        <span class="product__price-old">{{ number_format($product->price,0,',','.')  }} đ</span>
                                    </div>
                                </div>
                                <div class="product__hover">
                                    <ul>
                                        <form action="">
                                            {{ csrf_field() }}
                                            <input type="hidden" value="{{$product->id}}" class="cart_product_id_{{$product->id}}">
                                            <input type="hidden" value="{{ $product->name }}" id="product_viewed{{ $product->id }}" class="cart_product_name_{{ $product->id }}">
                                            <input type="hidden" value="{{$product->avatar_path}}" class="cart_product_image_{{$product->id}}">
                                            <input type="hidden" value="{{$price_current}}" class="cart_product_price_{{$product->id}}">
                                            <input type="hidden" value="{{$product->quantity}}" class="cart_product_quantity_{{$product->id}}">
                                            <input type="hidden" value="1" class="cart_product_qty_{{ $product->id }}">
                                            <li>
                                                <button type="button" class="home_cart_{{ $product->id }}" id="{{ $product->id }}" onclick="Addtocart(this.id);">
                                                    <i class="ion-android-cart"></i>
                                                </button>
                                            </li>
                                            
                                            <li>
                                                <button style="display:none" class=" rm_home_cart_{{ $product->id }}" id="{{ $product->id }}" onclick="Deletecart(this.id);">
                                                    <i class="ion-android-cart"></i>
                                                </button>
                                            </li>
                                            <li><button type="button" title="Quick View" class=" cart-fore quick_view" data-id_product="{{ $product->id }}" data-toggle="modal" data-target="#my_modal"><i class="ion-android-open"></i></button></li> 
                                            <li><a href="{{ route('product_detail', ['slug' => $product->slug]) }}"><i class="ion-clipboard"></i></a></li>
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

