<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RequestLogin;

use App\Models\Customer;
use App\Models\Category;
use App\Traits\StorageImage;
use Illuminate\Support\Facades\Storage;
use App\Rules\Capcha;
use Session;
use Cart;
session_start();

class CustomerController extends Controller
{
    use StorageImage;
    public function add_customer(Request $request)
    {
        $categories = Category::where('deleted_at', null)->get();
        $meta_desc = "Thêm khách hàng"; 
        $meta_keywords = "Thêm khách hàng";
        $meta_title = "Thêm khách hàng";
        $url_canonical = $request->url();
        return view('register', compact('categories', 'meta_desc', 'meta_keywords', 'meta_title', 'url_canonical'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'username'=>'required|unique:customers,username',
            'phone' => 'required',
            'email' => 'required',
            'password'=>'required|min:6|max:32',
            'passwordAgain'=>'required|same:password',
            // 'g-recaptcha-response' => new Captcha(),
            
        ],
        [
            'name.required' =>'Họ tên không được để trống!',
            'username.required' =>'Tên đăng nhập không được để trống!',
            'name.unique' => 'Tên đăng nhập đã tồn tại',
            'phone.required' => 'Số điện thoại không được để trống!',
            'email.required' =>'Email không được để trống!',
            'password.required' =>'Mật khẩu không được để trống!',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'password.max' => 'Mật khẩu chỉ được tối đa 32 ký tự',
            'passwordAgain.required' => 'Bạn chưa nhập lại mật khẩu',
            'passwordAgain.same'=> 'Mật khẩu nhập lại không đúng',
        ]);
        $dataInsert = [
            'name' => $request->name,
            'username' => $request->username,
            'phone' => $request->phone,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => md5($request->password),
        ];
        $customer = Customer::create($dataInsert);
        Session::put('customer_id',$customer->id);
        Session::put('customer',$customer);
        return redirect('/login-checkout')->with('message', 'Thêm tài khoản thành công');
    }

    public function login_checkout(Request $request)
    {
        $categories = Category::where('deleted_at', null)->get();
        $meta_desc = "Đăng nhập"; 
        $meta_keywords = "Đăng nhập";
        $meta_title = "Đăng nhập";
        $url_canonical = $request->url();
        return view('login', compact('categories', 'meta_desc', 'meta_keywords', 'meta_title', 'url_canonical'));
    }
    public function login(RequestLogin $request)
    {
        $remember = $request->has('remember_me') ? true : false;
        $email = $request->email;
        $password = md5($request->password);
        $result = Customer::where(['email' => $email, 'password' => $password])->first();
        if($result){
            Session::put('customer_id',$result->id);
            return redirect('/checkout');
        }else{
            return redirect('/login-checkout')->with('message', 'Tài khoản hoặc mật khẩu không chính xác!');
        }
    }
    public function logout()
    {
        Session::flush();
        return redirect('/login-checkout');
    }

}
