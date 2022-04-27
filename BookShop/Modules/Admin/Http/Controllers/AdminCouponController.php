<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Requests\RequestCoupon;
use Illuminate\Routing\Controller;
use App\Models\Coupon;
use App\Traits\Delete;
use App\Imports\ImportCoupon;
use App\Exports\ExportCoupon;
use Excel;

class AdminCouponController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    use Delete;
    public function index()
    {
        $coupons = Coupon::all();
        return view('admin::coupon.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('admin::coupon.add');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(RequestCoupon $request)
    {
        $coupon = new Coupon;
        $coupon->name = $request->name;
        $coupon->code = $request->code;
        $coupon->number = $request->number;
        $coupon->condition = $request->condition;
        $coupon->sale = $request->sale;
        $coupon->save();
        return redirect('admin/coupon/create')->with('message', 'Thêm mã giảm giá thành công');
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
        $coupon = Coupon::find($id);
        return view('admin::coupon.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $coupon = Coupon::find($id);
        $coupon->name = $request->name;
        $coupon->code = $request->code;
        $coupon->number = $request->number;
        $coupon->condition = $request->condition;
        $coupon->sale = $request->sale;
        $coupon->save();
        return redirect('admin/coupon/')->with('message', 'Cập nhật mã giảm giá thành công');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $coupon = Coupon::find($id);
        $this->deleteTrait($id, $coupon );
        return redirect('admin/coupon');
    }

    public function import_csv(Request $request){
        $path = $request->file('file')->getRealPath();
        Excel::import(new ImportCoupon, $path);
        return back();
    }
    public function export_csv(){
        return Excel::download(new ExportCoupon , 'coupon.xlsx');
    }
}
