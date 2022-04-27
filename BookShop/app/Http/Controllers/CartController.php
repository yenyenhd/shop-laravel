<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Coupon;
use App\Models\Category;

use Cart;
use Session;
session_start();

class CartController extends Controller
{
    public function show_cart(Request $request)
    {
        $categories = Category::where('deleted_at', null)->get();

        $meta_desc = "Giỏ hàng của bạn"; 
        $meta_keywords = "Giỏ hàng Ajax";
        $meta_title = "Giỏ hàng Ajax";
        $url_canonical = $request->url();

        return view('product.cart_ajax', compact('categories', 'meta_desc', 'meta_keywords', 'meta_title', 'url_canonical'));
    }
     // public function cart(Request $request)
    // {
    //     $product_id = $request->productid_hidden;
    //     $quantity = $request->qty;
    //     $product_info = Product::where('id',$product_id )->first();
    //     $data = [
    //         'id' => $product_id, 
    //         'name' => $product_info->name,
    //         'qty' => $quantity, 
    //         'price' => $product_info->price, 
    //         'weight' => 550, 
    //         'options' => ['image' => $product_info->avatar_path]
    //     ];
    
    //     Cart::add($data);
    //     // Cart::destroy();

    //     return redirect('/cart');
    // }
    public function add_cart_ajax(Request $request){
        $data = $request->all();
        $session_id = substr(md5(microtime()),rand(0,26),5);
        $cart = Session::get('cart');
        if($cart==true){
            $is_avaiable = 0;
            foreach($cart as $key => $val){
                if($val['id']==$data['cart_product_id']){
                    $is_avaiable++;
                }
            }
            if($is_avaiable == 0){
                $cart[] = array(
                'session_id' => $session_id,
                'id' => $data['cart_product_id'],
                'name' => $data['cart_product_name'],
                'avatar_path' => $data['cart_product_image'],
                'quantity' => $data['cart_product_qty'],
                'product_qty' => $data['cart_product_quantity'],
                'price' => $data['cart_product_price'],
                );
                Session::put('cart',$cart);
                Session::save();
            }
        }else{
            $cart[] = array(
                'session_id' => $session_id,
                'name' => $data['cart_product_name'],
                'id' => $data['cart_product_id'],
                'avatar_path' => $data['cart_product_image'],
                'quantity' => $data['cart_product_qty'],
                'product_qty' => $data['cart_product_quantity'],
                'price' => $data['cart_product_price'],

            );
            Session::put('cart',$cart);
            Session::save();
        }
    }
    public function update(Request $request)
    {
        $rowId = $request->rowId_cart;
        // $qty = $request->qty_cart;
        Cart::update($rowId, ['qty' => $request->qty_cart]);
        return redirect('/cart');

    }
    public function update_quick_cart(Request $request){

        $data = $request->all();
        $cart = Session::get('cart');
        if($cart==true){
            foreach($cart as $session => $val){

                if($val['session_id']==$data['session_id']){
                    $cart[$session]['quantity'] = $data['quantity'];
                }
            }

        Session::put('cart',$cart);
           
        }
    }
    public function update_ajax(Request $request)
    {
        $data = $request->all();
        $cart = Session::get('cart');
        if($cart == true) {
            $message = '';
            $error = '';

            foreach($data['qty_cart'] as $key => $qty){
                $i =0;
                foreach($cart as $session => $val){
                    $i++;
                    if($val['session_id'] == $key && $qty < $cart[$session]['product_qty']){
                        $cart[$session]['quantity'] = $qty;
                        $message .='Cập nhật số lượng: '.$cart[$session]['name'].' thành công';
                    }elseif($val['session_id'] == $key && $qty > $cart[$session]['product_qty']){
                        $error .='Cập nhật số lượng: '.$cart[$session]['name'].' thất bại';
                    }
                }
            }
            Session::put('cart', $cart);
            return redirect()->back()->with('message', $message);
        }else{
            return redirect()->back()->with('error', 'Cập nhật số lượng thất bại');
        }

    }
    public function delete($rowId)
    {
        Cart::update($rowId, 0);
        return redirect('/cart');
    }
    public function delete_ajax($session_id)
    {
        $cart = Session::get('cart');
        if($cart == true) {
            foreach($cart as $key =>$val){
                if($val['session_id'] == $session_id){
                    unset($cart[$key]);
                }
            }
            Session::put('cart', $cart);
            return redirect()->back()->with('message', 'Xóa sản phẩm thành công');
        }else{
            return redirect()->back()->with('error', 'Xóa sản phẩm thất bại');
        }
    }
    public function delete_all()
    {
       $cart = Session::get('cart');
       if($cart == true) {
           Session::forget('cart');
           Session::forget('coupon');

       }
       return redirect()->back()->with('message', 'Xóa sản phẩm thành công');

    }

    public function show_quick_cart(){
        $output ='
        <form>
        '.csrf_field().'
        <div class="table-content table-responsive">
            <table>
                <thead>
                    <tr>
                        <th class="img-thumbnail">Hình ảnh</th>
                        <th class="product-name">Sản phẩm</th>
                        <th class="product-price">Giá</th>
                        <th class="product-quantity">Số lượng</th>
                        <th class="product-subtotal">Thành tiền</th>
                        <th class="product-remove">Xóa</th>
                    </tr>
                </thead>
                <tbody>';
                if(Session::get('cart')){      
					$total = 0;       
						foreach(Session::get('cart') as $key => $cart){
                            $subtotal = $cart['price']*$cart['quantity'];
                            $total+=$subtotal;
                    $output.='<tr>
                        <td width="15%" class="product-thumbnail">
                            <img src="'. asset('public/'.$cart['avatar_path']) .'" alt="">
                        </td>
                        <td width="25%" class="product-name"><a href="#">'.$cart['name'].'</a></td>
                        <td width="15%" class="product-price"><span class="amount">'. number_format($cart['price'],0,',','.')  .' đ</span></td>
                        <td width="15%" class="product-quantity">
                            <div class="quickview_plus_minus quick_cart">
                                <div class="quickview_plus_minus_inner">
                                    <div class="cart-plus-minus cart_page">
                                        <input class="cart_qty_update" type="number" data-session_id="'.$cart['session_id'].'" min="1" value="'.$cart['quantity'].'" >
                                    </div>
                                </div>    
                            </div> 
                        </td>
                        <td width="15%" class="product-subtotal">'.number_format($subtotal,0,',','.').'đ</td>
                        <td width="10%" class="product-remove">
                            <a class="cart_quantity_delete" style="cursor:pointer" id="'.$cart['session_id'].'" onclick="DeleteItemCart(this.id)">
                                <i class="fa fa-times"></i>
                            </a>
                        </td>
                    </tr>';
                    }
                }else{
                    $output.='<p>Làm ơn thêm sản phẩm vào giỏ hàng</p>';
                }
                $output.='
                </tbody>
                </table>
                </div>';
                
                if (Session::get('cart')) {
                    $output.='
                <div class="row table-responsive_bottom">
                    <div class="col-lg-7 col-sm-7 col-md-7">
                        <div class="buttons-carts">
                        <a class="check_out" href="'.route('delete_all').'">Xóa tất cả</a>
                        </div> 
                    </div> 
                    <div class="col-lg-5 col-sm-5 col-md-5">
                        <div class="cart_totals  text-right">
                            <h4>Cart Totals</h4>
                            <div class="cart-subtotal">
                                <span>Tiền hàng</span>    
                                <span>'.number_format($total, 0, ',', '.').'đ</span>    
                            </div>
                            <div class="wc-proceed-to-checkout">';
                            if (Session::get('customer_id')) {
                            $output.='
                                <a href="'.route('checkout').'">Đặt hàng</a>';
                            } else {
                            $output.='
                                <a  href="'.route('login_checkout') .'">Đặt hàng</a>';
                            }
                        
                            $output.='
                            </div>
                        </div>    
                    </div>    
                </div>';
                }
        
        
        $output.='
    </form>';
    

    echo $output;
    }
   
    public function cart_session(){
       
        $output ='';
        
        if(Session::get('cart')==true){
            foreach(Session::get('cart') as $key => $value){
               
                $output.= '<input type="hidden" class="cart_id" value="'.$value['id'].'">';
            }
        }
        echo $output;
    }
    public function show_cart_menu(){
        $cart = count(Session::get('cart'));
        $output = '';
        $output.='<i class="ion-android-cart"></i><span class="cart_count">'.$cart.'</span>';
        echo $output;
    }
    public function hover_cart(){
        $cart = count(Session::get('cart'));
        $output = '';
        if ($cart>0) {
            $total = 0;
            foreach (Session::get('cart') as $key => $cart) {
                $subtotal = $cart['price']*$cart['quantity'];
                $total+=$subtotal;
                $output.='
            <div class="mini_cart_item">
                <div class="mini_cart_img">
                    <a href="">
                        <img src="'.asset('public/'.$cart['avatar_path']).'" alt="">
                        <span class="cart_count">'.$cart['quantity'].'</span>
                    </a>
                </div>
                <div class="cart_info">
                    <h5><a href="product-details.html">'.$cart['name'].'</a></h5>
                    <span class="cart_price">'.number_format($cart['price'], 0, ',', '.')  .' đ</span>
                </div>
                <div class="cart_remove">
                    <a href="#"><i class="zmdi zmdi-delete"></i></a>
                </div>
            </div>';
            }
            $output.='
            <div class="price_content">
                <div class="cart_subtotals">
                    <div class="price_inline">
                        <span class="label">Tiền hàng </span>
                        <span class="value">'.number_format($total,0,',','.').'đ </span>
                    </div>
                </div>
            </div>
            <div class="min_cart_checkout">';
            if (Session::get('customer_id')) {
                $output.='
                <a href="'.route('checkout').'">Đặt hàng</a>';
            }else{
                $output.='
                <a  href="'.route('login_checkout') .'">Đặt hàng</a>';
            }
            $output.='
            </div>
            ';
            
        
        }

        echo $output;
    }
    
}
