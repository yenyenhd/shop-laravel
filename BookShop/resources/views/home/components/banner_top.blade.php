<div class="banner_area home1_banner mt-30">
    <div class="container-fluid">
        <div class="row">
            @foreach($banner_top as $banner)
            <div class="col-lg-4 col-md-6">
                <div class="single_banner">
                    <a href="#">
                        <img src="{{ asset('public'.$banner->image_path) }}" alt="" height="200px">
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>