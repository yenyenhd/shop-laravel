<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Requests\RequestSlider;
use App\Models\Slider;
use Illuminate\Support\Str;
use App\Traits\Delete;
use App\Traits\StorageImage;
use Illuminate\Support\Facades\Storage;
use Log;
use App\Imports\ImportSlider;
use App\Exports\ExportSlider;
use Excel;



class AdminSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    use StorageImage;
    use Delete;
    public function index()
    {
        $sliders = Slider::all();
        return view('admin::slider.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('admin::slider.add');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(RequestSlider $request)
    {
        try {
            $dataImage = $this->storageUpload($request, 'image_path', 'slider');
            $slider= Slider::create([
                'name' => $request->name,
                'description' => $request->description,
                'image_name' => $dataImage['file_name'],
                'image_path' => $dataImage['file_path'],
            ]);

            return redirect('admin/slider/create')->with('message', 'Thêm slider thành công');
        } catch (\Exception $exception) {
            Log::error('Message: ' . $exception->getMessage(). 'Line: '.$exception->getLine());
        }
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
        $slider = Slider::find($id);
        return view('admin::slider.edit', compact('slider'));
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
            $dataImage = $this->storageUpload($request, 'image_path', 'slider');
            if(!empty($dataImage)){
                $dataUpdate['image_name'] = $dataImage['file_name'];
                $dataUpdate['image_path'] = $dataImage['file_path'];
            }
            $dataUpdate = [
                'name' => $request->name,
                'description' => $request->description,
            ];
            Slider::find($id)->update($dataUpdate);
            return redirect('admin/slider')->with('message', 'Update slider thành công');
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
            $slider = Slider::find($id);
            switch ($action)
            {
                case 'delete':
                    $this->deleteTrait($id, $slider );
                    break;
                case 'active':
                    $slider->status = $slider->status ? 0 : 1;
                    $slider->save();
                    break;
            }

        }
        return redirect('admin/slider');
    }
     public function import_csv(Request $request){
        $path = $request->file('file')->getRealPath();
        Excel::import(new ImportSlider, $path);
        return back();
    }
    public function export_csv(){
        return Excel::download(new ExportSlider , 'slider.xlsx');
    }
}
