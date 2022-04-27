<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestProduct extends FormRequest
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
            'name'=>'required|unique:products,name'.$this->id,
            'avatar_path' => 'required',
            'description' => 'required',
            'content' => 'required',
            'category_id' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'sale' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' =>'Tên sản phẩm không được để trống!',
            'name.unique' => 'Tên sản phẩm đã tồn tại',
            'avatar_path.required' =>'Ảnh sản phẩm không được để trống!',
            'description.required' =>'Mô tả sản phẩm không được để trống!',
            'content.required' =>'Nội dung sản phẩm không được để trống!',
            'category_id.required' =>'Loại sản phẩm không được để trống!',
            'quantity.required' =>'Số lượng không được để trống!',
            'price.required' =>'Giá không được để trống!',
            'sale.required' =>'% khuyến mại không được để trống!',

        ];
    }
}
