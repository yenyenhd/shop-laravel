<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Coupon;

use Cart;
use Session;
session_start();
class CouponController extends Controller
{
    public function check_coupon(Request $request)
    {
        $data = $request->all();
        $coupon = Coupon::where('code', $data['coupon'])->first();
        if($coupon){
            $count_coupon = $coupon->count();
            if($count_coupon > 0){
                $coupon_session = Session::get('coupon');
                if($coupon_session == true){
                    $is_avaiable = 0;
                    if($is_avaiable == 0){
                        $cou[] = array(
                            'code' => $coupon->code,
                            'condition' => $coupon->condition,
                            'sale' => $coupon->sale,
                        );
                        Session::put('coupon' , $cou);
                    }
                }else{
                    $cou[] = array(
                        'code' => $coupon->code,
                        'condition' => $coupon->condition,
                        'sale' => $coupon->sale,
                    );
                    Session::put('coupon' , $cou);
                }
                Session::save();
                return redirect()->back()->with('message', 'Thêm mã giảm giá thành công');
            }
        }else{
            return redirect()->back()->with('error', 'Mã giảm giá không đúng');
        }
    }
    public function delete_coupon()
    {
       $coupon = Session::get('coupon');
       if($coupon == true) {
           Session::forget('coupon');
       }
       return redirect()->back()->with('message', 'Xóa mã khuyến mãi thành công');

    }
}
