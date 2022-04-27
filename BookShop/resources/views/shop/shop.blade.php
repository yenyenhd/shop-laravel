@extends('layouts.master')

@section('content')
<div class="breadcrumb_container">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">     
                <nav>
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a> ></li>
                        @foreach($category_name as $key => $name)
                        <li>{{$name->name}}</li>
                        @endforeach
                    </ul>
                </nav>
            </div>
        </div> 
    </div>        
</div>
<div class="shop_wrapper ptb-90">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-8 col-12">
                <div class="shop_sidebar">
                    <div class="block_categories">
                        <div class="category_top_menu widget">
                            <div class="widget_title">
                                <h3>categories</h3>
                            </div>
                            <ul class="shop_toggle">
                            @foreach($categories as $cate)
                                @if($cate->parent_id == 0)
                               <li class="has-sub"><a href="{{ route('category.slug', ['slug'=>$cate->slug]) }}">{{ $cate->name }} </a>
                                    <ul class="categorie_sub">
                                        @foreach($cate->categoryChildren as  $cate_sub)
                                        <li><a href="{{ route('category.slug', ['slug'=>$cate_sub->slug]) }}">{{ $cate_sub->name }}</a></li>
                                        @endforeach 
                                    </ul>
                                </li>
                                @endif
                            @endforeach
                            </ul>   
                        </div>
                    </div>
                    <div class="search_filters_wrapper">
                        <div class="price_filter widget">
                            <div class="widget_title">
                                <h3>Lọc giá</h3>
                            </div>
                           <form>
                            <div class="search_filters widget">
                                <style type="text/css">
                                    .style-range p {
                                        float: left;
                                        width: 25%;
                                    }
                                </style>
                                <div id="slider-range"></div>
                                <div class="style-range">
                                    <p><input type="text" id="amount_start" readonly style="border:0; color:#f6931f; font-weight:bold;"></p>
                                    <p><input type="text" id="amount_end" readonly style="border:0; color:#f6931f; font-weight:bold;"></p>
                                </div>
                                 
                                <input type="hidden" name="start_price" id="start_price">
                                <input type="hidden" name="end_price" id="end_price">  
                                <div class="clearfix"></div>
                                <div class="buttons-carts">
                                    <input type="submit" name="filter_price" class="update-cart" value="Lọc giá">
                                </div>
                                
                            </div>
                            </form>

                            
                        </div>
                        
                        <div class="Compositions widget mb-30">
                           <div class="widget_title">
                                <h3>Sản phẩm yêu thích</h3>
                            </div>
                           <div id="row_wishlist" class="row"></div>
                        </div>      
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-12 col-12">
                <div class="categories_banner">
                    <div class="categories_banner_inner">
                        <img src="{{ asset('public'.$banner->image_path) }}" alt="">
                    </div>
                    <h3>SHOP</h3>
                </div>
                <div class="tav_menu_wrapper">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-7 col-sm-6">
                            <div class="tab_menu shop_menu">
                                <div class="tab_menu_inner">
                                    <ul class="nav" role="tablist">
                                        <li><a  class="active" data-toggle="tab" href="#shop_active" role="tab" aria-controls="shop_active" aria-selected="true"><i class="fa fa-th" aria-hidden="true"></i></a></li>

                                        <li><a data-toggle="tab" href="#featured_active" role="tab" aria-controls="featured_active" aria-selected="false"><i class="fa fa-list" aria-hidden="true"></i></a></li>
                                    </ul>
                                </div>
                                <div class="tab_menu_right">   
                                    @php
                                        $products = $category_by_id->count();
                                    @endphp 
                                    <p>There are {{ $products }} products.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-5 col-sm-6">
                            <div class="Relevance">
                                <span>Sắp xếp theo:</span>
                                <div class="dropdown dropdown-shop">
                                    <form>
                                        {{ csrf_field() }}
                                        <select name="drop" id="sort">
                                            <option value="{{Request::url()}}?sort_by=none">--Lọc theo--</option>  
                                            <option value="{{Request::url()}}?sort_by=tang_dan">--Giá tăng dần--</option>
                                            <option value="{{Request::url()}}?sort_by=giam_dan">--Giá giảm dần--</option>
                                            <option value="{{Request::url()}}?sort_by=kytu_az">Lọc theo tên A đến Z</option>
                                            <option value="{{Request::url()}}?sort_by=kytu_za">Lọc theo tên Z đến A</option>
                                        </select>
                                    </form>
                                </div>
                            </div>    
                        </div>    
                    </div>
                </div> 
                <div class="tab_product_wrapper">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="shop_active" >
                            <div class="row">
                                @foreach($category_by_id as $key => $product)
                                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                                    <div class="single__product">
                                        <div class="single_product__inner">
                                            <span class="new_badge">new</span>
                                            <div class="sale_off">
                                                <span class="sale__off-percent">- {{ $product->sale }}%</span>
                                            </div>
                                            <div class="product_img">
                                                <a id="wishlist_producturl{{ $product->id }}" href="{{ route('product_detail', ['slug' => $product->slug]) }}">
                                                    <img id="wishlist_productimage{{ $product->id }}" src="{{ asset('public'.$product->avatar_path) }}" alt="">
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
                                                            <input type="hidden" value="{{ $product->name }}" id="wishlist_productname{{ $product->id }}" class="cart_product_name_{{ $product->id }}">
                                                            <input type="hidden" value="{{$product->avatar_path}}" class="cart_product_image_{{$product->id}}">
                                                            <input type="hidden" value="{{$price_current}}" id="wishlist_productprice{{ $product->id }}" class="cart_product_price_{{$product->id}}">
                                                            <input type="hidden" value="{{$product->quantity}}" class="cart_product_quantity_{{$product->id}}">
                                                            <input type="hidden" value="1" class="cart_product_qty_{{ $product->id }}">
                                                            <li>
                                                                <button type="button" class="button_wishlist" id="{{ $product->id }}" onclick="add_wistlist(this.id);">
                                                                    <i class="fas fa-heart"></i>
                                                                </button>
                                                            </li>
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

                        <div class="tab-pane fade" id="featured_active" role="tabpanel">
                            @foreach($category_by_id as $key => $product)
                            <div class="tab_product_bottom_wrapper">    
                                <div class="row">
                                   <div class="col-lg-4 col-md-5 col-sm-5">
                                        <div class="single_product__inner inner_shop">
                                            <span class="new_badge">new</span>
                                            <span class="discount_price">-{{ $product->sale }}%</span>
                                            
                                            <div class="product_img">
                                                <a href="{{ route('product_detail', ['slug' => $product->slug]) }}">
                                                    <img src="{{ asset('public'.$product->avatar_path) }}" alt="">
                                                </a>
                                            </div>

                                        </div> 
                                    </div> 
                                    <div class="col-lg-8 col-md-7 col-sm-7">
                                        <div class="product__content text-left">
                                            <div class="produc_desc_info">
                                                <div class="product_title title_shop">
                                                    <h4><a href="{{ route('product_detail', ['slug' => $product->slug]) }}">{{ $product->name }}</a></h4>
                                                </div>
                                                <div class="product_price price_shop">
                                                    @php
                                                        $price_current = $product->price - ($product->price*$product->sale/100);
                                                    @endphp
                                                   <p class="regular_price">{{ number_format($price_current,0,',','.')  }} đ</p>
                                                    <p>{{ number_format($product->price,0,',','.')  }} đ</p>
                                                </div>
                                                <div class="product_content_shop">
                                                    <p>{!! $product->description !!}</p>
                                                </div>
                                            </div>
                                            <div class="product__hover hover_shop">
                                                <form>
                                                    {{ csrf_field() }}
                                                    <input type="hidden" value="1" class="cart_product_qty_{{ $product->id }}">
                
                                                    <input type="hidden" value="{{$product->id}}" class="cart_product_id_{{$product->id}}">
                                                    <input type="hidden" value="{{ $product->name }}" id="product_viewed{{ $product->id }}" class="cart_product_name_{{ $product->id }}">
                                                    <input type="hidden" value="{{$product->avatar_path}}" class="cart_product_image_{{$product->id}}">
                                                    <input type="hidden" value="{{$product->price}}" class="cart_product_price_{{$product->id}}">
                                                    <input type="hidden" value="{{$product->quantity}}" class="cart_product_quantity_{{$product->id}}">
                                               <div class="product_addto_cart">
                                                    <button type="button" data-id_product="{{$product->id}}" class="add-to-cart" name="add-to-cart">ADD TO CART</button> 
                                               </div>
                                                </form>   
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>  
                   
                </div>
                <div class="shop_pagination">
                    {{ $category_by_id->links("pagination::bootstrap-4") }}  
                </div>
            </div> 
        </div>
    </div>
</div>
@include('home.components.brand_logo')
 
@endsection

@section('modal')
@include('home.modal')

@endsection
@section('js')
<script type="text/javascript">
    $(document).ready(function(){

        $('#sort').on('change',function(){
            var url = $(this).val(); 
            // alert(url);

              if (url) { 
                  window.location = url;
              }
            return false;
        });

    }); 
</script>
<script type="text/javascript">
    $(document).ready(function(){

       $( "#slider-range" ).slider({
          orientation: "horizontal",
          range: true,

          min:{{$min_price_range}},
          max:{{$max_price_range}},

          steps:10000,
          values: [ {{$min_price}}, {{$max_price}} ],
         
          slide: function( event, ui ) {
            $( "#amount_start" ).val(ui.values[ 0 ]).simpleMoneyFormat();
            $( "#amount_end" ).val(ui.values[ 1 ]).simpleMoneyFormat();


            $( "#start_price" ).val(ui.values[ 0 ]);
            $( "#end_price" ).val(ui.values[ 1 ]);

          }

        });

        $( "#amount_start" ).val($( "#slider-range" ).slider("values",0)).simpleMoneyFormat();
        $( "#amount_end" ).val($( "#slider-range" ).slider("values",1)).simpleMoneyFormat();

    }); 
</script>

@endsection