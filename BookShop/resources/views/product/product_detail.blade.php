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
                        <li> {{ $product->name }} </li>
                    </ul>
                </nav>
            </div>
        </div> 
    </div>        
</div>
 @php
     $price_current = $product->price - ($product->price*$product->sale/100);
 @endphp
<input type="hidden" id="product_viewed_id" value="{{$product->id}}">
<input type="hidden" id="viewed_productname{{$product->id}}" value="{{$product->name}}">
<input type="hidden" id="viewed_producturl{{$product->id}}" value="{{url('/product-detail/'.$product->slug)}}">
<input type="hidden" id="viewed_productimage{{$product->id}}" value="{{ asset('public'.$product->avatar_path) }}">
<input type="hidden" id="viewed_productprice{{$product->id}}" value="{{number_format($price_current,0,',','.')}}VNĐ">

<div class="table_primary_block pt-100">
    <div class="container">   
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12">
                <div class="product-flags">  
                    <ul id="imageGallery">
                        @foreach($product->productImages as $productImageItem)
                        <li data-thumb="{{ asset('public'.$productImageItem->image_path) }}" data-src="{{ asset('public'.$productImageItem->image_path) }}">
                          <img src="{{ asset('public'.$productImageItem->image_path) }}" />
                        </li>
                        @endforeach
                      </ul>
                </div>  
            </div>
            <div class="col-lg-7 col-md-7 col-sm-12">
                <div class="product__details_content">
                    <div class="demo_product">
                        <h2>{{ $product->name }}</h2> 
                        <p>{{ $product->category->name }}</p>
                    </div>
                    <div class="product_comments_block">
                        <div class="star_content clearfix">
                            <ul class="list-inline rating"  title="Average Rating">
                                @for($count=1; $count<=5; $count++)
                                    @php
                                        if($count <= $rating){
                                            $color = 'color:#ffcc00;';
                                        }
                                        else {
                                            $color = 'color:#ccc;';
                                        }
                                    
                                    @endphp
                                
                                <li title="star_rating" id="{{$product->id}}-{{$count}}" 
                                    data-index="{{$count}}"  
                                    data-rating="{{$rating}}" class="rating" 
                                    style="cursor:pointer; {{$color}} font-size:15px;">&#9733;</li>
                                @endfor

                            </ul> 
                        </div> 
                        <div class="comments_advices">
                            <ul>
                                <li><a href="#"><i class="fa fa-comment-o" aria-hidden="true"></i>
                                 Read reviews (<span>1</span>)</a></li>
                                <li><a href="#"><i class="fa fa-pencil"></i>Read reviews </a></li>
                            </ul>    
                        </div>   
                    </div>
                    <div class="current_price">
                        <span>{{ number_format($price_current,0,',','.')  }} đ</span>    
                    </div>
                    <div class="product_information">
                        <div id="product_description_short" style="margin: 15px 0">
                            {!!$product->description !!}
                        </div>
                        <div class="product_variants">
                            <form enctype="multipart/form-data">
                                {{ csrf_field() }}

                                <div class="quickview_plus_minus">
                                    <span class="control_label">Quantity</span>
                                    <div class="quickview_plus_minus_inner">
                                        <div class="cart-plus-minus">
                                            <input type="number" value="1" min="1" name="qty" class="cart-plus-minus-box cart_product_qty_{{ $product->id }}">
                                            <input type="hidden" name="productid_hidden" value="{{ $product->id }}">
                                            <input type="hidden" value="{{$product->id}}" class="cart_product_id_{{$product->id}}">
                                            <input type="hidden" value="{{ $product->name }}" id="product_viewed{{ $product->id }}" class="cart_product_name_{{ $product->id }}">
                                            <input type="hidden" value="{{$product->avatar_path}}" class="cart_product_image_{{$product->id}}">
                                            <input type="hidden" value="{{$price_current}}" class="cart_product_price_{{$product->id}}">
                                            <input type="hidden" value="{{$product->quantity}}" class="cart_product_quantity_{{$product->id}}">
                                        </div>
                                        <div class="add_button">
                                            <button type="button" data-id_product="{{$product->id}}" class="add-to-cart" name="add-to-cart"> Add to cart</button>
                                        </div>
                                    </div>    
                                </div>
                            </form>
                             
                            <div class="product-availability">
                                <span id="availability">
                                    <i class="zmdi zmdi-check"></i>
                                     In stock    
                                </span>    
                            </div> 
                            <style type="text/css">
                                a.tags_style {
                                    margin: 3px 2px;
                                    border: 1px solid;
                                  
                                    height: auto;
                                    background: #428bca;
                                    color: #ffff;
                                    padding: 0px;
                                  
                                }
                                a.tags_style:hover {
                                    background: black;
                                }
                            </style>
                            <div class="product-availability mt-30">
                                <fieldset>
									<legend>Tags</legend>
									
									<p><i class="fa fa-tag"></i>
										{{-- @php 
											$tags = $product->product_tags;
											$tags = explode(",",$tags);

										@endphp --}}
											@foreach($product->tags as $tag)
												<a href="{{ route('product_tag', ['product_tag' => $tag->name]) }}" class="tags_style">{{ $tag->name}}</a>
											@endforeach
									</p>
								</fieldset>
                            </div>
                            <div class="social-sharing">
                               <span>Share</span>
                                 
                            </div> 
                        </div>
                    </div>   
                </div>
            </div>   
        </div>
    </div>       
</div>
<!-- primary block end -->

<!-- product page tab -->

<div class="product_page_tab ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="product_tab_button">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li>
                            <a class=" tav_past active" id="home-tab" data-toggle="tab" href="#Description" role="tab" aria-controls="Description" aria-selected="true">Mô tả</a>
                        </li>
                        <li>
                            <a class=" tav_past"  id="profile-tab" data-toggle="tab" href="#details" role="tab" aria-controls="details" aria-selected="false">Thông tin</a>
                        </li>
                       <li>
                            <a class=" tav_past"  id="contact-tab" data-toggle="tab" href="#Reviews" role="tab" aria-controls="Reviews" aria-selected="false">Đánh giá</a>
                       </li>
                    </ul>
                </div>    
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="Description" role="tabpanel" >
                        <div class="product-description" style="margin-top: 15px">
                            {!! $product->description !!}
                            {!! $product->content !!} 

                       </div>
                    </div>
                    <div class="tab-pane fade" id="details" role="tabpanel">
                        <div class="product-details">
                            <div class="product-manufacturer">
                                <a href="#"><img src="assets/img/cart/11.jpg" alt=""></a>   
                            </div> 
                            <div class="product-reference">
                                <label class="label">Thể loại: </label> 
                                <span>{{ $product->category->name }}</span>  
                            </div> 
                            <div class="product-quantities">
                                <label class="label">Số lượng: </label> 
                                <span>{{ $product->quantity }}</span>   
                            </div> 
                            <div class="product-out-of-stock">
                                <section class="product-features">
                                    <h3>Data sheet</h3>
                                    <dl class="data-sheet">
                                        <dt class="name">Compositions</dt>    
                                        <dd class="value">Viscose</dd>
                                        <dt class="name">Styles</dt>
                                        <dd class="value">Dressy</dd>
                                        <dt class="name">Properties</dt> 
                                        <dd class="value">Short Dress</dd>     
                                    </dl>
                                </section>    
                            </div> 
                        </div>
                    </div>
                    <div class="tab-pane fade" id="Reviews" role="tabpanel">
                        <div class="product_comments_block_tab">
                            <div class="comment_clearfix">
                                <div class="comment_author">
                                    <div class="star_content clearfix">
                                        <ul class="list-inline rating"  title="Average Rating">
                                            @for($count=1; $count<=5; $count++)
                                                @php
                                                    if($count <= $rating){
                                                        $color = 'color:#ffcc00;';
                                                    }
                                                    else {
                                                        $color = 'color:#ccc;';
                                                    }
                                                
                                                @endphp
                                            
                                            <li title="star_rating" id="{{$product->id}}-{{$count}}" 
                                                data-index="{{$count}}"  
                                                data-product_id="{{$product->id}}" 
                                                data-rating="{{$rating}}" class="rating" 
                                                style="cursor:pointer; {{$color}} font-size:30px;">&#9733;</li>
                                            @endfor

                                        </ul> 
                                    </div> 
                                    
                                </div> 
                                <div class="blog_replay_wrapper">
                                    <form>
                                        {{ csrf_field() }}
                                        <input type="hidden" name="comment_product_id" class="comment_product_id" value="{{ $product->id }}">
                                        <div id="comment_show"></div>
                                    </form>
                                    @if(session('message'))
                                    <div class="alert alert-success">
                                        {{session('message')}}
                                    </div>
                                    @endif
                                    <h4>HAVE {{ $length }} COMMENTS</h4>
                                    @foreach($comment as $key => $comm)
                    
                                        <div class="single_blog_replay mb-50">
                                            <div class="replay_img">
                                                <a href="#"><img src="{{  url('/public/frontend/img/user.png') }}" alt=""></a>    
                                            </div>
                                            <div class="replay-info-wrapper">
                                                <div class="replay-info">
                                                    <div class="replay-name-date">
                                                        <h4><a href="#">{{ $comm->customer->name }}</a></h4>
                                                        <span>{{ $comm->created_at }}</span>    
                                                    </div>
                                                    <div class="replay-btn">
                                                        <form action="{{ route('reply_comment', ['product_id' => $product->id]) }}"  method="POST">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="comment_id" class="comment_product_id" value="{{ $comm->id }}">
                                                        <a href="" data-toggle="collapse" data-target="#Returning_customer_{{ $comm->id }}" aria-expanded="true" >Reply</a>
                                                        <div id="Returning_customer_{{ $comm->id }}" class="collapse" data-parent="#accordion">
                                                            <textarea class="form-control reply_comment_{{ $comm->id }}" rows="5" cols="50" name="content"></textarea>
                                                            <div class="add_button mt-15">
                                                                <button type="submit" class="btn-reply-comment" >Reply</button>
                                                            </div>
                                                        </form>
                                                        </div>
                                                    </div>    
                                                </div>
                                                <p>{{ $comm->content }}</p>    
                                            </div>    
                                        </div>
                                        @foreach($comment_rep as $key => $rep_comment)  
                                            @if($rep_comment->parent_id==$comm->id)  
                                         <div class="single_blog_replay two mb-50">
                                            <div class="replay_img">
                                                <a href="#"><img src="{{  url('/public/frontend/img/user.png') }}" alt=""></a>    
                                            </div>
                                            <div class="replay-info-wrapper">
                                                <div class="replay-info">
                                                    <div class="replay-name-date">
                                                        <h4><a href="#">{{ $rep_comment->customer->name }}</a></h4>
                                                        <span>{{ $rep_comment->created_at }}</span>    
                                                    </div>
                                                    <div class="replay-btn">
                                                        <a href="#">Reply</a>
                                                    </div>    
                                                </div>
                                                <p>{{ $rep_comment->content }}</p>    
                                            </div>    
                                        </div>
                                        @endif
                                        @endforeach
                                    @endforeach
                                    
                                
                                </div> 
                                <div class="review">
                                    <p><a href="#" data-toggle="collapse" data-target="#Returning_customer" aria-expanded="true">Write your review !</a></p>
                                    <div id="Returning_customer" class="collapse" data-parent="#accordion">
                                        <div class="card-bodyfive">
                                            <div class="col-lg-9">
                                                <form action="#"> 
                                                    <input type="hidden" name="comment_product_id" class="comment_product_id" value="{{ $product->id }}">
                                                    {{ csrf_field() }}
                                                    <div class="Returning_cart_body mb-20">
                                                        <textarea name="content" class="content" id="" cols="10" rows="5" placeholder="Nội dung bình luận..."></textarea>  
                                                    </div> 
                                                    <div class="add_button">
                                                        <button type="button" data-id_product="{{$product->id}}" class="send-comment" name="comment"> Comment</button>
                                                    </div>
                                                    <div id="notify_comment"></div>
                                                </form>          
                                            </div>
                                        </div>
                                    </div>       
                                </div>    
                            </div>    
                        </div>  
                   </div>
                </div>
            </div>    
         </div>    
    </div>        
</div>
<!-- product page tab end -->

<!--Features product area-->
<div class="features_product">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section_title text-left">
                    <h3> Sản phẩm liên quan </h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="related_product_active owl-carousel">
                @foreach($related_product as $related)
                <div class="col-lg-2">
                    <div class="single__product">
                        <div class="single_product__inner">
                            <span class="new_badge">new</span>
                            <div class="sale_off">
                                <span class="sale__off-percent">- {{ $related->sale }}%</span>
                            </div>
                            <div class="product_img">
                            <a href="{{ route('product_detail', ['slug' => $related->slug]) }}">
                                <img src="{{ asset('public'.$related->avatar_path) }}" alt="">
                                </a>
                            </div>
                            <div class="product__content text-center">
                                <div class="produc_desc_info">
                                    <div class="product_title">
                                        <h4><a href="{{ route('product_detail', ['slug' => $related->slug]) }}">{{ $related->name }}</a></h4>
                                    </div>
                                    <div class="product_price">
                                        @php
                                        $related_price = $related->price - ($related->price*$related->sale/100);
                                        @endphp
                                        <span class="product__price-current">{{ number_format($related_price,0,',','.')  }} đ</span>
                                        <span class="product__price-old">{{ number_format($related->price,0,',','.')  }} đ</span>
                                        
                                    </div>
                                </div>
                                <div class="product__hover">
                                    <ul>
                                        <form action="">
                                            {{ csrf_field() }}
                                            <input type="hidden" value="{{$related->id}}" class="cart_product_id_{{$related->id}}">
                                            <input type="hidden" value="{{ $related->name }}" id="product_viewed{{ $related->id }}" class="cart_product_name_{{ $related->id }}">
                                            <input type="hidden" value="{{$related->avatar_path}}" class="cart_product_image_{{$related->id}}">
                                            <input type="hidden" value="{{$related_price}}" class="cart_product_price_{{$related->id}}">
                                            <input type="hidden" value="{{$related->quantity}}" class="cart_product_quantity_{{$related->id}}">
                                            <input type="hidden" value="1" class="cart_product_qty_{{ $related->id }}">
                                            <li>
                                                <button type="button" class="home_cart_{{ $related->id }}" id="{{ $related->id }}" onclick="Addtocart(this.id);">
                                                    <i class="ion-android-cart"></i>
                                                </button>
                                            </li>
                                            
                                            <li>
                                                <button style="display:none" class=" rm_home_cart_{{ $related->id }}" id="{{ $related->id }}" onclick="Deletecart(this.id);">
                                                    <i class="ion-android-cart"></i>
                                                </button>
                                            </li>
                                            <li><button type="button" title="Quick View" class=" cart-fore quick_view" data-id_product="{{ $related->id }}" data-toggle="modal" data-target="#my_modal"><i class="ion-android-open"></i></button></li> 
                                            <li><a href="{{ route('product_detail', ['slug' => $related->slug]) }}"><i class="ion-clipboard"></i></a></li>
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
@include('home.components.brand_logo')

@endsection

@section('modal')
@include('home.modal')

@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('#imageGallery').lightSlider({
                gallery:true,
                item:1,
                loop:true,
                thumbItem:9,
                slideMargin:0,
                enableDrag: false,
                currentPagerPosition:'left',
                onSliderLoad: function(el) {
                    el.lightGallery({
                        selector: '#imageGallery .lslide'
                    });
                }   
            });  
        });
  </script>

<script type="text/javascript">
    $(document).ready(function(){
        $('.send-comment').click(function(){
            var product_id = $('.comment_product_id').val();
            var content = $('.content').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
              url:"{{url('/send-comment')}}",
              method:"POST",
              data:{product_id:product_id,content:content, _token:_token},
              success:function(data){
                
                $('#notify_comment').html('<span class="text text-success">Thêm bình luận thành công, bình luận đang chờ duyệt</span>');
                $('#notify_comment').fadeOut(9000);
                $('.content').val('');
              }
            });
        });
        
    });
</script>
<script type="text/javascript">
    function remove_background(product_id)
     {
      for(var count = 1; count <= 5; count++)
      {
       $('#'+product_id+'-'+count).css('color', '#ccc');
      }
    }
    //hover chuột đánh giá sao
   $(document).on('mouseenter', '.rating', function(){
      var index = $(this).data("index");
      var product_id = $(this).data('product_id');

      remove_background(product_id);
      for(var count = 1; count<=index; count++)
      {
       $('#'+product_id+'-'+count).css('color', '#ffcc00');
      }
    });
   //nhả chuột ko đánh giá
   $(document).on('mouseleave', '.rating', function(){
      var index = $(this).data("index");
      var product_id = $(this).data('product_id');
      var rating = $(this).data("rating");
      remove_background(product_id);
      //alert(rating);
      for(var count = 1; count<=rating; count++)
      {
       $('#'+product_id+'-'+count).css('color', '#ffcc00');
      }
     });

    //click đánh giá sao
    $(document).on('click', '.rating', function(){
          var index = $(this).data("index");
          var product_id = $(this).data('product_id');
            var _token = $('input[name="_token"]').val();
          $.ajax({
           url:"{{url('insert-rating')}}",
           method:"POST",
           data:{index:index, product_id:product_id,_token:_token},
           success:function(data)
           {
            if(data == 'done')
            {
             alert("Bạn đã đánh giá "+index +" trên 5");
            }
            else
            {
             alert("Lỗi đánh giá");
            }
           }
    });
          
    });
</script>
@endsection
