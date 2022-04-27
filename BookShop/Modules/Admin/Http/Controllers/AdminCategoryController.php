<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Requests\RequestCategory;
use Illuminate\Routing\Controller;
use App\Components\Recusive;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Traits\Delete;
use App\Imports\ImportCategory;
use App\Exports\ExportCategory;
use Excel;


class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    use Delete;
    public function index()
    {
        $categories = Category::all();
        return view('admin::category.index', compact('categories'));
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
        return view('admin::category.add', compact('htmlOption'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(RequestCategory $request)
    {

        $category = new Category;
        $category->name = $request->name;
        $category->slug = str::slug($request->name);
        $category->parent_id = $request->parent_id;
        $category->description = $request->description;
        $category->keyword = $request->keyword;
        $category->save();
        return redirect('admin/category/create')->with('message', 'Thêm danh mục thành công');
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $category = Category::find($id);
        $htmlOption = $this->getCategory($category->parent_id);
        return view('admin::category.edit', compact('htmlOption', 'category'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {

        $cate = Category::find($id);
        $cate->name = $request->name;
        $cate->slug = str::slug($request->name);
        $cate->parent_id = $request->parent_id;
        $cate->description = $request->description;
        $cate->keyword = $request->keyword;
        $cate->save();
        return redirect('admin/category/')->with('message', 'Cập nhật danh mục thành công');

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */

    public function action($action, $id)
    {
        if($action){
            $category = Category::find($id);
            switch ($action)
            {
                case 'delete':
                    $this->deleteTrait($id, $category );
                    break;
                case 'active':
                    $category->status = $category->status ? 0 : 1;
                    $category->save();
                    break;
            }

        }
        return redirect('admin/category');
    }
    public function import_csv(Request $request){
        $path = $request->file('file')->getRealPath();
        Excel::import(new ImportCategory, $path);
        return back();
    }
    public function export_csv(){
        return Excel::download(new ExportCategory , 'category.xlsx');
    }
}
