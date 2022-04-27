@extends('layouts.master')

@section('content')
<div class="breadcrumb_container">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">     
                <nav>
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a> ></li>
                        <li>About Us</li>
                    </ul>
                </nav>
            </div>
        </div> 
    </div>        
</div>
<div class="about_section">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1 col-md-12 text-center">
                <div class="about_section_one">
                    <h2>Chào mừng bạn đến với BookShop</h2>
                    <p>BookShop chuyên kinh doanh: sách quốc văn, ngoại văn. Sách quốc văn với nhiều thể loại đa dạng như sách giáo khoa – tham khảo, giáo trình, sách học ngữ, từ điển, sách tham khảo thuộc nhiều chuyên ngành phong phú: văn học, tâm lý – giáo dục, khoa học kỹ thuật, khoa học kinh tế - xã hội, khoa học thường thức, sách phong thủy, nghệ thuật sống, danh ngôn, sách thiếu nhi, truyện tranh, truyện đọc, từ điển, công nghệ thông tin.
                    ...của nhiều Nhà xuất bản, nhà cung cấp sách có uy tín như: NXB Trẻ, Giáo Dục, Kim Đồng, Văn hóa -Văn Nghệ, Nhã Nam, Alphabook, Thái Hà. Sách ngoại văn bao gồm: từ điển, giáo trình, tham khảo, truyện tranh thiếu nhi , sách học ngữ, từ vựng, ngữ pháp, luyện thi TOEFL, TOEIC, IELS…được nhập từ các NXB nước ngoài như: Cambridge, Mc Graw-Hill, Pearson Education, Oxford, Macmillan, Cengage Learning… </p>    
                </div>
                <div class="about__store__btn">
                    <a href="#">contact us</a>    
                </div>    
            </div>    
        </div>    
    </div>    
</div>
<div class="about_section">
    <div class="container ">
        <div class="row ">
            <div class="col-xl-12 col-lg-12 col-md-12 text-center">
                <div class="about_choose_content">
                    <h3>Lý do bạn nên chọn chúng tôi?</h3>
                    <div class="choose_content_inner">
                        <div class="single_choose_us">
                            <div class="choose_us mb-50">
                                <div class="choose_icone">
                                   <i class="zmdi zmdi-favorite-outline"></i>
                                </div>
                                <div class="choose_details">
                                    <h4>Quà tặng miễn phí</h4>
                                    <p>Áp dụng cho khách hàng thành viên </p>    
                                </div>
                            </div>
                             <div class="choose_us">
                                <div class="choose_icone">
                                   <i class="zmdi zmdi-truck"></i>
                                </div>
                                <div class="choose_details">
                                    <h4>Miễn phí vận chuyển</h4>
                                    <p>Đối với đơn hàng từ 199.000đ </p>    
                                </div>
                            </div>    
                        </div>
                        <div class="single_choose_us">
                            <div class="choose_us  mb-50">
                                <div class="choose_icone">
                                  <i class="zmdi zmdi-refresh-alt"></i>
                                </div>
                                <div class="choose_details">
                                    <h4>Hoàn tiền</h4>
                                    <p>Trong vòng 7 ngày </p>    
                                </div>
                            </div>
                            <div class="choose_us">
                                <div class="choose_icone"><i class="zmdi zmdi-time"></i>  </div>
                                <div class="choose_details">
                                    <h4>Hỗ trợ 24/7</h4>
                                    <p>Hỗ trợ trực tuyến 24 giờ một ngày. </p>    
                                </div>
                            </div>    
                        </div>
                    </div>       
                </div>    
            </div>   
        </div>
             
    </div>    
    
 </div>
<!-- about area end -->
    
    
<!--about team area start--> 
<div class="about_team_area ptb-90">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="about_section_title">
                    <h2>Nhân lực</h2>
                    <p>BookShop có hơn 2.200 CB-CNV, trình độ chuyên môn giỏi, nhiệt tình, năng động, chuyên nghiệp. Lực lượng quản lý BookShop có thâm niên công tác, giỏi nghiệp vụ nhiều kinh nghiệm, có khả năng quản lý tốt và điều hành đơn vị hoạt động hiệu quả.</p>  
                </div>    
            </div>    
        </div>
        <div class="row no-gutters">
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="single_team">
                    <div class="team__imge">
                        <a href="#"><img src="{{ asset('public/frontend/img/intro/staff1.jpg') }}" alt=""></a>    
                    </div>
                    <div class="team_hover_inpo">
                        <div class="team_hover_action">
                            <h2><a href="#">Karry Wang</a></h2> 
                            <ul>
                                <li><a href="#"><i class="zmdi zmdi-twitter"></i></a></li>
                                <li><a href="#"><i class="zmdi zmdi-instagram"></i></a></li>
                                <li><a href="#"><i class="zmdi zmdi-facebook"></i></a></li>
                                <li><a href="#"><i class="zmdi zmdi-google-plus"></i></a></li>
                            </ul>   
                        </div>    
                    </div>    
                </div>    
            </div>
              <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="single_team">
                    <div class="team__imge">
                        <a href="#"><img src="{{ asset('public/frontend/img/intro/staff2.jpg') }}" alt=""></a>    
                    </div>
                    <div class="team_hover_inpo">
                        <div class="team_hover_action">
                            <h2><a href="#">Tiêu Chiến</a></h2> 
                            <ul>
                                <li><a href="#"><i class="zmdi zmdi-twitter"></i></a></li>
                                <li><a href="#"><i class="zmdi zmdi-instagram"></i></a></li>
                                <li><a href="#"><i class="zmdi zmdi-facebook"></i></a></li>
                                <li><a href="#"><i class="zmdi zmdi-google-plus"></i></a></li>
                            </ul>   
                        </div>    
                    </div>    
                </div>    
            </div> 
              <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="single_team team__three">
                    <div class="team__imge">
                        <a href="#"><img src="{{ asset('public/frontend/img/intro/staff3.jpg') }}" alt=""></a>    
                    </div>
                    <div class="team_hover_inpo">
                        <div class="team_hover_action">
                            <h2><a href="#">Vương Nhất Bác</a></h2> 
                            <ul>
                                <li><a href="#"><i class="zmdi zmdi-twitter"></i></a></li>
                                <li><a href="#"><i class="zmdi zmdi-instagram"></i></a></li>
                                <li><a href="#"><i class="zmdi zmdi-facebook"></i></a></li>
                                <li><a href="#"><i class="zmdi zmdi-google-plus"></i></a></li>
                            </ul>   
                        </div>    
                    </div>    
                </div>    
            </div>     
        </div>   
    </div>    
</div>
<!--about team area end--> 
    

<!--testimonial area start--> 
<div class="about_testimonial_area mb-65" style="background-image:url('public/frontend/img/banner/banner4.png')">
   <div class="about_testimonial_inner">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 offset-xl-2 col-lg-12 col-md-12">
                    <div class="testimonial___wrapper owl-carousel">
                        <div class="single___testimonial text-center">
                            <div class="testimonial__image ">
                                <img src="assets/img/banner/testi1.png" alt="">    
                            </div>
                            <div class="testimonial__details">
                                <p>Từ 2015 đến nay, BookShop đã nhất quán và thực hiện thành công chiến lược xuyên suốt là xây dựng, phát triển Hệ thống Nhà sách chuyên nghiệp trên toàn quốc.

                                    Tiếp tục định hướng hoạt động chuyên ngành và thực hiện chiến lược phát triển mạng lưới, từ năm 2016 – 2021 BookShop sẽ phát triển mạnh hệ thống Nhà sách tại các tỉnh thành phía Bắc.
                                    
                                    Dự kiến 2022, Hệ thống BookShop sẽ có khoảng 100 Nhà sách trên toàn quốc. Tiếp tục giữ vững vị thế là hệ thống Nhà sách hàng đầu Việt Nam và nằm trong Top 10 nhà bán lẻ hàng đầu Việt Nam (tính cho tất cả các ngành hàng).</p>    
                            </div>
                            <div class="testimonial__info">
                                <a href="#">Karry Wang</a>
                                <span>-</span>    
                                <span>CEO</span>    
                            </div>    
                        </div>
                        
                    </div>    
                </div>    
            </div>    
        </div> 
    </div> 
</div> 

@include('home.components.brand_logo')
@endsection