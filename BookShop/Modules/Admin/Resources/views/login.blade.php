
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('public/backend/login/fonts/icomoon/style.css') }}">

    <link rel="stylesheet" href="{{ asset('public/backend/login/css/owl.carousel.min.css') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('public/backend/login/css/bootstrap.min.css') }}">
    
    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('public/backend/login/css/style.css') }}">

    <title>Admin login</title>
</head>
<body>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-6 order-md-2">
                    <img src="{{ asset('public/backend/login/images/undraw_file_sync_ot38.svg') }}" alt="Image" class="img-fluid">
                </div>
                <div class="col-md-6 contents">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            
                            <div class="mb-4">
                                <h3>Sign In</h3>
                            </div>
                        
                            @if(session('message'))
                            <div class="alert alert-danger">
                                {{session('message')}}

                            </div>
                            @endif
                            <form action="{{ route('admin.login') }}" method="post">
                                {{ csrf_field() }}
                                <div class="form-group first">
                                    <label for="username">Username</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                                    @if($errors->has('email'))
                                    <div class="error-text txt-red">
                                        {{$errors->first('email')}}
                                    </div>
                                    @endif
                                </div>
                                <div class="form-group last mb-4">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{ old('password') }}"> 
                                    @if($errors->has('password'))
                                    <div class="error-text txt-red">
                                        {{$errors->first('password')}}
                                    </div>
                                    @endif      
                                </div>
                                <div class="d-flex mb-5 align-items-center">
                                    <label class="control control--checkbox mb-0" ><span class="caption">Remember me</span>
                                    <input type="checkbox" checked="checked" name="remember_me"/>
                                    <div class="control__indicator"></div>
                                    </label>
                                    <span class="ml-auto"><a href="#" class="forgot-pass">Forgot Password</a></span> 
                                </div>
                                <input type="submit" value="Log In" class="btn text-white btn-block btn-primary">
                                <span class="d-block text-left my-4 text-muted"> or sign in with</span>
              
                                <div class="social-login">
                                    <a href="#" class="facebook">
                                    <span class="icon-facebook mr-3"></span> 
                                    </a>
                                    <a href="#" class="twitter">
                                    <span class="icon-twitter mr-3"></span> 
                                    </a>
                                    <a href="#" class="google">
                                    <span class="icon-google mr-3"></span> 
                                    </a>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('public/backend/login/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('public/backend/login/js/popper.min.js') }}"></script>
    <script src="{{ asset('public/backend/login/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/backend/login/js/main.js') }}"></script>
  </body>
</html>