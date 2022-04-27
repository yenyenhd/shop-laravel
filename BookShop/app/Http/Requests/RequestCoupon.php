<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestCoupon extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required',
            'code' => 'required',
            'number' => 'required',
            'condition' => 'required',
            'sale' => 'required',

        ];
    }
    public function messages()
    {
        return [
            'name.required' =>'Tên coupon không được để trống!',
            'code.required' =>'Mã coupon không được để trống!',
            'time.required' =>'Số lượng không được để trống!',
            'condition.required' =>'Tính năng mã không được để trống!',
            'sale.required' =>'% hoặc số tiền giảm không được để trống!',
        ];
    }
}
