<div class="banner_area banner_area-2 pb-90">
    <div class="container-fluid">
        <div class="row">
            @foreach($banner_bottom as $banner)
            <div class="col-lg-4 col-md-6">
                <div class="single_banner">
                    <a href="#">
                        <img src="{{ asset('public'.$banner->image_path) }}" alt="" height="142px">
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>