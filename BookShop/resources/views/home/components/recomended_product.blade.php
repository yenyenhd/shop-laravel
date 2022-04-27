<div class="recommended_product">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="shop_product_head d-flex justify-content-between mb-30">
                    <div class="section_title space_2 text-left">
                        <h3>Recommended Products</h3>
                    </div>
                    <div class="home_shop_product text-right">
                        <ul class="product-tab-list nav d-flex flex-wrap justify-content-end" role="tablist">
                            @php
                            $i = 0;
                            @endphp
                            @foreach($cate_tabs as $key => $cat_tab)
                            @php
                            $i++;
                            @endphp
                            <li class="tabs_pro {{$i==1 ? 'active' : ''}}" data-id="{{$cat_tab->id}}"><a href="#fresh" data-toggle="tab" role="tab" aria-selected="true" aria-controls="fresh">
                                {{$cat_tab->name}}
                            </a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-content" id="tabs_product"></div>
        <div id="cart_session"></div>
     
    </div>
</div>
