<header class="header sticky-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="header_top_bar top_bar_two">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="header_top_inner">
                                    <div class="phone">
                                        @php
                                            $today = Session::get('today')
                                        @endphp
                                        <p><i class="ion-clock"></i>{{ $today }}</p>
                                    </div>
                                    <div class="header_top_right">
                                        <ul class="header_top_right_inner">
                                            @php
                                                $customer_id = Session::get('customer_id');
                                                
                                            @endphp   
                                            <li class="language_wrapper_two">
                                                @if ($customer_id!=NULL)
                                                <a href="{{ route('checkout') }}"><i class="far fa-credit-card"></i>
                                                    <span>Thanh toán</span>
                                                </a>
                                                @else
                                                <a href="{{ route('login_checkout') }}"><i class="far fa-credit-card"></i>
                                                    <span>Thanh toán</span>
                                                </a>
                                                @endif
                                                
                                            </li>
                                            <li class="language_wrapper_two">
                                                <a href="{{ route('show_cart') }}"><i class="fas fa-shopping-cart"></i>
                                                    <span>Giỏ hàng</span>
                                                </a>
                                            </li>
                                            <li class="language_wrapper_two">
                                                <a href="{{ route('add_customer') }}"><i class="fas fa-sign-out-alt"></i>
                                                    <span>Đăng ký</span>
                                                </a>
                                            </li>
                                            <li class="language_wrapper_two">
                                                <a href="{{ route('login_checkout') }}"><i class="fas fa-sign-in-alt"></i>
                                                    <span>Đăng nhập</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header_wrapper_inner">
                    
                    <div class="logo col-xs-12">
                        <a href="index.php">
                            <img src="{{ asset('public/frontend/img/logo/logo.png') }}" alt="">
                        </a>
                    </div>
                    
                    <div class="main_menu_inner">
                        <div class="menu">
                            <nav>
                                <ul>
                                    <li class="active mega_parent"><a href="{{ route('home') }}">Trang chủ </a></li>
                                    <li><a href="{{ route('about') }}">Giới thiệu </a></li>
                                    <li class="mega_parent"><a href="#">Sản phẩm <i class="fa fa-angle-down"></i></a>
                                        <ul class="mega_menu">
                                            @foreach($categories as $cate)
                                            @if($cate->parent_id == 0)
                                            <li class="mega_item">
                                               <a class="mega_title" href="{{ route('category.slug', ['slug'=>$cate->slug]) }}">{{ $cate->name }}</a>
                                               <ul>
                                                @foreach($cate->categoryChildren as  $cate_sub)
                                                   <li><a href="{{ route('category.slug', ['slug'=>$cate_sub->slug]) }}">{{ $cate_sub->name }}</a></li>
                                                @endforeach 
                                               </ul>
                                            </li> 
                                            @endif
                                            @endforeach
                                            
                                        </ul>    
                                    </li>
                                    <li><a href="{{ route('blog') }}">Tin tức </a></li>
                                    <li><a href="{{ route('contact') }}">Liên hệ </a></li>
            
                                </ul>
                            </nav>
                        </div>
                        
                        <div class="mobile-menu d-lg-none">
                            <nav>
                                <ul>
                                    <li class="active"><a href="{{ route('home') }}">Trang chủ </a></li>
                                    <li><a href="">Giới thiệu</a></li>
                                    <li><a href="shop.html">shop</a>  </li>
                                    <li><a href="blog.html">Blog </a>
                                    </li>
                                    
                                    <li><a href="#">vegetable</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="header_right_info d-flex">
                        <div class="search_box">
                            <div class="search_inner">
                                <form action="{{ route('search') }}" method="POST" autocomplete="off"> 
                                    {{csrf_field()}}
                                    <input type="text" placeholder="Search our catalog" name="keywords_submit" id="keywords">
                                    <div id="search_ajax"></div>
                                    <button type="submit" name="search_items"><i class="ion-ios-search"></i></button>
                                </form>
                            </div>
                        </div>
                        <div class="mini__cart">
                            <div class="mini_cart_inner">
                                <div class="cart_icon">
                                    <a href="#">
                                        <span class="cart_icon_inner show-cart"></span>
                                    </a>
                                </div>
                                <!--Mini Cart Box-->
                                <div class="mini_cart_box cart_box_one hover-cart">
                                    
                                </div>
                                <!--Mini Cart Box End -->
                            </div>
                        </div>
                        <div class="header_account">
                            <div class="account_inner">
                                <a href="#"><i class="ion-gear-b"></i></a>
                            </div>
                            <div class="content-setting-dropdown">
                                    
                                    <div class="user_info_top">
                                        <ul>
                                            <li><a href="my-account.html">Tài khoản</a></li>
                                            <?php 
                                            $customer_id = Session::get('customer_id');
                                        
                                            if($customer_id != NULL){
                                            ?>
                                                <li><a href="{{ route('checkout') }}">Thanh toán</a></li>
                                                <li><a href="{{ route('logout') }}">Đăng xuất</a></li> 
                                            
                                                {{-- // elseif($customer_id != NULL && $shipping_id == NULL){ --}}
                                            
                                                
                                            <?php } else{ ?>
                                                <li><a href="{{ route('login_checkout') }}">Thanh toán</a></li>
                                                <li><a href="{{ route('login_checkout') }}">Đăng nhập</a></li> 
                                            
                                            <?php } ?>
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
</header>
<script type="text/javascript">
    $('#keywords').keyup(function(){
        var query = $(this).val();

          if(query != '')
            {
             var _token = $('input[name="_token"]').val();

             $.ajax({
              url:"{{url('/autocomplete-ajax')}}",
              method:"POST",
              data:{query:query, _token:_token},
              success:function(data){
               $('#search_ajax').fadeIn();  
                $('#search_ajax').html(data);
              }
             });

            }else{
                $('#search_ajax').fadeOut();  
            }
    });

    $(document).on('click', '.li_search_ajax', function(){  
        $('#keywords').val($(this).text());  
        $('#search_ajax').fadeOut();  
    }); 
</script>