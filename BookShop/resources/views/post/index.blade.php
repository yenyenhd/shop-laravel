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
                <li>Blog</li>
            </ul>
        </nav>
            </div>
        </div> 
    </div>        
</div>
 <!--breadcrumb area end-->

<!--blog area start-->
<div class="blog_list_area">
    <div class="container">
        <div class="row">
            @foreach ($posts as $post)
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="single_blog_list">
                    <div class="blog__thumb">
                        <a href="{{ route('blog.detail', ['slug' =>$post->slug]) }}"><img src="{{ asset('public/'.$post->image_path) }}" alt="" height="250px"></a>    
                    </div>
                    <div class="post__content">
                        <h3><a href="{{ route('blog.detail', ['slug' =>$post->slug]) }}">{{ $post->title }}</a></h3>
                        <p>{!! $post->description !!}</p>
                        <ul>
                            <li><a href="{{ route('blog.detail', ['slug' =>$post->slug]) }}">Xem chi tiết</a></li>
                            <li class="post_date">{{ $post->created_at }}</li>
                        </ul>    
                    </div>
                </div>    
            </div>
            
            @endforeach
            <div class="col-md-12">
                {{ $posts->links("pagination::bootstrap-4") }}
            </div>                
        </div>    
    </div>   
</div>
@endsection


