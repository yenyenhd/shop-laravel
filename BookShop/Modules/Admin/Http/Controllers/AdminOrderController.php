<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Address;
use App\Models\OrderDetail;
use App\Models\Fee;
use App\Models\Product;
use App\Models\Coupon;
use PDF;

class AdminOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $orders = Order::all();
        return view('admin::order.index',compact('orders'));
    }

    public function view_order($code) 
    {
        $order_detail = OrderDetail::where('order_code', $code)->get();
        $order = Order::where('code',$code)->get();
		foreach($order as $key => $ord){
			$customer_id = $ord->customer_id;
			$address_id = $ord->address_id;
			$status = $ord->status;
		}
		$customer = Customer::where('id',$customer_id)->first();
		$address = Address::where('id',$address_id)->first();


		foreach($order_detail as $key => $order_d){
			$coupon = $order_d->coupon;
		}
		if($coupon != 'no'){
			$coupon = Coupon::where('code',$coupon)->first();
			$condition = $coupon->condition;
			$sale = $coupon->sale;
		}else{
			$condition = 2;
			$sale = 0;
		}
        return view('admin::order.view_order', compact('order_detail','order', 'customer', 'address', 'coupon', 'sale', 'condition', 'status' ));
    }
    public function print_order($code){
		$pdf = \App::make('dompdf.wrapper');
		$pdf->loadHTML($this->print_order_convert($code));
		
		return $pdf->stream();
	}
	public function print_order_convert($code){
        $order_detail = OrderDetail::where('order_code', $code)->get();
        $order = Order::where('code', $code)->get();
        foreach ($order as $key => $ord) {
            $customer_id = $ord->customer_id;
            $shipping_id = $ord->shipping_id;
            $status = $ord->status;
        }
        $customer = Customer::where('id', $customer_id)->first();
        $shipping = Shipping::where('id', $shipping_id)->first();

        foreach($order_detail as $key => $order_d){
			$coupon = $order_d->coupon;
		}
        if($coupon != 'no'){
			$coupon = Coupon::where('code',$coupon)->first();
			$condition = $coupon->condition;
			$sale = $coupon->sale;
		}else{
			$condition = 2;
			$sale = 0;
		}

        $output = '';

        $output.='<style>body{
			font-family: DejaVu Sans;
		}
		.table-styling{
			border:1px solid #000;
		}
		.table-styling tbody tr td{
			border:1px solid #000;
		}
		</style>
		<h1><centerCông ty TNHH một thành viên ABCD</center></h1>
		<h4><center>Độc lập - Tự do - Hạnh phúc</center></h4>
		<p>Thông tin khách hàng</p>
		<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
		<thead>
		    <tr>
                <th>Tên người đặt hàng</th>
                <th>Tên người nhận hàng</th>
                <th>Số điện thoại</th>
                <th>Email</th>
                <th>Địa chỉ</th>
		    </tr>
		</thead>
		<tbody>';

        $output.='		
		<tr>
            <td>'.$shipping->customer->name.'</td>
            <td>'.$shipping->name.'</td>
            <td>'.$shipping->phone.'</td>
            <td>'.$shipping->email.'</td>
            <td>'.$shipping->address.'</td>
		</tr>';


        $output.='				
		</tbody>

		</table>

		<p>Thông tin đơn hàng</p>

        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Mã giảm giá</th>
                    <th>Thành tiền</th>
                    <th>Hình thức thanh toán</th>
                    <th>Ghi chú đơn hàng</th>
                </tr>
            </thead>
            <tbody>';
        $total = 0;
        foreach ($order_detail as $detail) {
            $subtotal = $detail->price*$detail->quantity;
            $total+=$subtotal;
            if ($detail->coupon != 'no') {
                $coupon = $detail->coupon;
            } else {
                $coupon = 'không mã';
            }
            if ($detail->payment==0) {
                $payment = 'Bằng ATM';
            } elseif ($detail->payment==1) {
                $payment = 'Bằng tiền mặt';
            } else {
                $payment = 'Bằng MOMO';
            }
                    
             $output.='		
                <tr>
                    <td>'.$detail->product->name.'</td>
                    <td>'.number_format($detail->price, 0, ',', '.'). ' đ'.'</td>
                    <td>'.$detail->quantity.'</td>
                    <td>'.$coupon.'</td>
                    <td>'.$subtotal.'</td>
                    <td>'.$payment.'</td>
                    <td>'.$detail->note.'</td>
                </tr>';
        }
                   $fee = $detail->transport_fee;
                    if($condition==1){
                        $total_after_coupon = ($total*$sale)/100;
                        $total_order = $total - $total_after_coupon + $fee;
                    }else{
                        $total_after_coupon = $sale;
                        $total_order = $total - $sale + $fee;
                    }            
                    $output.= '<tr>
                        <td>&nbsp</td>
                        <td>&nbsp</td>
                        <td>&nbsp</td>
                        <td>&nbsp</td>
                        <td>&nbsp</td>
                        <td colspan="3">
                        <p>Mã giảm giá : -: '.number_format($total_after_coupon,0,',','.').' đ'.'</p>
                        <p>Phí giao hàng: '.number_format($fee,0,',','.').'đ'.'</p>
                        <p>Tổng tiền : '.number_format($total_order,0,',','.').'đ'.'</p>
                        </td>
                        </tr>';
        $output.='				
        </tbody>
    
        </table>
                
        <p>Ký tên</p>
            <table>
                <thead>
                    <tr>
                        <th width="200px">Người lập phiếu</th>
                        <th width="800px">Người nhận</th>

                    </tr>
                </thead>
            <tbody>';

            $output.='				
            </tbody>

            </table>';          
	    return $output;

	}
    public function update_qty(Request $request)
    {
        $data = $request->all();
		$order_detail = OrderDetail::where('product_id',$data['order_product_id'])->where('order_code',$data['order_code'])->first();
		$order_detail->quantity = $data['order_qty'];
		$order_detail->save();
    }
    public function update_order_quantity(Request $request)
    {
        $data = $request->all();
        $order = Order::find($data['id']);
        $order->status = $data['status'];
        $order->save();

        //lay san pham
        if ($order->status == 2) {
            foreach ($data['order_product_id'] as $key => $product_id) {
                $product = Product::find($product_id);
                $quantity = $product->quantity;
                $sold = $product->sold;
                foreach ($data['quantity'] as $key2 => $qty) {
                    if ($key==$key2) {
                        $pro_remain = $quantity - $qty;
                        $product->quantity = $pro_remain;
                        $product->sold = $sold + $qty;
                        $product->save();
                    }
                }
            }
        }elseif($order->status != 2 && $order->status != 3){
            foreach ($data['order_product_id'] as $key => $product_id) {
                $product = Product::find($product_id);
                $quantity = $product->quantity;
                $sold = $product->sold;
                foreach ($data['quantity'] as $key2 => $qty) {
                    if ($key==$key2) {
                        $pro_remain = $quantity + $qty;
                        $product->quantity = $pro_remain;
                        $product->sold = $sold - $qty;
                        $product->save();
                    }
                }
            }
        }
    }
		// //send mail confirm
		// $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
		// $title_mail = "Đơn hàng đã đặt được xác nhận".' '.$now;
		// $customer = Customer::where('customer_id',$order->customer_id)->first();
		// $data['email'][] = $customer->customer_email;

		
	  

		
	//   	//lay shipping
	//   	$details = OrderDetails::where('order_code',$order->order_code)->first();

	// 	$fee_ship = $details->product_feeship;
	// 	$coupon_mail = $details->product_coupon;

	//   	$shipping = Shipping::where('shipping_id',$order->shipping_id)->first();
	  	
	// 	$shipping_array = array(
	// 		'fee_ship' =>  $fee_ship,
	// 		'customer_name' => $customer->customer_name,
	// 		'shipping_name' => $shipping->shipping_name,
	// 		'shipping_email' => $shipping->shipping_email,
	// 		'shipping_phone' => $shipping->shipping_phone,
	// 		'shipping_address' => $shipping->shipping_address,
	// 		'shipping_notes' => $shipping->shipping_notes,
	// 		'shipping_method' => $shipping->shipping_method

	// 	);
	//   	//lay ma giam gia, lay coupon code
	// 	$ordercode_mail = array(
	// 		'coupon_code' => $coupon_mail,
	// 		'order_code' => $details->order_code
	// 	);

	// 	Mail::send('admin.confirm_order',  ['cart_array'=>$cart_array, 'shipping_array'=>$shipping_array ,'code'=>$ordercode_mail] , function($message) use ($title_mail,$data){
	// 		      $message->to($data['email'])->subject($title_mail);//send this mail with subject
	// 		      $message->from($data['email'],$title_mail);//send from this mail
	// 	});


	// 	//order date
	// 	$order_date = $order->order_date;	
		
	// 	$statistic = Statistic::where('order_date',$order_date)->get();
	// 	if($statistic){
	// 		$statistic_count = $statistic->count();	
	// 	}else{
	// 		$statistic_count = 0;
	// 	}	

	// 	if($order->order_status==2){
	// 		//them
	// 		$total_order = 0;
	// 		$sales = 0;
	// 		$profit = 0;
	// 		$quantity = 0;

	// 		foreach($data['order_product_id'] as $key => $product_id){

	// 			$product = Product::find($product_id);
	// 			$product_quantity = $product->product_quantity;
	// 			$product_sold = $product->product_sold;
	// 			//them
	// 			$product_price = $product->product_price;
	// 			$product_cost = $product->price_cost;
	// 			$now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

	// 			foreach($data['quantity'] as $key2 => $qty){

	// 				if($key==$key2){
	// 					$pro_remain = $product_quantity - $qty;
	// 					$product->product_quantity = $pro_remain;
	// 					$product->product_sold = $product_sold + $qty;
	// 					$product->save();
	// 					//update doanh thu
	// 					$quantity+=$qty;
	// 					$total_order+=1;
	// 					$sales+=$product_price*$qty;
	// 					$profit = $sales - ($product_cost*$qty);
	// 				}

	// 			}
	// 		}
	// 		//update doanh so db
	// 		if($statistic_count>0){
	// 			$statistic_update = Statistic::where('order_date',$order_date)->first();
	// 			$statistic_update->sales = $statistic_update->sales + $sales;
	// 			$statistic_update->profit =  $statistic_update->profit + $profit;
	// 			$statistic_update->quantity =  $statistic_update->quantity + $quantity;
	// 			$statistic_update->total_order = $statistic_update->total_order + $total_order;
	// 			$statistic_update->save();

	// 		}else{

	// 			$statistic_new = new Statistic();
	// 			$statistic_new->order_date = $order_date;
	// 			$statistic_new->sales = $sales;
	// 			$statistic_new->profit =  $profit;
	// 			$statistic_new->quantity =  $quantity;
	// 			$statistic_new->total_order = $total_order;
	// 			$statistic_new->save();
	// 		}



	// 	}

    // }
}
