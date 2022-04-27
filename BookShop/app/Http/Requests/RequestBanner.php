<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestBanner extends FormRequest
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
            'name'=>'required|unique:banners,name'.$this->id,
            'image_path' => 'required',

        ];
    }
    public function messages()
    {
        return [
            'name.required' =>'Tên banner không được để trống!',
            'name.unique' => 'Tên banner đã tồn tại',
            'image_path.required' =>'Hình banner không được để trống!',

        ];
    }
}
