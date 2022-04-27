@extends('layouts.master')

@section('content')
<div class="breadcrumb_container">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">     
                <nav>
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a> ></li>
                        <li>login</li>
                    </ul>
                </nav>
            </div>
        </div> 
    </div>        
</div>
<div class="page_login_section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-sm-10 offset-sm-1">
                @if(session('message'))
                    <div class="alert alert-danger">
                        {{session('message')}}
                    </div>
                @endif
                <div class="login_page_form">
                    <form action="{{ route('customer.login') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-12">
                                <div class="input_text">
                                    <label for="name">Email <span>*</span></label>
                                    <input id="name" type="email" name="email">    
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="input_text">
                                    <label for="password">Passwords <span>*</span></label>
                                    <input id="password" type="password" name="password"> 
                                </div>   
                            </div>
                            <div class="col-12">
                                <label class="inline" for="rememberme">
                                    <input id="rememberme" type="checkbox">
                                    Remember me	
                                </label> 
                            </div>
                            <div class="col-12">
                                <div class="login_submit">
                                    <input class="inline" value="Login" name="Login" type="submit">
                                </div> 
                            </div> 
                            <div class="col-12 mt-20">
                                <p class="font-italic text-center">Don't have account? <a href="{{ route('add_customer') }}" ><span class="font-weight-bold">Register here!</span></a></p>
                            </div>  
                        </div>
                    </form>    
                </div>    
            </div>    
        </div>    
    </div>  
</div>
 
@endsection