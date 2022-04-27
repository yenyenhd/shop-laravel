
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
                <li>Blog Details</li>
            </ul>
        </nav>
            </div>
        </div> 
    </div>        
</div>
 <!--breadcrumb area end-->

<!--blog details area start-->      
<div class="blog_details_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-8">
                <div class="blog_details_left">
                    <div class="blog_left_sidebar mb-50">
                        <h3>Search </h3> 
                        <div class="blog_sidebar_search">
                            <form action="#">
                                <input placeholder="Search..." type="text">
                                <button><i class="icofont icofont-search-alt-2"></i></button>
                            </form>    
                        </div>   
                    </div>
                    <div class="blog_left_sidebar mb-50">
                        <h3>Tin tức xem nhiều</h3> 
                        @foreach ($view as $item)
                        <div class="recent_post mb-30">
                            <div class="recent_post_title">
                                <a href="#"><img src="{{ asset('public/'.$item->image_path) }}" alt=""></a>    
                            </div>
                            <div class="recent_post_content">
                                <h4><a href="#">{{ $item->title }}</a></h4>
                                <span class="post_date">{{ $item->updated_at }}</span>   
                            </div>   
                        </div>
                        @endforeach
                    </div> 
                    <div class="blog_left_sidebar mb-50">
                        <h3>Tin tức liên quan</h3>
                        @foreach ($related as $item)
                        <div class="recent_post mb-30">
                            <div class="recent_post_title">
                                <a href="#"><img src="{{ asset('public/'.$item->image_path) }}" alt=""></a>    
                            </div>
                            <div class="recent_post_content">
                                <h4><a href="#">{{ $item->title }}</a></h4>
                                <span class="post_date">{{ $item->updated_at }}</span>   
                            </div>   
                        </div>
                        @endforeach
                        
                    </div>
                </div>    
            </div>
            <div class="col-lg-9 col-md-12">
                <div class="blog_details_info">
                    <div class="blog_meta">
                        <ul>
                            <li>Sách</li>
                            <li>{{ $post->created_at }}</li>
                        </ul>   
                    </div>
                    
                    <h3>{{ $post->title }} </h3> 
                    <div class="post_excerpt">
                        {!! $post->description !!}
                    </div>
                    <div class="blog_details_img">
                        <img src="{{ asset('public/'.$post->image_path) }}" alt="">    
                    </div>  
                    
                    <div class="post_excerpt">
                        {!! $post->content !!}
                    </div>
                    
                </div>
                   
            </div>    
        </div>    
    </div>    
</div>
@endsection