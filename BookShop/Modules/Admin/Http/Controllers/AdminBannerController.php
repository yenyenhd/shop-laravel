<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Requests\RequestBanner;
use Illuminate\Routing\Controller;
use App\Models\Banner;
use Illuminate\Support\Str;
use App\Traits\Delete;
use App\Traits\StorageImage;
use Illuminate\Support\Facades\Storage;
use Log;
use App\Imports\ImportBanner;
use App\Exports\ExportBanner;
use Excel;


class AdminBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    use StorageImage;
    use Delete;
    public function index()
    {
        $banners = Banner::all();
        return view('admin::banner.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('admin::banner.add');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(RequestBanner $request)
    {
        try {
            $dataImage = $this->storageUpload($request, 'image_path', 'banner');
            $banner= Banner::create([
                'name' => $request->name,
                'image_name' => $dataImage['file_name'],
                'image_path' => $dataImage['file_path'],
            ]);

            return redirect('admin/banner/create')->with('message', 'Thêm banner thành công');
        } catch (\Exception $exception) {
            Log::error('Message: ' . $exception->getMessage(). 'Line: '.$exception->getLine());
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $banner = Banner::find($id);
        return view('admin::banner.edit', compact('banner'));
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
            $dataImage = $this->storageUpload($request, 'image_path', 'banner');
            if(!empty($dataImage)){
                $dataUpdate['image_name'] = $dataImage['file_name'];
                $dataUpdate['image_path'] = $dataImage['file_path'];
            }
            $dataUpdate = [
                'name' => $request->name,
            ];
            Banner::find($id)->update($dataUpdate);
            return redirect('admin/banner')->with('message', 'Update banner thành công');
        } catch (\Exception $exception) {
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
            $banner = Banner::find($id);
            switch ($action)
            {
                case 'delete':
                    $this->deleteTrait($id, $banner );
                    break;
                case 'active':
                    $banner->status = $banner->status ? 0 : 1;
                    $banner->save();
                    break;
            }

        }
        return redirect('admin/banner');
    }
     public function import_csv(Request $request){
        $path = $request->file('file')->getRealPath();
        Excel::import(new ImportBanner, $path);
        return back();
    }
    public function export_csv(){
        return Excel::download(new ExportBanner , 'banner.xlsx');
    }
}
