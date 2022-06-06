
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ $meta_title }}</title>
    <title>Book Shop</title>
    <meta name="description" content="{{ $meta_desc }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="{{ $meta_keywords }}"/>
    <meta name="robots" content="INDEX,FOLLOW"/>
    <link  rel="canonical" href="{{ $url_canonical }}" />
    <meta name="author" content="">
    <meta name="csrf-token" content="{{csrf_token()}}">
     <!------------Share fb------------------>
     {{-- <meta property="og:url"                content="{{$url_canonical}}" />
     <meta property="og:type"               content="articles" />
     <meta property="og:title"              content="{{$meta_title}}" />
     <meta property="og:site_name" content="{{$meta_title}}"/>
     <meta property="og:description"        content="{{$meta_desc}}" />
     <meta property="og:image"              content="{{$share_image}}" /> --}}
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/frontend/img/favicon.png') }}">
    
    <!-- all css here -->
    @yield('css')
    <link rel="stylesheet" href="{{ asset('public/frontend/css/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/chosen.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/material-design-iconic-font.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/meanmenu.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/lightslider.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/lightgallery.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/prettify.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/vlite.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/themify-icons/themify-icons.css') }}">


    <script src="{{ asset('public/frontend/js/vendor/modernizr-2.8.3.min.js') }}"></script>
</head>
<body>
    <div class="organic_food_wrapper">
        @include('partials.header')
        @yield('content') 
        @include('partials.footer')
    </div>
    @yield('modal')
    <!-- all js here -->
    <script src="{{ asset('public/frontend/js/vendor/jquery-1.12.0.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/popper.js') }}"></script>
    <script src="{{ asset('public/frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/jquery.meanmenu.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/ajax-mail.js') }}"></script>
    <script src="{{ asset('public/frontend/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/plugins.js') }}"></script>
    <script src="{{ asset('public/frontend/js/main.js') }}"></script>
    <script src="{{ asset('public/frontend/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/sweetalert.js') }}"></script>
    <script src="{{ asset('public/frontend/js/lightgallery-all.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/lightslider.js') }}"></script>
    <script src="{{ asset('public/frontend/js/prettify.js') }}"></script>
    <script src="{{ asset('public/frontend/js/vlite.js') }}"></script>
    <script src="{{ asset('public/frontend/js/price-range.js') }}"></script>
    <script src="{{ asset('public/frontend/js/money_format.js') }}"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>


    <script src="https://www.google.com/recaptcha/api.js" async defer></script>  

    {{-- <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" 
    src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v11.0" nonce="3P6ZMqsA"></script> --}}
    <div id="fb-root"></div>
{{-- <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v11.0" nonce="15c4iikG"></script> --}}
    
@yield('js')
<script type="text/javascript">
        
    function show_quick_cart(){
         $.ajax({
            url: '{{url('/show_quick_cart')}}',
            method: 'GET',
            success:function(data){
                $('#show_quick_cart').html(data);
                $('#quick-cart').modal();
            }

        });
    }

    function Addtocart($product_id){
        var id = $product_id;
        var cart_product_id = $('.cart_product_id_' + id).val();
        var cart_product_name = $('.cart_product_name_' + id).val();
        var cart_product_image = $('.cart_product_image_' + id).val();
        var cart_product_price = $('.cart_product_price_' + id).val();
        var cart_product_qty = $('.cart_product_qty_' + id).val();
        var cart_product_quantity = $('.cart_product_quantity_' + id).val();
        var _token = $('input[name="_token"]').val();

        if (parseInt(cart_product_qty) > parseInt(cart_product_quantity)) {
            alert('Số lượng hàng không đủ!');
        } else {

            $.ajax({
                url: '{{url('/add-cart-ajax')}}',
                method: 'POST',
                data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,
                cart_product_price:cart_product_price,cart_product_qty:cart_product_qty,_token:_token,cart_product_quantity:cart_product_quantity},

                success:function(){
                    show_quick_cart();
                }

            });
        }
    }
    function Deletecart($session_id){
        var session_id = $session_id;
        var _token = $('input[name="_token"]').val();
        
        $.ajax({
            url: '{{url('/delete-cart-ajax')}}' + '/' +session_id,
            method: 'GET',
            data:{_token:_token, session_id:session_id},
            success:function(){
                
                $('.show_quick_cart_alert').append('<p class="text text-success">Xóa sản phẩm trong giỏ hàng thành công.</p>');
                setTimeout(function() {
                    $('.show_quick_cart_alert').fadeOut(1000);
                    
                }, 1000);
                show_quick_cart();
            }

        });
    }

    $(document).on('input', '.cart_qty_update', function(){

        var quantity = $(this).val();
        var session_id = $(this).data('session_id');
        var _token = $('input[name="_token"]').val();
       
        $.ajax({
            url: '{{url('/update-quick-cart')}}',
            method: 'POST',
            data:{quantity:quantity, session_id:session_id, _token:_token},

            success:function(){
                show_quick_cart();
            }

        });
    })

    
</script>
<script type="text/javascript">
hover_cart();
    show_cart();

    function hover_cart(){
         $.ajax({
                url:'{{url('/hover-cart')}}',
                method:"GET",
                success:function(data){
                    $('.hover-cart').html(data);
                   
                }

            }); 
    }
   
        //show cart quantity
        function show_cart(){
              $.ajax({
                url:'{{url('/show-cart')}}',
                method:"GET",
                success:function(data){
                    $('.show-cart').html(data);
                   
                }

            }); 
        }

    function Deletecart(id){
        var id = id;
        // alert(id);
          $.ajax({
                url:'{{url('/remove-item')}}',
                method:"GET",
                data:{id:id},
                success:function(data){
                    alert('Xóa sản phẩm trong giỏ hàng thành công');

                    document.getElementsByClassName("home_cart_"+id)[0].style.display = "inline";
                    document.getElementsByClassName("rm_home_cart_"+id)[0].style.display = "none";

                    hover_cart();
                    show_cart();
                    cart_session();

                }

            }); 
    }
    $(document).ready(function(){
        $('.add-to-cart').click(function(){
            var id = $(this).data('id_product');
            var cart_product_id = $('.cart_product_id_' + id).val();
            var cart_product_name = $('.cart_product_name_' + id).val();
            var cart_product_image = $('.cart_product_image_' + id).val();
            var cart_product_price = $('.cart_product_price_' + id).val();
            var cart_product_qty = $('.cart_product_qty_' + id).val();
            var cart_product_quantity = $('.cart_product_quantity_' + id).val();
            var _token = $('input[name="_token"]').val();
            if (parseInt(cart_product_qty) > parseInt(cart_product_quantity)) {
                alert('Số lượng hàng không đủ!');
            } else {
                $.ajax({
                url: '{{url('/add-cart-ajax')}}',
                method: 'POST',
                data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,
                    cart_product_image:cart_product_image,cart_product_price:cart_product_price,
                    cart_product_qty:cart_product_qty,_token:_token, cart_product_quantity:cart_product_quantity},
                success:function(){

                    swal({
                        title: "Đã thêm sản phẩm vào giỏ hàng",
                        text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
                        showCancelButton: true,
                        cancelButtonText: "Xem tiếp",
                        confirmButtonClass: "btn-success",
                        confirmButtonText: "Đi đến giỏ hàng",
                        closeOnConfirm: false
                    },
                    function() {
                        window.location.href = "{{url('/cart')}}";
                    });  
                }

            });
            }
        });

    });
</script>


<script type="text/javascript">
    
    $('.quick_view').click(function(){
        var product_id = $(this).data('id_product');
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url:"{{url('/quickview')}}",
            method:"POST",
            dataType:"JSON",
            data:{product_id:product_id, _token:_token},
            success:function(data){
                
                $('#product_quickview_title').html(data.name);
                $('#product_quickview_id').html(data.id);
                $('#product_quickview_price').html(data.price);
                $('#product_price_current').html(data.price_current);
                $('#product_quickview_image').html(data.avatar_path);
                $('#product_quickview_gallery').html(data.product_gallery);
                $('#product_quickview_desc').html(data.description);
                $('#product_quickview_content').html(data.content);
                $('#product_quickview_value').html(data.product_quickview_value);
                $('#product_quickview_button').html(data.product_button);

               
            }
        });
    });
</script>

   <!--add to  cart quickview-->
   <script type="text/javascript">
       
    $(document).on('click','.add-to-cart-quickview',function(){

        var id = $(this).data('id_product');
        var cart_product_id = $('.cart_product_id_' + id).val();
        var cart_product_name = $('.cart_product_name_' + id).val();
        var cart_product_image = $('.cart_product_image_' + id).val();
        var cart_product_price = $('.cart_product_price_' + id).val();
        var cart_product_qty = $('.cart_product_qty_' + id).val();
        var cart_product_quantity = $('.cart_product_quantity_' + id).val();
        var _token = $('input[name="_token"]').val();

        if (parseInt(cart_product_qty) > parseInt(cart_product_quantity)) {
            alert('Số lượng hàng không đủ!');
        } else {
            $.ajax({
                url: '{{url('/add-cart-ajax')}}',
                method: 'POST',
                data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,
                    cart_product_image:cart_product_image,cart_product_price:cart_product_price,
                    cart_product_qty:cart_product_qty,_token:_token, cart_product_quantity:cart_product_quantity},
                beforeSend: function(){
                    $("#beforesend_quickview").html("<div class='alert alert-warning'>Đang thêm sản phẩm vào giỏ hàng</div>");
                },
                success:function(){
                    $("#beforesend_quickview").html("<div class='alert alert-success'>Sản phẩm đã thêm vào giỏ hàng</div>");  
                }

            });
            
        }
    });
    $(document).on('click','.redirect-cart',function(){
        window.location.href = "{{url('/cart')}}";
    });

</script>
<script type="text/javascript">

    function XemNhanh(id){
        var product_id = id;
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url:"{{url('/quickview')}}",
            method:"POST",
            dataType:"JSON",
            data:{product_id:product_id, _token:_token},
            success:function(data){
                
                $('#product_quickview_title').html(data.name);
                $('#product_quickview_id').html(data.id);
                $('#product_quickview_price').html(data.price);
                $('#product_price_current').html(data.price_current);
                $('#product_quickview_image').html(data.avatar_path);
                $('#product_quickview_gallery').html(data.product_gallery);
                $('#product_quickview_desc').html(data.description);
                $('#product_quickview_content').html(data.content);
                $('#product_quickview_value').html(data.product_quickview_value);
                $('#product_quickview_button').html(data.product_button);

               
            }
        });
    }

</script>
<script type="text/javascript">
    $(document).ready(function(){

        $('#category_order').sortable({
            placeholder: 'ui-state-highlight',
             update  : function(event, ui)
              {
                var page_id_array = new Array();
                var _token = $('input[name="_token"]').val();

                $('#category_order tr').each(function(){
                    page_id_array.push($(this).attr("id"));
                });
                
                $.ajax({
                        url:"{{url('/admin/categories/arrange-category')}}",
                        method:"POST",
                        data:{page_id_array:page_id_array,_token:_token},
                        success:function(data)
                        {
                            alert(data);
                        }
                });

              }
        });
       

    });
</script>
<script type="text/javascript">
    $(document).ready(function(){

            var cate_id = $('.tabs_pro').data('id');
            var _token = $('input[name="_token"]').val();
            //alert(cate_id);
            $.ajax({
                url:'{{url('/product-tabs')}}',
                method:"POST",
                data:{cate_id:cate_id,_token:_token},
                success:function(data){
                    $('#tabs_product').html(data);

                }

            });

        $('.tabs_pro').click(function(){
            var cate_id = $(this).data('id');
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:'{{url('/product-tabs')}}',
                method:"POST",
                data:{cate_id:cate_id,_token:_token},

                success:function(data){
        
                    $('#tabs_product').html(data);
                    var id = [];

                    $(".cart_id").each(function() {
                        id.push($(this).val());
                        //alert(id);
                    });
                    for(var i = 0; i<id.length; i++){
                        $('.home_cart_'+id[i]).hide();
                        $('.rm_home_cart_'+id[i]).show();
                    }
                   
                }

            });
        });
    })



   
</script>
<script type="text/javascript">
    load_more_product();
    cart_session();
    function cart_session(){
         $.ajax({
                url:'{{url('/cart-session')}}',
                method:"GET",
                success:function(data){
                    $('#cart_session').html(data);
                }

            }); 
    }
    htmlLoaded();
    
    function htmlLoaded() {

    $(window).load(function() {
          
           var id = [];

            $(".cart_id").each(function() {
                id.push($(this).val());
                //alert(id);
               
            });
           
            for(var i = 0; i<id.length; i++){

                $('.home_cart_'+id[i]).hide();
                $('.rm_home_cart_'+id[i]).show();
                
            }

        });
    }

    function load_more_product(id = ''){
        $.ajax({
            url:'{{url('/load-more-product')}}',
            method:"POST",

            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            data:{id:id},
            success:function(data){
                $('#load_more_button').remove();

                $('#all_product').append(data);
                
                var id = [];

                $(".cart_id").each(function() {
                    id.push($(this).val());
                    //alert(id);
                   
                });
               
                for(var i = 0; i<id.length; i++){

                    $('.home_cart_'+id[i]).hide();
                    $('.rm_home_cart_'+id[i]).show();
                    
                }
              
                
            }

        }); 
    }
    $(document).on('click','#load_more_button',function(){
        var id = $(this).data('id');
        $('#load_more_button').html('<b>Loading...</b>');
        load_more_product(id);
       
          
    })

</script>

</body>

</html>
