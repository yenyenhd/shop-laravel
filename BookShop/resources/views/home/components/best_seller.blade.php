<div class="best_seller_product">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="section_title space_2 text-left">
                    <h3> Bestseller Products </h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="best_selling_product_list owl-carousel">
                    @foreach($best_seller as $best)
                    <div class="best_selling_product">
                        <div class="single_small_product mb-30">
                            <div class="product_thumb">
                                <a href="#">
                                    <img src="{{ asset('public'.$best->avatar_path) }}" alt="">
                                </a>
                            </div>
                            <div class="product_content">
                                <h4><a href="{{ route('product_detail', ['slug' => $best->slug]) }}">{{ $best->name }}</a></h4>
                                <div class="product_price">
                                    @php
                                    $price_current = $best->price - ($best->price*$best->sale/100);
                                    @endphp
                                    <span class="regular_price">{{ number_format($price_current,0,',','.')  }} đ</span>
                                    <span class="old_price">{{ number_format($best->price,0,',','.')  }} </span>
                                </div>
                            </div>
                            
                        </div>
                         
                    </div> 
                    @endforeach
                   
                        
                </div>
                
                
            </div>
        </div>
    </div>
</div>