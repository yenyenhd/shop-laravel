<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use App\Models\Rating;
use Carbon\Carbon;
use Session;
session_start();

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $today = Carbon::now('Asia/Ho_Chi_Minh');
		Session::put('today',$today->toDayDateTimeString());

        $categories = Category::where('deleted_at', null)->where('status', 1)->get();
        $sliders = Slider::where('deleted_at', null)->where('status', 1)->get();
        $banner_top = Banner::where('status', 1)->take(3)->get();
        $banner_middle = Banner::latest()->take(2)->get();
        $banner_bottom = Banner::where('status', 0)->take(3)->get();
        $feature_product = Product::where('deleted_at', null)->where('hot', 1)->get();
        $new_product = Product::latest()->take(6)->get();
        $shop_product = Product::all();
        $cate_tabs = Category::where('parent_id',0)->orderBy('id','ASC')->get();

        $best_seller = Product::where('deleted_at', null)->orderBy('sold','DESC')->take(6)->get();

        // SEO
        $meta_desc = 'Chuyên bán về các thể loại sách';
        $meta_keywords = 'Truyện ngôn tình,truyện đam mỹ,tiểu thuyết';
        $meta_title = 'Book Shop';
        $url_canonical = $request->url();

        return view('home.home', compact('categories','sliders', 'banner_top', 'banner_middle', 
        'banner_bottom', 'feature_product', 'new_product', 'shop_product', 'meta_desc', 'meta_keywords', 'meta_title',
        'url_canonical', 'cate_tabs', 'best_seller' ));
    }
    public function search(Request $request){
       

        //seo 
        $meta_desc = "Tìm kiếm sản phẩm"; 
        $meta_keywords = "Tìm kiếm sản phẩm";
        $meta_title = "Tìm kiếm sản phẩm";
        $url_canonical = $request->url();
        //--seo
        $keywords = $request->keywords_submit;

        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get(); 
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get(); 

        $search_product = DB::table('tbl_product')->where('product_name','like','%'.$keywords.'%')->get(); 


        return view('pages.sanpham.search')->with('category',$cate_product)->with('brand',$brand_product)->with('search_product',$search_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider',$slider)->with('category_post',$category_post);

    }

    public function autocomplete_ajax(Request $request){
        $data = $request->all();

        if($data['query']){
            $product = Product::where('status',1)->where('name','LIKE','%'.$data['query'].'%')->get();
            $output = '
            <ul class="dropdown-menu" style="display:block; position:relative">'
            ;

            foreach($product as $key => $val){
             $output .= '
             <li class="li_search_ajax"><a href="#">'.$val->name.'</a></li>
             ';
         }

         $output .= '</ul>';
         echo $output;
     }


    }
    
    public function load_more_product(Request $request){
        $data = $request->all();
        if($data['id']>0){
            $all_product = Product::where('status','1')->where('id','<',$data['id'])->orderby('id','DESC')->take(6)->get(); 
        }else{
            $all_product = Product::where('status','1')->orderby('id','DESC')->take(6)->get(); 
        }

        $output ='';
        if(!$all_product->isEmpty()){
            $output.= '
            <div class="tab-pane active show fade" id="fresh_fruit" role="tabpanel">
                <div class="row">
    
    
            ';
           
            foreach($all_product as $key => $pro){
                $last_id = $pro->id;
                $price_current = $pro->price - ($pro->price*$pro->sale/100);
                $output.='
                <input type="hidden" value="'.$pro->id.'" class="cart_product_id_'.$pro->id.'">

                <input type="hidden" id="wishlist_productname'.$pro->id.'" value="'.$pro->name.'" class="cart_product_name_'.$pro->id.'">

                <input type="hidden" value="'.$pro->quantity.'" class="cart_product_quantity_'.$pro->id.'">

                <input type="hidden" value="'.$pro->avatar_path.'" class="cart_product_image_'.$pro->id.'">

                <input type="hidden" id="wishlist_productprice'.$pro->id.'" value="'.number_format($price_current,0,',','.').'VNĐ">

                <input type="hidden" value="'.$price_current.'" class="cart_product_price_'.$pro->id.'">

                <input type="hidden" value="1" class="cart_product_qty_'.$pro->id.'">

                <a id="wishlist_producturl'.$pro->id.'"  href="'. route('product_detail', ['slug' => $pro->slug]) .'">


                <div class="col-lg-2">
                    <div class="single__product">
                        <div class="single_product__inner">
                            <span class="new_badge">new</span>
                            <div class="sale_off">
                                        <span class="sale__off-percent">- '.$pro->sale.'%</span>
                                    </div>
                            <div class="product_img">
                                <a href="'. route('product_detail', ['slug' => $pro->slug]) .'">
                                    <img src="'.url('public/'.$pro->avatar_path).'" alt="">
                                </a> 
                            </div>
                            <div class="product__content text-center">
                                <div class="produc_desc_info">
                                    <div class="product_title">
                                        <h4><a href="'. route('product_detail', ['slug' => $pro->slug]) .'">'.$pro->name.'</a></h4>
                                    </div>
                                    <div class="product_price">
                                        <span class="product__price-current">'.number_format($price_current,0,',','.') .' đ</span>
                                        <span class="product__price-old">'.number_format($pro->price,0,',','.')  .' đ</span>
                                    </div>
                                </div>

                                <div class="product__hover">
                                    <ul>
                                    <form action="">
                                        '.csrf_field().' 
                                        <li>
                                            <button type="button" class="home_cart_'. $pro->id .'" id="'. $pro->id .'" onclick="Addtocart(this.id);">
                                                <i class="ion-android-cart"></i>
                                            </button>
                                        </li>
                                        <li>
                                            <button style="display:none" type="button" class="rm_home_cart_'. $pro->id .'" id="'. $pro->id .'" onclick="Deletecart(this.id);">
                                                <i class="ion-android-cart"></i>
                                            </button>
                                        </li>
                                        <li><button type="button" title="Quick View" class=" cart-fore quick_view" onclick="XemNhanh(this.id);" id="'.$pro->id.'" data-toggle="modal" data-target="#my_modal"><i class="ion-android-open"></i></button></li> 
                                        <li><a href="'. route('product_detail', ['slug' => $pro->slug]) .'"><i class="ion-clipboard"></i></a></li>
                                    </form>
                                        
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
                
            }

            $output.= '
        </div>
        </div>';
             $output .= '
             
                <div id="load_more" class="mb-15">
                    <button type="button" name="load_more_button" class="btn btn-primary form-control" data-id="'.$last_id.'" id="load_more_button">Load thêm sản phẩm
                    </button>
                </div>
            ';
        }else{
            $output .= '
                <div id="load_more" class="mb-15">
                    <button type="button" name="load_more_button" class="btn btn-default form-control">Dữ liệu đang cập nhật thêm...
                    </button>
                </div>
            ';
        }
        echo $output;
    }

    public function product_tabs(Request $request){

    $data = $request->all();

    $output = '';

    $subcategory = Category::where('parent_id',$data['cate_id'])->get();

    $sub_array = array();
    foreach($subcategory as $key => $sub){
        $sub_array[] = $sub->id;
    }
    array_push($sub_array, $data['cate_id']);

    $product = Product::whereIn('category_id',$sub_array)->where('status','1')->orderBy('view','DESC')->take(6)->get();

    $product_count = $product->count();

    if($product_count>0){

        $output.= '
        <div class="tab-pane active show fade" id="fresh_fruit" role="tabpanel">
            <div class="row">
                


        ';
        foreach($product as $key => $val) {
            $price_current = $val->price - ($val->price*$val->sale/100);
            $output.='

              <input type="hidden" value="'.$val->id.'" class="cart_product_id_'.$val->id.'">

                <input type="hidden" id="wishlist_productname'.$val->id.'" value="'.$val->name.'" class="cart_product_name_'.$val->id.'">

                <input type="hidden" value="'.$val->quantity.'" class="cart_product_quantity_'.$val->id.'">

                <input type="hidden" value="'.$val->avatar_path.'" class="cart_product_image_'.$val->id.'">

                <input type="hidden" id="wishlist_productprice'.$val->id.'" value="'.number_format($val->price,0,',','.').'VNĐ">

                <input type="hidden" value="'.$price_current.'" class="cart_product_price_'.$val->id.'">

                <input type="hidden" value="1" class="cart_product_qty_'.$val->id.'">

                <a id="wishlist_producturl'.$val->id.'"  href="'. route('product_detail', ['slug' => $val->slug]) .'">



            <div class="col-lg-2">
                <div class="single__product">
                    <div class="single_product__inner">
                        <span class="new_badge">new</span>
                        <div class="sale_off">
                                    <span class="sale__off-percent">- '.$val->sale.'%</span>
                                </div>
                        <div class="product_img">
                            <a href="'. route('product_detail', ['slug' => $val->slug]) .'">
                                <img src="'.url('public/'.$val->avatar_path).'" alt="">
                            </a> 
                        </div>
                        <div class="product__content text-center">
                            <div class="produc_desc_info">
                                <div class="product_title">
                                    <h4><a href="'. route('product_detail', ['slug' => $val->slug]) .'">'.$val->name.'</a></h4>
                                </div>
                                <div class="product_price">
                                    <span class="product__price-current">'.number_format($price_current,0,',','.') .' đ</span>
                                    <span class="product__price-old">'.number_format($val->price,0,',','.')  .' đ</span>
                                </div>
                            </div>

                            <div class="product__hover">
                                <ul>
                                <form action="">
                                    '.csrf_field().' 
                                    <li>
                                        <button type="button" class="home_cart_'. $val->id .'" id="'. $val->id .'" onclick="Addtocart(this.id);">
                                            <i class="ion-android-cart"></i>
                                        </button>
                                    </li>
                                    <li>
                                        <button style="display:none" type="button" class="rm_home_cart_'. $val->id .'" id="'. $val->id .'" onclick="Deletecart(this.id);">
                                            <i class="ion-android-cart"></i>
                                        </button>
                                    </li>
                                    <li><button type="button" title="Quick View"class=" cart-fore quick_view" onclick="XemNhanh(this.id);" id="'.$val->id.'" data-toggle="modal" data-target="#my_modal"><i class="ion-android-open"></i></button></li> 
                                    <li><a href="'. route('product_detail', ['slug' => $val->slug]) .'"><i class="ion-clipboard"></i></a></li>
                                </form>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
        }

        $output.= '
        </div>
        </div>
    
 

        
        ';

    }else{
       $output.= ' <div class="tab-content">

       <div class="tab-pane fade active in" id="tshirt" >

       <div class="col-sm-12s">
       <p style="color:red;text-align:center;">Hiện chưa có sản phẩm trong danh mục này</p>
       </div>

       </div>
       </div>

       
       ';
   }


   echo $output;

    }
    public function about(Request $request)
    {
        $meta_desc = 'GIới thiệu về BookShop';
        $meta_keywords = 'Giới thiệu, BookShop, Truyện ngôn tình,truyện đam mỹ,tiểu thuyết';
        $meta_title = 'GIới thiệu về BookShop';
        $url_canonical = $request->url();
        return view('about', compact('meta_desc', 'meta_keywords', 'meta_title', 'url_canonical'));
    }
    
}

