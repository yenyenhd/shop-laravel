<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Province;
use App\Models\District;
use App\Models\Commune;
use App\Models\Fee;


class AdminDeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $province = Province::orderby('matp', 'ASC')->get();
        return view('admin::delivery.add', compact('province'));
    }

    public function select_delivery(Request $request)
    {
        $data = $request->all();
    	if($data['action']){
    		$output = '';
    		if($data['action']=="province"){
    			$select_district = District::where('matp',$data['ma_id'])->orderby('maqh','ASC')->get();
    				$output.='<option>---Chọn quận huyện---</option>';
    			foreach($select_district as $key => $district){
    				$output.='<option value="'.$district->maqh.'">'.$district->name.'</option>';
    			}

    		}else{
    			$select_commune = Commune::where('maqh',$data['ma_id'])->orderby('xaid','ASC')->get();
    			    $output.='<option>---Chọn xã phường---</option>';
    			foreach($select_commune as $key => $com){
    				$output.='<option value="'.$com->xaid.'">'.$com->name.'</option>';
    			}
    		}
            echo $output;
    		
    	}
    }
    public function create(Request $request)
    {
        Fee::create([
            'matp' => $request->province,
            'maqh' => $request->district,
            'xaid' => $request->commune,
            'transport_fee' => $request->transport_fee,
        ]);
    }
    
	public function select_feeship(){
		$fee = Fee::orderby('id','DESC')->get();
		$output = '';
		$output .= '<div class="table-responsive">  
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thread> 
					<tr>
						<th>STT</th>
						<th>Tên thành phố</th>
						<th>Tên quận huyện</th> 
						<th>Tên xã phường</th>
						<th>Phí ship</th>
					</tr>  
				</thread>
				<tbody>
				';
				foreach($fee as $key => $feeItem){

				$output.='
					<tr>
						<td>'.$feeItem->id.'</td>
						<td>'.$feeItem->province->name.'</td>
						<td>'.$feeItem->district->name.'</td>
						<td>'.$feeItem->commune->name.'</td>
						<td contenteditable data-feeship_id="'.$feeItem->id.'" class="fee_feeship_edit">'.number_format($feeItem->transport_fee,0,',','.').'</td>
					</tr>
					';
				}

				$output.='		
				</tbody>
				</table></div>
				';
				echo $output;

		
	}
    public function update_delivery(Request $request){
		$data = $request->all();
		$fee = Fee::find($data['feeship_id']);
		$fee_value = rtrim($data['fee_value'],'.');
		$fee->transport_fee = $fee_value;
		$fee->save();

	}
}
