<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Tag;
use App\Models\ProductTag;
use App\Models\ProductImage;
use App\Models\Comment;
use App\Models\Rating;
use App\Models\Coupon;
use App\Models\Banner;
use Illuminate\Support\Str;

use Cart;

use Session;
session_start();

class ProductController extends Controller
{
    public function product_detail($slug, Request $request)
    {
        $categories = Category::all();
        $product = Product::where('slug', $slug)->first();
        $product->view = $product->view + 1;
        $product->save();
        $category_id = $product->category_id;
        $id = $product->id;
        $cate_products = Category::all();

        $comment = Comment::where('product_id',$id)->where('status', 1)->where('parent_id', 0)->get();
        $length = count($comment);
        $comment_rep = Comment::where('parent_id','>',0)->get();
        $rating = Rating::where('product_id', $id)->avg('rating');
        $rating = round($rating);

        $related_product = Product::where('category_id', $category_id)->whereNotIn('slug', [$slug])->get();

        // SEO
        $meta_desc = $product->description;
        $meta_keywords = $product->keyword;
        $meta_title = $product->name;
        $url_canonical = $request->url();
        
        return view('product.product_detail', compact('product','related_product', 'cate_products', 'meta_desc', 'meta_keywords',
        'meta_title', 'url_canonical', 'categories', 'comment', 'length','comment_rep', 'rating'));

    }
 public function tag(Request $request, $product_tag)
    {
        $categories = Category::all();
        $tag = Tag::where('name', $product_tag)->first();
        $pro_tag = ProductTag::where('tag_id', $tag->id)->get();

         // SEO
         $meta_desc = 'Đa dạng các thể loại sách';
         $meta_keywords = $tag->name;
         $meta_title = $tag->name;
         $url_canonical = $request->url();

        return view('product.tag', compact('categories', 'pro_tag', 'product_tag', 'meta_desc', 'meta_keywords', 'meta_title', 
        'url_canonical'));
    }

    public function quickview(Request $request){

        $product_id = $request->product_id;
        $product = Product::find($product_id);
        $price_current = $product->price - ($product->price*$product->sale/100);

        $gallery = ProductImage::where('product_id',$product_id)->get();

        $output['product_gallery'] = '';
        
        foreach($gallery as $key => $gal){
            $output['product_gallery'].= '<li ><a class="nav-link active" data-toggle="tab" href="#imgeone" role="tab" aria-controls="imgeone" aria-selected="false">
                    <p><img width="100%" src="public'.$gal->image_path.'"></p>
                </a>
                </li>
            ';
        }

        $output['name'] = $product->name;
        $output['id'] = $product->id;
        $output['description'] = $product->description;
        $output['content'] = $product->content;
        $output['price'] = number_format($product->price,0,',','.').'VNĐ';
        $output['price_current'] = number_format($price_current,0,',','.').'VNĐ';
        $output['avatar_path'] = '<p><img width="100%" src="public'.$product->avatar_path.'"></p>';
        $output['product_button'] = '
        <button type="button" data-id_product="'.$product->id.'" class="add-to-cart-quickview" id="buy_quickview" name="add-to-cart"> Add to cart</button>';
        

        $output['product_quickview_value'] = '
        <input type="hidden" value="'.$product->id.'" class="cart_product_id_'.$product->id.'">
        <input type="hidden" value="'.$product->name.'" class="cart_product_name_'.$product->id.'">
        <input type="hidden" value="'.$product->avatar_path.'" class="cart_product_image_'.$product->id.'">
        <input type="hidden" value="'.$product->price.'" class="cart_product_price_'.$product->id.'">
        <input type="hidden" value="'.$product->quantity.'" class="cart_product_quantity_'.$product->id.'">

        <input type="hidden" name="productid_hidden" value="'.$product->id .'">';
        // <input type="hidden" value="1" class="cart_product_qty_'.$product->id.'">';

        echo json_encode($output);
       

    }

    public function show_category_home(Request $request ,$slug)
    {
        $banner = Banner::where('status', 1)->where('deleted_at', null)->latest()->first();
        $categories = Category::where('deleted_at', null)->where('status', 1)->get();

        $category_by_slug = Category::where('slug',$slug)->get();

        $min_price = Product::min('price');
        $max_price = Product::max('price');

        $min_price_range = $min_price - 20000;
        $max_price_range = $max_price + 100000;

        foreach($category_by_slug as $key => $cate){
            $category_id = $cate->id;
        }

        if(isset($_GET['sort_by'])){

            $sort_by = $_GET['sort_by'];

            if($sort_by=='giam_dan'){
                $category_by_id = Product::where('category_id',$category_id)->orderBy('price','DESC')->paginate(6)->appends(request()->query());
            }elseif($sort_by=='tang_dan'){
                $category_by_id = Product::where('category_id',$category_id)->orderBy('price','ASC')->paginate(6)->appends(request()->query());
            }elseif($sort_by=='kytu_za'){
                $category_by_id = Product::where('category_id',$category_id)->orderBy('name','DESC')->paginate(6)->appends(request()->query()); 
            }elseif($sort_by=='kytu_az'){
                $category_by_id = Product::where('category_id',$category_id)->orderBy('name','ASC')->paginate(6)->appends(request()->query());
            }

        }elseif(isset($_GET['start_price']) && $_GET['end_price']){

            $min_price = $_GET['start_price'];
            $max_price = $_GET['end_price'];

            $category_by_id = Product::whereBetween('price',[$min_price,$max_price])->where('category_id',$category_id)->orderBy('price','ASC')->paginate(8);

        }else{
            $category_by_id = Product::where('category_id',$category_id)->orderBy('id','DESC')->paginate(8);
        }

        $category_name = Category::where('slug',$slug)->limit(1)->get();

        foreach($category_name as $key => $val){
            $meta_desc = $val->description; 
            $meta_keywords = $val->keyword;
            $meta_title = $val->name;
            $url_canonical = $request->url();          
        }
        return view('shop.shop', compact('banner', 'category_by_id', 'category_name', 'meta_desc', 'meta_keywords', 'meta_title', 'url_canonical',
                                    'categories', 'min_price', 'max_price', 'max_price_range', 'min_price_range'));
    }
}
