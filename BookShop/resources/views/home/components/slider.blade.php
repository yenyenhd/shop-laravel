<div class="slider_area">
    <div class="slider_list  owl-carousel">
        @foreach($sliders as $slider)
        <div class="single_slide" style="background-image: url({{ asset('public'.$slider->image_path) }});">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="slider__content">
                            <p>{{ $slider->name }}</p>
                            <h3>{!! $slider->description !!}</h3>  
                            <div class="slider_btn">
                                <a href="">Shopping now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>