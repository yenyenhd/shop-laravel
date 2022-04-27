<?php

namespace App\Providers;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\ProductTag;
use App\Models\ProductImage;
use App\Models\Customer;
use App\Models\Post;
use App\Models\Contact;



use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*',function($view) {
            // //get information 
            // $post_footer = Post::where('cate_post_id',7)->get();
            // //get information 
            // $contact_footer = Contact::where('info_id',1)->get();
            // //get icons social
            // $icons = Icons::where('category','icons')->orderBy('id_icons','DESC')->get();
            // //get icons doi tac
            // $icons_doitac = Icons::where('category','doitac')->orderBy('id_icons','DESC')->get();

            $min_price = Product::min('price');
            $max_price = Product::max('price');

            $min_price_range = $min_price - 20000;
            $max_price_range = $max_price + 100000;
            
            $app_product = Product::all()->count();
            $app_order = Order::all()->count();
            $app_post = Post::all()->count();
            $app_customer = Customer::all()->count();
            $app_contact = Contact::where('id',1)->get();
            $share_image = '';

            $categories = Category::where('deleted_at', null)->where('status', 1)->get();

            $view->with('min_price', $min_price )->with('max_price', $max_price )->with('min_price_range', $min_price_range )->with('max_price_range', $max_price_range )
            ->with('app_product', $app_product )->with('app_order', $app_order )->with('app_post', $app_post)->with('app_customer', $app_customer )->with('share_image',$share_image)
            ->with('categories',$categories)->with('app_contact',$app_contact);

        });
    }
}
