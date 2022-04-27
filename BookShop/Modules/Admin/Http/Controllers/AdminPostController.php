<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Requests\RequestPost;
use Illuminate\Routing\Controller;
use App\Models\Post;
use Illuminate\Support\Str;
use App\Traits\Delete;
use App\Traits\StorageImage;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Imports\ImportPost;
use App\Exports\ExportPost;
use Excel;

class AdminPostController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    use Delete;
    use StorageImage;
    public function index()
    {
        $posts = Post::all();
        return view('admin::post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('admin::post.add');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(RequestPost $request)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
        $dataInsert = [
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'slug' => str::slug($request->title),
            'keyword' => $request->keyword,
            'created_at' => $today,
        ];
        $dataImage = $this->storageUpload($request, 'image_path', 'post');
        if(!empty($dataImage)){
            $dataInsert['image_path'] = $dataImage['file_path'];
        }
        $post = Post::create($dataInsert);
        return redirect('admin/post/create')->with('message', 'Thêm bài viết thành công');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('admin::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return view('admin::post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
         
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
        $dataUpdate = [
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'slug' => str::slug($request->title),
            'keyword' => $request->keyword,
            'updated_at' =>$today,
        ];   
        $dataImage = $this->storageUpload($request, 'image_path', 'post');
            if(!empty($dataImage)){
                $dataInsert['image_path'] = $dataImage['file_path'];
            }
            Post::find($id)->update($dataUpdate);
            $post = Post::find($id);
            
        return redirect('admin/post')->with('message', 'Update bài viết thành công');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function action($action, $id)
    {
        if($action){
            $post = Post::find($id);
            switch ($action)
            {
                case 'delete':
                    $this->deleteTrait($id, $post );
                    break;
                case 'active':
                    $post->status = $post->status ? 0 : 1;
                    $post->save();
                    break;  
            }
            
        }
        return redirect('admin/post');
    }

    public function import_csv(Request $request){
        $path = $request->file('file')->getRealPath();
        Excel::import(new ImportPost, $path);
        return back();
    }
    public function export_csv(){
        return Excel::download(new ExportPost , 'post.xlsx');
    }
}
