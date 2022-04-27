@extends('layouts.master')

@section('content')
<div class="breadcrumb_container ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">     
                <nav>
            <ul>
                <li>
                    <a href="{{ route('home') }}">Home ></a>
                </li>
                <li>Register</li>
            </ul>
        </nav>
            </div>
        </div> 
    </div>        
</div>
 <!--breadcrumb area end-->

<!--login section start-->
<div class="page_login_section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="register_page_form">
                    <form action="{{ route('customer.store') }}" method="POST"  enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-6 col-sm-6 col-md-6">
                                <div class="input_text">
                                    <label for="R_N">Họ tên <span>*</span></label>
                                    <input id="R_N" type="text" name="name" class="@error('name') is-invalid @enderror" value="{{ old('name') }}"> 
                                    @if($errors->has('name'))
                                        <div class="error-text">
                                            {{$errors->first('name')}}
                                        </div>
                                    @endif
                                </div>   
                            </div>
                            <div class="col-lg-6 col-sm-6 col-md-6">
                                <div class="input_text">
                                    <label for="R_N">Tên đăng nhập <span>*</span></label>
                                    <input id="R_N" type="text" name="username" class="@error('username') is-invalid @enderror" value="{{ old('username') }}"> 
                                    @if($errors->has('username'))
                                        <div class="error-text">
                                            {{$errors->first('username')}}
                                        </div>
                                    @endif
                                </div>   
                            </div>
                            <div class="col-lg-6 col-sm-6 col-md-6">
                                <div class="input_text">
                                    <label for="R_N5">Phone<span>*</span></label>
                                    <input id="R_N5" type="text" name="phone" class="@error('phone') is-invalid @enderror" value="{{ old('phone') }}"> 
                                    @if($errors->has('phone'))
                                        <div class="error-text">
                                            {{$errors->first('phone')}}
                                        </div>
                                    @endif 
                                </div>  
                            </div>
                            <div class="col-12">
                                <div class="input_text">
                                    <label for="R_N4">Email <span>*</span></label>
                                    <input id="R_N4" type="email" name="email" class="@error('email') is-invalid @enderror" value="{{ old('email') }}">
                                    @if($errors->has('email'))
                                        <div class="error-text">
                                            {{$errors->first('email')}}
                                        </div>
                                    @endif
                                </div>   
                            </div>
                            
                            <div class="col-12">
                                <div class="input_text">
                                    <label for="R_N11">Password<span>*</span></label>
                                    <input id="R_N11" type="password" name="password" class="@error('password') is-invalid @enderror" value="{{ old('password') }}"> 
                                    @if($errors->has('password'))
                                        <div class="error-text">
                                            {{$errors->first('password')}}
                                        </div>
                                    @endif   
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="input_text">
                                    <label for="R_N12">Confirm password<span>*</span></label>
                                    <input id="R_N12" type="password" name="passwordAgain" class="@error('passwordAgain') is-invalid @enderror" value="{{ old('passwordAgain') }}"> 
                                    @if($errors->has('passwordAgain'))
                                        <div class="error-text">
                                            {{$errors->first('passwordAgain')}}
                                        </div>
                                    @endif
                                </div>   
                            </div>
                            <div class="col-12">
                                <div class="g-recaptcha" data-sitekey="{{env('CAPTCHA_KEY')}}"></div>
                                <br/>
                                @if($errors->has('g-recaptcha-response'))
                                    <span class="invalid-feedback" style="display:block">
                                        <strong>{{$errors->first('g-recaptcha-response')}}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-12">
                                <div class="login_submit">
                                    <button type="submit">Register</button>
                                </div>
                            </div>    
                            <div class="col-12 mt-20">
                                <p class="font-italic text-center">Have already an account? <a href="{{ route('login_checkout') }}" ><span class="font-weight-bold">Login here!</span></a></p>
                            </div> 
                            

                        </div>
                    </form>    
                </div>    
            </div>    
        </div>    
    </div>  
</div>
@endsection
@section('js')
    <script>
        $(document).ready(function(){
            $('.choose').on('change', function(){
                var action = $(this).attr('id');
                var ma_id = $(this).val();
                var _token = $('input[name="_token"]').val();
                var result = '';
                
                if(action=='province'){
                    result = 'district';
                    
                }else{
                    result = 'commune';
                } 
                $.ajax({
                    url : '{{url('/admin/delivery/select')}}',
                    method: 'POST',
                    data:{action:action,ma_id:ma_id,_token:_token},
                    success:function(data){
                        $('#'+result).html(data);     
                    }
                });
            });
        });
    </script>
@endsection