<footer class="footer pt-90">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-12 col-xs-12">
                <!--Single Footer-->
                @foreach($app_contact as $key => $cont)
                <div class="single_footer widget">
                    <div class="single_footer_widget_inner">
                        <div class="footer_logo">
                            <a href="#"><img src="{{ asset('public/'.$cont->logo) }}" ></a>
                            <p>{!!$cont->slogan!!}</p>
                        </div>
                        <div class="footer_content">
                            {!!$cont->contact!!}
                        </div>
                        <div class="footer_social">
                            <h4>Get in Touch:</h4>
                            <div class="footer_social_icon">
                                <a href="#"><i class="ti-twitter-alt"></i></a>
                                <a href="#"><i class="ti-google"></i></a>
                                <a href="#"><i class="ti-facebook"></i></a>
                                <a href="#"><i class="ti-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <!--Single Footer-->
            </div>
            <div class="col-lg-9 col-md-12 col-xs-12">
                <div class="footer_menu_list d-flex justify-content-between">
                    
                    <div class="single_footer widget">
                        <div class="single_footer_widget_inner">   
                            <div class="footer_title">
                                <h2>DỊCH VỤ</h2>
                            </div>
                            <div class="footer_menu">
                                <ul>
                                    <li><a href="#">Điều khoản sử dụng</a></li>
                                    <li><a href="#"> Chính sách bảo mật</a></li>
                                    <li><a href="#"> Hệ thống trung tâm - nhà sách</a></li>
                                    <li><a href="#"> Giới thiệu BookShop</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="single_footer widget">
                        <div class="single_footer_widget_inner">   
                            <div class="footer_title">
                                <h2>HỖ TRỢ</h2>
                            </div>
                            <div class="footer_menu">
                                <ul>
                                    <li><a href="#">Chính sách đổi - trả - hoàn tiền</a></li>
                                    <li><a href="#"> Chính sách khách sỉ</a></li>
                                    <li><a href="#"> Phương thức vận chuyển</a></li>
                                    <li><a href="#"> Phương thức thanh toán và xuất HĐ</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="single_footer widget">
                        <div class="single_footer_widget_inner">   
                            <div class="footer_title">
                                <h2>TÀI KHOẢN CỦA TÔI</h2>
                            </div>
                            <div class="footer_menu">
                                <ul>
                                    <li><a href="#">Đăng nhập/Tạo mới tài khoản</a></li>
                                    <li><a href="#"> Thay đổi địa chỉ khách hàng</a></li>
                                    <li><a href="#"> Chi tiết tài khoản</a></li>
                                    <li><a href="#"> Lịch sử mua hàng</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
            
                    
                </div>
            </div>
           
        </div>
    </div>
    
    <div class="copyright">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-xs-12">
                    <div class="copyright_text">
                        <p>Copyright 2018 <a href="#">Organicfood</a>. All Rights Reserved</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-xs-12">
                    <div class="footer_mastercard text-right">
                        <a href="#"><img src="{{ asset('public/frontend/') }}/img/brand/payment.png" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</footer>