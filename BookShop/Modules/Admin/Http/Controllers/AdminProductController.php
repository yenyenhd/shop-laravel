<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Requests\RequestProduct;
use Illuminate\Routing\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductTag;
use App\Models\Tag;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Components\Recusive;
use App\Traits\Delete;
use App\Traits\StorageImage;
use Illuminate\Support\Facades\Storage;
use Log;
use Auth;
use App\Imports\ImportCategory;
use App\Exports\ExportCategory;
use Excel;
use DB;



class AdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    use Delete;
    use StorageImage;
    public function index()
    {
        $products = Product::all();
        return view('admin::product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function getCategory($parent_id)
    {
        $data = Category::all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->Recusive($parent_id);
        return $htmlOption;
    }
    public function create()
    {
        $htmlOption = $this->getCategory($parent_id = '');
        return view('admin::product.add', compact('htmlOption'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(RequestProduct $request)
    {
        $dataInsert = [
            'name' => $request->name,
            'description' => $request->description,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'slug' => str::slug($request->name),
            'user_id' => Auth::id(),
            'quantity' => $request->quantity,
            'price' => $request->price,
            'sale' => $request->sale,
            'keyword' => $request->keyword,

        ];

        $dataImage = $this->storageUpload($request, 'avatar_path', 'product');
    
        if(!empty($dataImage)){
            $dataInsert['avatar_name'] = $dataImage['file_name'];
            $dataInsert['avatar_path'] = $dataImage['file_path'];
        }
        $product = Product::create($dataInsert);

        if($request->hasFile('image_path')){
            foreach($request->image_path as $fileItem){
                $dataImageDetail = $this->storageUploadMultiple($fileItem, 'product');
                $product->productImages()->create([
                    'image_path' => $dataImageDetail['file_path'],
                    'image_name' => $dataImageDetail['file_name'],
                ]);
            }
        }
        // Insert tag

        if(!empty($request->tag)){
            foreach($request->tag as $tag) {
                $tagInstance = Tag::firstOrCreate(['name' => $tag]);
                $tagIds[] = $tagInstance->id;
            }
        }
        $product->tags()->attach($tagIds);

        return redirect('admin/product/create')->with('message', 'Thêm sản phẩm thành công');
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
        $product = Product::find($id);
        $htmlOption = $this->getCategory($product->category_id);
        return view('admin::product.edit', compact('product', 'htmlOption'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $dataUpdate = [
                'name' => $request->name,
                'description' => $request->description,
                'content' => $request->content,
                'category_id' => $request->category_id,
                'slug' => str::slug($request->name),
                'user_id' => Auth::id(),
                'quantity' => $request->quantity,
                'price' => $request->price,
                'sale' => $request->sale,
                'keyword' => $request->keyword,

            ];

            $dataImage = $this->storageUpload($request, 'avatar_path', 'product');
            if(!empty($dataImage)){
                $dataUpdate['avatar_name'] = $dataImage['file_name'];
                $dataUpdate['avatar_path'] = $dataImage['file_path'];
            }
            Product::find($id)->update($dataUpdate);
            $product =  Product::find($id);

            if($request->hasFile('image_path')){
                $this->productImage->where('product_id', $id)->delete();
                foreach($request->image_path as $fileItem){
                    $dataImageDetail = $this->storageUploadMultiple($fileItem, 'product');
                    $product->productImages()->create([
                        'image_path' => $dataImageDetail['file_path'],
                        'image_name' => $dataImageDetail['file_name'],
                    ]);
                }
            }

            // Insert tag

            if(!empty($request->tag)){
                foreach($request->tag as $tag) {
                    $tagInstance = Tag::firstOrCreate(['name' => $tag]);
                    $tagIds[] = $tagInstance->id;
                }
            }
            $product->tags()->sync($tagIds);
            DB::commit();
            return redirect('admin/product')->with('message', 'Update sản phẩm thành công');
        } catch (\Exception $exception) {
            DB::rollback();
            Log::error('Message: ' . $exception->getMessage(). 'Line: '.$exception->getLine());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function action($action, $id)
    {
        if($action){
            $product = Product::find($id);
            switch ($action)
            {
                case 'delete':
                    $this->deleteTrait($id, $product );
                    break;
                case 'active':
                    $product->status = $product->status ? 0 : 1;
                    $product->save();
                    break;
                case 'product_hot':
                    $product->hot = $product->hot ? 0 : 1;
                    $product->save();
                    break;
            }

        }
        return redirect('admin/product');
    }
}
