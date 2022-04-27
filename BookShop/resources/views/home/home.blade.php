@extends('layouts.master')
@section('content')
     
    @include('home.components.slider')
    
    @include('home.components.banner_top')

    @include('home.components.features_product')
    
    @include('home.components.shipping')
    
    @include('home.components.shop_product')
    
    @include('home.components.banner_middle')

    @include('home.components.recomended_product')

    @include('home.components.new_product')

    @include('home.components.banner_bottom')
    
    @include('home.components.best_seller')
  
    @include('home.components.brand_logo')
    {{-- <div class="fb-share-button" data-href="http://localhost/BookShop/" data-layout="button" data-size="small">
        <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ $url_canonical }}&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">
            Chia sẻ
        </a>
    </div> --}}
    <div class="fb-like" data-href="http://localhost/BookShop/" data-width="" data-layout="button" data-action="like" data-size="small" data-share="false"></div>

@endsection

@section('modal')
@include('home.modal')

@endsection

