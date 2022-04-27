@extends('layouts.master')

@section('content')
<div class="breadcrumb_container">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">     
                <nav>
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a> ></li>
                        <li>contact</li>
                    </ul>
                </nav>
            </div>
        </div> 
    </div>        
</div>
<div class="contact_area ptb-90">
    <div class="container">
        <div class="row">
            @foreach($contact as $key => $cont)
            <div class="col-lg-8 col-md-7">
                <div class="contact_map_wrapper">
                    <div class="contact_map mb-40">
                        <!-- Contact Map Start -->
                        <div id="contact-map"> {!!$cont->map!!}</div>
                        <!-- Contact Map End -->   
                    </div>
                       
                </div>      
            </div>
            <div class="col-lg-4 col-md-5">
                <div class="contact_info_wrapper">
                    <div class="contact_title">
                        <h4>Thông tin chi tiết</h4>    
                    </div>
                    <div class="mb-15">
                        {!!$cont->contact!!}   
                    </div>
                </div>    
            </div>
            @endforeach    
        </div>    
    </div>   
</div>
@include('home.components.brand_logo')
@endsection