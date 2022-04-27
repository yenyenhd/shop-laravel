<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;


class PostController extends Controller
{
    public function post(Request $request)
    {
        $posts = Post::latest()->paginate(6);
        $categories = Category::where('deleted_at', null)->get();

        $meta_desc = "Tin tức mới nhất về sách"; 
        $meta_keywords = "Tin tức sách";
        $meta_title = "Tin tức mới nhất về sách";
        $url_canonical = $request->url();
        return view('post.index', compact('posts', 'categories', 'meta_desc', 'meta_keywords','meta_title',
        'url_canonical'));
    }
    public function post_detail($slug, Request $request)
    {
        $categories = Category::where('deleted_at', null)->get();
        $post = Post::where('status',1)->where('slug',$slug)->first();
        $post->view = $post->view + 1;
        $post->save();
        
        $meta_desc = $post->description; 
        $meta_keywords = $post->keyword;
        $meta_title = $post->title;
        $url_canonical = $request->url();
        // $share_image = url('public/'.$post->image_path);
        
        $related = Post::where('status', 1)->whereNotIn('slug', [$post->slug])->take(3)->get();
        $view = Post::where('status', 1)->orderBy('view', 'DESC')->take(3)->get();

        return view('post.post_detail', compact('post', 'meta_desc', 'meta_keywords','meta_title',
         'url_canonical', 'categories', 'related', 'view'  ));
    }
}
