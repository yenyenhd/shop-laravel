<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Categoryt;
use App\Models\Tag;
use App\Models\ProductTag;
use App\Models\ProductImage;
use App\Models\Rating;
use App\Models\Comment;
use Carbon\Carbon;
use App\Models\Customer;
use App\Traits\Delete;
use Session;
session_start();

class CommentController extends Controller
{
    use Delete;

    public function reply_comment(Request $request, $product_id){
        $data = $request->all();
        $comment = new Comment();
        $comment->content = $request->content;
        $comment->product_id = $product_id;
        $comment->parent_id = $request->comment_id;
        $comment->customer_id = Session::get('customer_id');
        $comment->save();
        return redirect()->back()->with('message', 'Trả lời bình luận thành công');
    }


    public function send_comment(Request $request){
        date_default_timezone_set('Asia/Ho_Chi_Minh');
            
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
        
        $comment = new Comment();
        $comment->content = $request->content;
        $comment->product_id = $request->product_id;
        $comment->created_at = $today;
        $comment->customer_id = Session::get('customer_id');
        $comment->save();
    }
    public function insert_rating(Request $request)
    {
        $rating = new Rating();
        $rating->product_id = $request->product_id;
        $rating->rating = $request->index;
        $rating->save();
        echo "done";
    }
   
    
}
