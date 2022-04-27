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
                <li> tag > </li>
                <li> {{ $product_tag }} </li>
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

                               <li class="has-sub"><a href="#">Fresh Fruit </a>
                                    <ul class="categorie_sub">
                                       <li><a href="#">Cucumber</a></li>
                                        <li><a href="#">Tomato</a></li>
                                        <li><a href="#">Potato</a></li>
                                        <li><a href="#">Onion</a></li>
                                        <li><a href="#">Grocery</a></li>
                                    </ul>

                                </li>

                                <li class="has-sub"><a href="#">Flowers </a>
                                    <ul class="categorie_sub">
                                       <li><a href="#">Banana</a></li>
                                        <li><a href="#">Orange</a></li>
                                        <li><a href="#">Plum</a></li>
                                        <li><a href="#">Sauces</a></li>
                                        <li><a href="#">Organics</a></li>
                                    </ul>

                                </li>

                                <li class="has-sub"><a href="#">Organics </a>
                                    <ul class="categorie_sub">
                                       <li><a href="#">Dryfruits</a></li>
                                        <li><a href="#">Flowers</a></li>
                                        <li><a href="#">Organics</a></li>
                                        <li><a href="#">Freshers</a></li>
                                        <li><a href="#">Beverages</a></li>
                                    </ul>
                                </li>
                            </ul>   
                        </div>
                    </div>
                    <div class="search_filters_wrapper">
                        <div class="price_filter widget">
                            <div class="widget_title">
                                <h3>filter By price</h3>
                            </div>
                            <div class="search_filters widget">
                                <div id="slider-range"></div>
                                <input type="text" name="text" id="amount" />    
                            </div>
                        </div>
                        
                        <div class="size_clearfix widget  mb-30">
                            <div class="widget_title">
                                <h3>Size</h3>
                            </div>
                            <ul>
                                <li>
                                    <input id="facet_size" type="checkbox">
                                    <label for="facet_size">S (11)</label>
                                </li>

                                <li>
                                     <input id="facet_size_one" type="checkbox">
                                    <label for="facet_size_one">M(11)</label>
                                </li>
                                <li>
                                    <input id="facet_size_two" type="checkbox">
                                    <label for="facet_size_two">L(11)</label>
                                </li>
                            </ul>    
                        </div>
                        <div class="color_clearfix widget mb-30">
                            <div class="widget_title">
                                <h3>color</h3>
                            </div>
                            <ul>
                                 <li>
                                    <input id="balck" checked="checked" class="input_color" name="color1"  type="radio"> 
                                    <label for="balck" class="color_btns"></label> 
                                    <a href="#"> Beige(5)</a>
                                </li>
                                <li>
                                    <input id="White" checked="checked" class="input_color" name="color1"  type="radio"> 
                                    <label for="White" class="color_btns1"></label> 
                                    <a href="#"> White(7)</a>
                                </li>

                               <li>
                                    <input id="Red" checked="checked" class="input_color" name="color1"  type="radio"> 
                                    <label for="Red" class="color_btns2"></label> 
                                    <a href="#"> Red(6)</a>
                                </li>
                                <li>
                                    <input id="gray" checked="checked" class="input_color" name="color1"  type="radio"> 
                                    <label for="gray" class="color_btns3"></label> 
                                    <a href="#"> gray(4)</a>
                                </li>
                               <li>
                                    <input id="Orange" checked="checked" class="input_color" name="color1"  type="radio"> 
                                    <label for="Orange" class="color_btns4"></label> 
                                    <a href="#">Orange(3)</a>
                                </li>
                               <li>
                                    <input id="Blue" checked="checked" class="input_color" name="color1"  type="radio"> 
                                    <label for="Blue" class="color_btns6"></label> 
                                    <a href="#"> Blue(8)</a>
                                </li>
                                <li>
                                    <input id="yellow" checked="checked" class="input_color" name="color1"  type="radio"> 
                                    <label for="yellow" class="color_btns7"></label> 
                                    <a href="#"> yellow(2)</a>
                                </li>
                            </ul>    
                        </div> 
                        <div class="Compositions widget mb-30">
                            <div class="widget_title">
                                <h3>Compostions</h3>
                            </div>
                            <ul>
                               <li>
                                    <input type="checkbox" id="com1"> 
                                    <label for="com1">Cotton(6)</label>
                               </li>
                                <li>
                                    <input type="checkbox" id="com2"> 
                                    <label for="com2">Polyester(4)</label>
                               </li>
                                <li>
                                    <input type="checkbox" id="com3"> 
                                    <label for="com3">Viscose(4)</label>
                               </li>
                            </ul>

                        </div>
                        <div class="Compositions widget mb-30">
                           <div class="widget_title">
                                <h3>Size</h3>
                            </div>
                           <ul>
                                <li>
                                    <input type="checkbox" id="st1"> 
                                    <label for="st1">Casual(6)</label>
                               </li>
                                <li>
                                    <input type="checkbox" id="st2"> 
                                    <label for="st2">Dressy(2)</label>
                               </li>
                                <li>
                                    <input type="checkbox" id="st3"> 
                                    <label for="st3">Girly(4)</label>
                               </li>

                           </ul>

                        </div>
                        <div class="Compositions widget mb-30">
                            <div class="widget_title">
                                <h3>Properties</h3>
                            </div>
                            <ul>
                               <li>
                                    <input type="checkbox" id="pro1"> 
                                    <label for="pro1"> Colorful Dress(6)</label>
                               </li>
                                <li>
                                    <input type="checkbox" id="pro2"> 
                                    <label for="pro2"> Maxi Dress(2)</label>
                               </li>
                                <li>
                                    <input type="checkbox" id="pro3"> 
                                    <label for="pro3">Midi Dress(4)</label>
                               </li>
                                <li>
                                    <input type="checkbox" id="pro4"> 
                                    <label for="pro4">Short Dress(7)</label>
                               </li>
                                <li>
                                    <input type="checkbox" id="pro5"> 
                                    <label for="pro5">Short Sleeve(4)</label>
                               </li>

                            </ul>

                        </div>      
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-12 col-12">
                <div class="categories_banner">
                    <h3>Tag: {{ $product_tag }}</h3>
                </div>
                <div class="tab_product_wrapper">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="shop_active" >
                            <div class="row">
                                @foreach($pro_tag as $pro)
                                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                                    <div class="single__product">
                                        <div class="single_product__inner">
                                            <span class="new_badge">new</span>
                                            <div class="sale_off">
                                                <span class="sale__off-percent">- {{ $pro->product->sale }}%</span>
                                            </div>
                                            <div class="product_img">
                                                <a href="{{ route('product_detail', ['slug' => $pro->product->slug]) }}">
                                                    <img src="{{ asset('public'.$pro->product->avatar_path) }}" alt="">
                                                </a>
                                            </div>
                                            <div class="product__content text-center">
                                                <div class="produc_desc_info">
                                                    <div class="product_title">
                                                        <h4><a href="{{ route('product_detail', ['slug' => $pro->product->slug]) }}">{{ $pro->product->name }}</a></h4>
                                                    </div>
                                                    <div class="product_price">
                                                        <p>{{ number_format($pro->product->price,0,',','.')  }} đ</p>
                                                    </div>
                                                </div>
                                                <div class="product__hover">
                                                    <ul>
                                                        <form action="">
                                                            {{ csrf_field() }}
                                                            <li><a href="#"><i class="ion-android-cart"></i></a></li>
                                                            <li><button type="button" title="Quick View"class=" cart-fore quick_view" data-id_product="{{ $pro->product->id }}" data-toggle="modal" data-target="#my_modal"><i class="ion-android-open"></i></button></li> 
                                                            <li><a href="{{ route('product_detail', ['slug' => $pro->product->slug]) }}"><i class="ion-clipboard"></i></a></li>
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
                            <div class="tab_product_bottom_wrapper">    
                                <div class="row">
                                   <div class="col-lg-4 col-md-5 col-sm-5">
                                        <div class="single_product__inner inner_shop">
                                            <span class="new_badge">new</span>
                                            <span class="discount_price">-5%</span>
                                            <div class="product_img">
                                                <a href="#">
                                                    <img src="assets/img/product/207.jpg" alt="">
                                                </a>
                                            </div>

                                        </div> 
                                    </div> 
                                    <div class="col-lg-8 col-md-7 col-sm-7">
                                        <div class="product__content text-left">
                                            <div class="produc_desc_info">
                                                <div class="product_title title_shop">
                                                    <h4><a href="product-details.html">Cheese Butter Burger</a></h4>
                                                </div>
                                                <div class="product_price price_shop">
                                                   <p class="regular_price">$65.51</p>
                                                    <p>$75.66</p>
                                                </div>
                                                <div class="product_content_shop">
                                                    <p>Faded short sleeves t-shirt with high neckline. Soft and stretchy material for a comfortable fit. Accessorize with a straw hat and you're ready for summer!</p>
                                                </div>
                                            </div>
                                            <div class="product__hover hover_shop">
                                               <div class="product_addto_cart">
                                                    <button type="submit">ADD TO CART</button> 
                                               </div>
                                               <div class="product_cart_icone">
                                                    <ul>
                                                        <li><a href="#"><i class="ion-android-cart"></i></a></li>
                                                        <li><a class="cart-fore" href="#" data-toggle="modal" data-target="#my_modal"  title="Quick View" ><i class="ion-android-open"></i></a></li>

                                                        <li><a href="product-details.html"><i class="ion-clipboard"></i></a></li>
                                                    </ul>
                                                </div>    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab_product_bottom_wrapper">    
                                <div class="row">
                                   <div class="col-lg-4 col-md-5 col-sm-5">
                                        <div class="single_product__inner inner_shop">
                                            <span class="new_badge">new</span>
                                            <span class="discount_price">-5%</span>
                                            <div class="product_img">
                                                <a href="#">
                                                    <img src="assets/img/product/7.jpg" alt="">
                                                </a>
                                            </div>

                                        </div> 
                                    </div> 
                                    <div class="col-lg-8 col-md-7 col-sm-7">
                                        <div class="product__content text-left">
                                            <div class="produc_desc_info">
                                                <div class="product_title title_shop">
                                                    <h4><a href="product-details.html">Cheese Butter Burger</a></h4>
                                                </div>
                                                <div class="product_price price_shop">
                                                   <p class="regular_price">$65.51</p>
                                                    <p>$75.66</p>
                                                </div>
                                                <div class="product_content_shop">
                                                    <p>Faded short sleeves t-shirt with high neckline. Soft and stretchy material for a comfortable fit. Accessorize with a straw hat and you're ready for summer!</p>
                                                </div>
                                            </div>
                                            <div class="product__hover hover_shop">
                                               <div class="product_addto_cart">
                                                    <button type="submit">ADD TO CART</button> 
                                               </div>
                                               <div class="product_cart_icone">
                                                    <ul>
                                                        <li><a href="#"><i class="ion-android-cart"></i></a></li>
                                                        <li><a class="cart-fore" href="#" data-toggle="modal" data-target="#my_modal"  title="Quick View" ><i class="ion-android-open"></i></a></li>
                                                        <li><a href="product-details.html"><i class="ion-clipboard"></i></a></li>
                                                    </ul>
                                                </div>    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <div class="tab_product_bottom_wrapper">    
                                <div class="row">
                                   <div class="col-lg-4 col-md-5 col-sm-5">
                                        <div class="single_product__inner inner_shop">
                                            <span class="new_badge">new</span>
                                            <div class="product_img">
                                                <a href="#">
                                                    <img src="assets/img/product/6.jpg" alt="">
                                                </a>
                                            </div>

                                        </div> 
                                    </div> 
                                    <div class="col-lg-8 col-md-7 col-sm-7">
                                        <div class="product__content text-left">
                                            <div class="produc_desc_info">
                                                <div class="product_title title_shop">
                                                    <h4><a href="product-details.html">Cheese Butter Burger</a></h4>
                                                </div>
                                                <div class="product_price price_shop">
                                                   <p class="regular_price">$65.51</p>
                                                    <p>$75.66</p>
                                                </div>
                                                <div class="product_content_shop">
                                                    <p>Faded short sleeves t-shirt with high neckline. Soft and stretchy material for a comfortable fit. Accessorize with a straw hat and you're ready for summer!</p>
                                                </div>
                                            </div>
                                            <div class="product__hover hover_shop">
                                               <div class="product_addto_cart">
                                                    <button type="submit">ADD TO CART</button> 
                                               </div>
                                               <div class="product_cart_icone">
                                                    <ul>
                                                        <li><a href="#"><i class="ion-android-cart"></i></a></li>
                                                        <li><a class="cart-fore" href="#" data-toggle="modal" data-target="#my_modal"  title="Quick View" ><i class="ion-android-open"></i></a></li>
                                                        <li><a href="product-details.html"><i class="ion-clipboard"></i></a></li>
                                                    </ul>
                                                </div>    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <div class="tab_product_bottom_wrapper">    
                                <div class="row">
                                   <div class="col-lg-4 col-md-5 col-sm-5">
                                        <div class="single_product__inner inner_shop">
                                            <span class="new_badge">new</span>
                                            <span class="discount_price">-5%</span>
                                            <div class="product_img">
                                                <a href="#">
                                                    <img src="assets/img/product/5.jpg" alt="">
                                                </a>
                                            </div>

                                        </div> 
                                    </div> 
                                    <div class="col-lg-8 col-md-7 col-sm-7">
                                        <div class="product__content text-left">
                                            <div class="produc_desc_info">
                                                <div class="product_title title_shop">
                                                    <h4><a href="product-details.html">Cheese Butter Burger</a></h4>
                                                </div>
                                                <div class="product_price price_shop">
                                                   <p class="regular_price">$65.51</p>
                                                    <p>$75.66</p>
                                                </div>
                                                <div class="product_content_shop">
                                                    <p>Faded short sleeves t-shirt with high neckline. Soft and stretchy material for a comfortable fit. Accessorize with a straw hat and you're ready for summer!</p>
                                                </div>
                                            </div>
                                            <div class="product__hover hover_shop">
                                               <div class="product_addto_cart">
                                                    <button type="submit">ADD TO CART</button> 
                                               </div>
                                               <div class="product_cart_icone">
                                                    <ul>
                                                        <li><a href="#"><i class="ion-android-cart"></i></a></li>
                                                        <li><a class="cart-fore" href="#" data-toggle="modal" data-target="#my_modal"  title="Quick View" ><i class="ion-android-open"></i></a></li>
                                                        <li><a href="product-details.html"><i class="ion-clipboard"></i></a></li>
                                                    </ul>
                                                </div>    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <div class="tab_product_bottom_wrapper">    
                                <div class="row">
                                   <div class="col-lg-4 col-md-5 col-sm-5">
                                        <div class="single_product__inner inner_shop">
                                            <span class="new_badge">new</span> 
                                            <div class="product_img">
                                                <a href="#">
                                                    <img src="assets/img/product/4.jpg" alt="">
                                                </a>
                                            </div>

                                        </div> 
                                    </div> 
                                    <div class="col-lg-8 col-md-7 col-sm-7">
                                        <div class="product__content text-left">
                                            <div class="produc_desc_info">
                                                <div class="product_title title_shop">
                                                    <h4><a href="product-details.html">Cheese Butter Burger</a></h4>
                                                </div>
                                                <div class="product_price price_shop">
                                                   <p class="regular_price">$65.51</p>
                                                    <p>$75.66</p>
                                                </div>
                                                <div class="product_content_shop">
                                                    <p>Faded short sleeves t-shirt with high neckline. Soft and stretchy material for a comfortable fit. Accessorize with a straw hat and you're ready for summer!</p>
                                                </div>
                                            </div>
                                            <div class="product__hover hover_shop">
                                               <div class="product_addto_cart">
                                                    <button type="submit">ADD TO CART</button> 
                                               </div>
                                               <div class="product_cart_icone">
                                                    <ul>
                                                        <li><a href="#"><i class="ion-android-cart"></i></a></li>
                                                        <li><a class="cart-fore" href="#" data-toggle="modal" data-target="#my_modal"  title="Quick View" ><i class="ion-android-open"></i></a></li>
                                                        <li><a href="product-details.html"><i class="ion-clipboard"></i></a></li>
                                                    </ul>
                                                </div>    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <div class="tab_product_bottom_wrapper">    
                                <div class="row">
                                   <div class="col-lg-4 col-md-5 col-sm-5">
                                        <div class="single_product__inner inner_shop">
                                            <span class="new_badge">new</span>
                                            <span class="discount_price">-5%</span>
                                            <div class="product_img">
                                                <a href="#">
                                                    <img src="assets/img/product/2.jpg" alt="">
                                                </a>
                                            </div>

                                        </div> 
                                    </div> 
                                    <div class="col-lg-8 col-md-7 col-sm-7">
                                        <div class="product__content text-left">
                                            <div class="produc_desc_info">
                                                <div class="product_title title_shop">
                                                    <h4><a href="product-details.html">Cheese Butter Burger</a></h4>
                                                </div>
                                                <div class="product_price price_shop">
                                                   <p class="regular_price">$65.51</p>
                                                    <p>$75.66</p>
                                                </div>
                                                <div class="product_content_shop">
                                                    <p>Faded short sleeves t-shirt with high neckline. Soft and stretchy material for a comfortable fit. Accessorize with a straw hat and you're ready for summer!</p>
                                                </div>
                                            </div>
                                            <div class="product__hover hover_shop">
                                               <div class="product_addto_cart">
                                                    <button type="submit">ADD TO CART</button> 
                                               </div>
                                               <div class="product_cart_icone">
                                                    <ul>
                                                        <li><a href="#"><i class="ion-android-cart"></i></a></li>
                                                        <li><a class="cart-fore" href="#" data-toggle="modal" data-target="#my_modal"  title="Quick View" ><i class="ion-android-open"></i></a></li>
                                                        <li><a href="product-details.html"><i class="ion-clipboard"></i></a></li>
                                                    </ul>
                                                </div>    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <div class="tab_product_bottom_wrapper">    
                                <div class="row">
                                   <div class="col-lg-4 col-md-5 col-sm-5">
                                        <div class="single_product__inner inner_shop">
                                            <span class="new_badge">new</span>
                                            <div class="product_img">
                                                <a href="#">
                                                    <img src="assets/img/product/1.jpg" alt="">
                                                </a>
                                            </div>

                                        </div> 
                                    </div> 
                                    <div class="col-lg-8 col-md-7 col-sm-7">
                                        <div class="product__content text-left">
                                            <div class="produc_desc_info">
                                                <div class="product_title title_shop">
                                                    <h4><a href="product-details.html">Cheese Butter Burger</a></h4>
                                                </div>
                                                <div class="product_price price_shop">
                                                   <p class="regular_price">$65.51</p>
                                                    <p>$75.66</p>
                                                </div>
                                                <div class="product_content_shop">
                                                    <p>Faded short sleeves t-shirt with high neckline. Soft and stretchy material for a comfortable fit. Accessorize with a straw hat and you're ready for summer!</p>
                                                </div>
                                            </div>
                                            <div class="product__hover hover_shop">
                                               <div class="product_addto_cart">
                                                    <button type="submit">ADD TO CART</button> 
                                               </div>
                                               <div class="product_cart_icone">
                                                    <ul>
                                                        <li><a href="#"><i class="ion-android-cart"></i></a></li>
                                                        <li><a class="cart-fore" href="#" data-toggle="modal" data-target="#my_modal"  title="Quick View" ><i class="ion-android-open"></i></a></li>
                                                        <li><a href="product-details.html"><i class="ion-clipboard"></i></a></li>
                                                    </ul>
                                                </div>    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <div class="tab_product_bottom_wrapper">    
                                <div class="row">
                                   <div class="col-lg-4 col-md-5 col-sm-5">
                                        <div class="single_product__inner inner_shop">
                                            <span class="new_badge">new</span>
                                            <span class="discount_price">-5%</span>
                                            <div class="product_img">
                                                <a href="#">
                                                    <img src="assets/img/product/103.jpg" alt="">
                                                </a>
                                            </div>

                                        </div> 
                                    </div> 
                                    <div class="col-lg-8 col-md-7 col-sm-7">
                                        <div class="product__content text-left">
                                            <div class="produc_desc_info">
                                                <div class="product_title title_shop">
                                                    <h4><a href="product-details.html">Cheese Butter Burger</a></h4>
                                                </div>
                                                <div class="product_price price_shop">
                                                   <p class="regular_price">$65.51</p>
                                                    <p>$75.66</p>
                                                </div>
                                                <div class="product_content_shop">
                                                    <p>Faded short sleeves t-shirt with high neckline. Soft and stretchy material for a comfortable fit. Accessorize with a straw hat and you're ready for summer!</p>
                                                </div>
                                            </div>
                                            <div class="product__hover hover_shop">
                                               <div class="product_addto_cart">
                                                    <button type="submit">ADD TO CART</button> 
                                               </div>
                                               <div class="product_cart_icone">
                                                    <ul>
                                                        <li><a href="#"><i class="ion-android-cart"></i></a></li>
                                                        <li><a class="cart-fore" href="#" data-toggle="modal" data-target="#my_modal"  title="Quick View" ><i class="ion-android-open"></i></a></li>
                                                        <li><a href="product-details.html"><i class="ion-clipboard"></i></a></li>
                                                    </ul>
                                                </div>    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>     
                        </div>
                    </div>  
                   
                </div>
                <div class="shop_pagination">
                    <div class="row align-items-center">   
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="total_item_shop">
                                Showing 13-14 of 14 item(s) 
                            </div>
                        </div>
                        <div class="col-lg-6 offset-lg-2 col-md-6 col-sm-6">
                            <div class="page_list_clearfix text-center">
                                <ul>
                                    <li class="prev"><a href="#"><i class="zmdi zmdi-chevron-left"></i> Previous</a></li>
                                    <li><a href="#">1</a></li>
                                    <li class="current_page"><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li class="next"><a href="#"> Next <i class="zmdi zmdi-chevron-right"></i></a></li>
                                </ul> 
                            </div>         
                        </div>
                    </div>          
                </div>
            </div> 
        </div>
    </div>
</div>
@include('home.components.brand_logo')

@endsection
