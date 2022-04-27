<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Province;
use App\Models\District;
use App\Models\Commune;
use App\Models\Fee;
use App\Models\Address;


use Carbon\Carbon;
use Session;
use Cart;
session_start();

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        $categories = Category::all();
        $province = Province::orderby('matp', 'ASC')->get();
        $content = Cart::content();
        $meta_desc = "Đăng nhập thanh toán"; 
        $meta_keywords = "Đăng nhập thanh toán";
        $meta_title = "Đăng nhập thanh toán";
        $url_canonical = $request->url();
        return view('checkout', compact('categories', 'content', 'province', 'meta_desc', 'meta_keywords', 'meta_title', 'url_canonical'));
    }
    public function billing_address(Request $request)
    {
        $data = $request->all();
    	if($data['action']){
    		$output = '';
    		if($data['action']=="province"){
    			$select_district = District::where('matp',$data['ma_id'])->orderby('maqh','ASC')->get();
    				$output.='<option>---Chọn quận huyện---</option>';
    			foreach($select_district as $key => $district){
    				$output.='<option value="'.$district->maqh.'">'.$district->name.'</option>';
    			}

    		}else{
    			$select_commune = Commune::where('maqh',$data['ma_id'])->orderby('xaid','ASC')->get();
    			    $output.='<option>---Chọn xã phường---</option>';
    			foreach($select_commune as $key => $com){
    				$output.='<option value="'.$com->xaid.'">'.$com->name.'</option>';
    			}
    		}
            echo $output;
    		
    	}
    }
    public function insert_address(Request $request)
    {
        $this->validate($request, [
            'name'=>'required',
            'phone' => 'required',
            'address' => 'required',
        ],
        [
            'name.required' =>'Họ tên không được để trống!',
            'phone.required' =>'Số điện thoại không được để trống!',
            'address.required' =>'Địa chỉ không được để trống!',
        ]);
        $data = $request->all();
        if($data['matp']){
            $fee = Fee::where('matp',$data['matp'])->where('maqh',$data['maqh'])->where('xaid',$data['xaid'])->get();
            if($fee){
                $count = $fee->count();
                if($count > 0){
                    foreach($fee as $key => $fe){
                        Session::put('fee',$fe->transport_fee);
                        Session::save();
                    }         
                }else{ 
                    Session::put('fee',25000);
                    Session::save();
                }
            }
        }
        
        $address = Address::create([
            'customer_id' => Session::get('customer_id'),
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'shipping_fee' => Session::get('fee'),
        ]);
        $address_id = $address->id;
        Session::put('address',$address);
        // Session::put('address_id',$address_id);
    }

    public function list_address(){
		$address = Address::where('customer_id', Session::get('customer_id'))->orderby('id','DESC')->get();
		$output = '';
            foreach ($address as $key => $item) {

                $output.='
        
            <div class="form-check" style="padding-left:15px">';
            if(Session::get('address_id') == $item->id){
                $output.='
                <input checked name="shipping_fee" class="form-check-input shipping_fee" type="radio" value="'.$item->id.'">';
            }else{
                $output.=' <input name="shipping_fee" class="form-check-input shipping_fee" type="radio" value="'.$item->id.'">';
            }
            $output.='
               
                <label class="form-check-label" for="flexRadioDefault1">
                    '.$item->name. ',  (+84)'.$item->phone.', '.$item->address.'
                </label>
            </div>

                ';
            }

			echo $output;

	}
    public function select_address(Request $request)
    {
        $data = $request->all();
        $id = $data['id'];
        $address = Address::where('id', $id)->first();
        Session::put('fee',$address->shipping_fee);
        Session::put('address_id',$id);

    }
    public function confirm_order(Request $request){
        $data = $request->all();
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
        $order_code =  strtoupper(substr(md5(microtime()),rand(0,26),5));
        $order = Order::create([
            'customer_id' => Session::get('customer_id'),
            'address_id' => Session::get('address_id'),
            'code' =>  $order_code,
            'created_at' => $today,
        ]);
        
        if(Session::get('cart')==true){
            foreach(Session::get('cart') as $key => $cart){
                $order_details = new OrderDetail;
                $order_details->order_code = $order_code;
                $order_details->product_id = $cart['id'];
                $order_details->price = $cart['price'];
                $order_details->quantity = $cart['quantity'];
                $order_details->coupon =  $data['order_coupon'];
                $order_details->shipping_fee = $data['order_fee'];
                $order_details->payment = $data['payment'];
                $order_details->note = $data['note'];
                $order_details->created_at = $today;
                $order_details->save();
            }
        }
        Session::forget('coupon');
        Session::forget('fee');
        Session::forget('cart');
        Session::forget('address_id');

    }
}
