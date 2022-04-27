<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Address;
use App\Models\Coupon;
use Carbon\Carbon;



use Session;

session_start();


class OrderController extends Controller
{
    public function history(Request $request){
		if(!Session::get('customer_id')){
			return redirect('login-checkout')->with('error','Vui lòng đăng nhập!');
		}else{
            $categories = Category::where('deleted_at', null)->where('status', 1)->get();
	        //seo 
	        $meta_desc = "Lịch sử đơn hàng"; 
	        $meta_keywords = "Lịch sử đơn hàng";
	        $meta_title = "Lịch sử đơn hàng";
	        $url_canonical = $request->url();
	        //--seo

	        $getorder = Order::where('customer_id',Session::get('customer_id'))->orderby('id','DESC')->paginate(10);

	    	return view('history.history', compact('categories', 'meta_desc', 'meta_keywords', 'meta_title', 'url_canonical', 'getorder'));
		}
	}
	public function view_history_order(Request $request, $order_code){
		if(!Session::get('customer_id')){
			return redirect('login-checkout')->with('error','Vui lòng đăng nhập!');
		}else{
            $categories = Category::where('deleted_at', null)->where('status', 1)->get();
	        //seo 
	        $meta_desc = "Lịch sử đơn hàng"; 
	        $meta_keywords = "Lịch sử đơn hàng";
	        $meta_title = "Lịch sử đơn hàng";
	        $url_canonical = $request->url();
	        
	        //xem lich sử
			$getorder = Order::where('code',$order_code)->first();
			$customer_id = $getorder->customer_id;
			$address_id = $getorder->address_id;
			$order_status = $getorder->status;
			
			$customer = Customer::where('id', $customer_id)->first();
			$address = Address::where('id', $address_id)->first();

			$order_details_product = OrderDetail::where('order_code', $order_code)->get();

			foreach($order_details_product as $key => $order_d){
				$product_coupon = $order_d->coupon;
			}
			if($product_coupon != 'no'){
				$coupon = Coupon::where('code',$product_coupon)->first();
				$coupon_condition = $coupon->condition;
				$coupon_sale = $coupon->sale;
			}else{
				$coupon_condition = 2;
				$coupon_sale = 0;
			}

	    	return view('history.history_detail', compact('categories', 'meta_desc', 'meta_keywords', 'meta_title', 'url_canonical', 
            'customer', 'order_code', 'address', 'order_details_product', 'coupon_condition', 'coupon_sale'));
        }
	}
    public function cancel_order(Request $request){
		$today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
		$data = $request->all();
		$order = Order::where('code',$data['order_code'])->first();
		$order->destroy = $data['cause'];
		$order->status = 3;
		$order->updated_at = $today;
		$order->save();
	}
}
