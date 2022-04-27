<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Requests\RequestLogin;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Https\Social;
use Socialite;
use App\Models\Statistical;
use App\Models\Visitor;
use App\Models\Product;
use App\Models\Post;
use App\Models\Order;
use App\Models\Customer;




use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        if(Auth::check()){
            return redirect('admin/dashboard');
        }else{
            return view('admin::login');
        }
    }

    public function login(RequestLogin $request)
    {
        $remember = $request->has('remember_me') ? true : false;
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember))
        {
            return redirect('admin/dashboard');
        }
        else
        {
            return redirect('admin')->with('message', 'Tài khoản hoặc mật khẩu không đúng!');
        }
    }

    public function logout()
    {
        Auth::logout();
        return view('admin::login');
    }
    public function dashboard(Request $request)
    {
        $user_ip_address = $request->ip();  

        $early_last_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();

        $end_of_last_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();

        $early_this_month = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();

        $oneyears = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();

        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        $visitor_of_lastmonth = Visitor::whereBetween('date_visited',[$early_last_month,$end_of_last_month])->get(); 
        $visitor_last_month_count = $visitor_of_lastmonth->count();
    
            //total this month
        $visitor_of_thismonth = Visitor::whereBetween('date_visited',[$early_this_month,$now])->get(); 
        $visitor_this_month_count = $visitor_of_thismonth->count();
    
            //total in one year
        $visitor_of_year = Visitor::whereBetween('date_visited',[$oneyears,$now])->get(); 
        $visitor_year_count = $visitor_of_year->count();
    
            //total visitors
        $visitors = Visitor::all();
        $visitors_total = $visitors->count();
    
            //current online
        $visitors_current = Visitor::where('ip_address',$user_ip_address)->get();  
        $visitor_count = $visitors_current->count();
    
        if($visitor_count<1){
            $visitor = new Visitor;
            $visitor->ip_address = $user_ip_address;
            $visitor->date_visited = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
            $visitor->save();
        }
    
            //total 
        $product = Product::all()->count();
        $post = Post::all()->count();
        $order = Order::all()->count();
        $customer = Customer::all()->count();
    
        $product_views = Product::orderBy('view','DESC')->take(20)->get();
        $post_views = Post::orderBy('view','DESC')->take(20)->get();
        return view('admin::dashboard', compact('visitors_total','visitor_count','visitor_last_month_count',
        'visitor_this_month_count','visitor_year_count','product','post','order','customer', 'product_views', 'post_views'));
    }
    public function error()
    {
        return view('admin::404');
    }

    // Login FB
    public function login_facebook(){
        return Socialite::driver('facebook')->redirect();
    }
    
    public function callback_facebook(){
    
        $provider = Socialite::driver('facebook')->user();
        $account = Social::where('provider','facebook')->where('provider_id',$provider->getId())->first();
    
        if($account!=NULL){
    
            $account_name = Login::where('id',$account->user)->first();
            Session::put('admin_name',$account_name->name);
            Session::put('login_normal',true);
            Session::put('admin_id',$account_name->id);
            return redirect('/admin/dashboard')->with('message', 'Đăng nhập thành công');
    
        }elseif($account==NULL){
    
            $admin_login = new Social([
                'provider_id' => $provider->getId(),
                'provider_email' => $provider->getEmail(),
                'provider' => 'facebook'
            ]);
    
            $orang = Login::where('email',$provider->getEmail())->first();
    
            if(!$orang){
                $orang = Login::create([
                    'name' => $provider->getName(),
                    'email' => $provider->getEmail(),
                    'password' => '',
                ]);
            }
            $admin_login->login()->associate($orang);
            $admin_login->save();
    
            $account_name = Login::where('id',$admin_login->user)->first();
            Session::put('admin_name',$admin_login->name);
            Session::put('login_normal',true);
            Session::put('admin_id',$admin_login->id);
            return redirect('/admin/dashboard')->with('message', 'Đăng nhập Admin thành công');
    
        } 
    
    
    }

    // Dashboard
    public function filter_by_date(Request $request){
        $data = $request->all();
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];
    
        $get = Statistical::whereBetween('order_date',[$from_date,$to_date])->orderBy('order_date','ASC')->get();
    
    
        foreach($get as $key => $val){
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' => $val->quantity
            );
        }
    
        echo $data = json_encode($chart_data);  
    
    }
    public function dashboard_filter(Request $request){

        $data = $request->all();
    
            // $today = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
           // $tomorrow = Carbon::now('Asia/Ho_Chi_Minh')->addDay()->format('d-m-Y H:i:s');
           // $lastWeek = Carbon::now('Asia/Ho_Chi_Minh')->subWeek()->format('d-m-Y H:i:s');
           // $sub15days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(15)->format('d-m-Y H:i:s');
           // $sub30days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(30)->format('d-m-Y H:i:s');
    
        $dauthangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $dau_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $cuoi_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();
    

        $sub7days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
        $sub365days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
    
        $dauthang9 = Carbon::now('Asia/Ho_Chi_Minh')->subMonth(2)->startOfMonth()->toDateString();
        $cuoithang9 = Carbon::now('Asia/Ho_Chi_Minh')->subMonth(2)->endOfMonth()->toDateString();
    
    
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
    
        if($data['dashboard_value']=='7ngay'){
    
            $get = Statistical::whereBetween('order_date',[$sub7days,$now])->orderBy('order_date','ASC')->get();
    
        }elseif($data['dashboard_value']=='thangtruoc'){
    
            $get = Statistical::whereBetween('order_date',[$dau_thangtruoc,$cuoi_thangtruoc])->orderBy('order_date','ASC')->get();
    
        }elseif($data['dashboard_value']=='thangnay'){
    
            $get = Statistical::whereBetween('order_date',[$dauthangnay,$now])->orderBy('order_date','ASC')->get();
    
        }elseif ($data['dashboard_value']=='thang9') {
    
            $get = Statistical::whereBetween('order_date',[$dauthang9,$cuoithang9])->orderBy('order_date','ASC')->get();
    
        }else{
            $get = Statistical::whereBetween('order_date',[$sub365days,$now])->orderBy('order_date','ASC')->get();
        }
    
    
        foreach($get as $key => $val){
    
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' => $val->quantity
            );
        }
    
        echo $data = json_encode($chart_data);
    
    }
    public function days_order(){

        $sub60days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(60)->toDateString();
    
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
    
        $get = Statistical::whereBetween('order_date',[$sub60days,$now])->orderBy('order_date','ASC')->get();
    
    
        foreach($get as $key => $val){
    
           $chart_data[] = array(
            'period' => $val->order_date,
            'order' => $val->total_order,
            'sales' => $val->sales,
            'profit' => $val->profit,
            'quantity' => $val->quantity
        );
    
       }
    
       echo $data = json_encode($chart_data);
    }
    
}
