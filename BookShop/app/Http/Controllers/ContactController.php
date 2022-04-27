<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Contact;

class ContactController extends Controller
{
    public function contact(Request $request){
        $categories = Category::where('deleted_at', null)->get();
        $contact = Contact::where('id',1)->get();
        $meta_desc = "Liên hệ"; 
        $meta_keywords = "Liên hệ";
        $meta_title = "Liên hệ với chúng tôi";
        $url_canonical = $request->url();
        return view('contact', compact('contact', 'categories', 'meta_desc', 'meta_keywords','meta_title',
        'url_canonical'));
    }
}
