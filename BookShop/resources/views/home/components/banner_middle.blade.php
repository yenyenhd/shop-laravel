<div class="banner_area home1_banner2 pb-90">
    <div class="container-fluid">
        <div class="row">
            @foreach($banner_middle as $banner)
            @if($banner->status == 1)
            <div class="col-lg-6">
                <div class="single_banner">
                    <a href="#">
                        <img src="{{ asset('public'.$banner->image_path) }}" alt="" height="180px">
                    </a>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</div>