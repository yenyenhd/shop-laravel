<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Contact;
use App\Traits\StorageImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Log;

class AdminContactController extends Controller
{
    use StorageImage;
    public function index()
    {
        $contact = Contact::all();
        return view('admin::contact.index', compact('contact'));
    }
    public function create()
    {
        return view('admin::contact.create');
    }
    public function save_info(Request $request){
        $dataImage = $this->storageUpload($request, 'logo', 'logo');
        $contact= Contact::create([
            'contact' => $request->contact,
            'slogan' => $request->slogan,
            'map' => $request->map,
            'logo' => $dataImage['file_path'],
        ]);
    	return redirect()->back()->with('message','Thêm thông tin website thành công');

    }
    public function edit($id)
    {
        $contact = Contact::find($id);
        return view('admin::contact.edit', compact('contact'));
    }
    public function update(Request $request,$id){
    	$data = $request->all();
    	$contact = Contact::find($id);
        $dataUpdate = [
            'contact' => $request->contact,
            'slogan' => $request->slogan,
            'map' => $request->map,
        ];

        $dataImage = $this->storageUpload($request, 'logo', 'logo');
        if(!empty($dataImage)){
            $dataUpdate['logo'] = $dataImage['file_path'];
        }
        Contact::find($id)->update($dataUpdate);
    
    	return redirect()->back()->with('message','Cập nhật thông tin website thành công');
    }

}
