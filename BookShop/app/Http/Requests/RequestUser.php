<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestUser extends FormRequest
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
            'name'=>'required|unique:users,name'.$this->id,
            'image_path' => 'required',
            'email' => 'required',
            'password' => 'required',

        ];
    }
    public function messages()
    {
        return [
            'name.required' =>'Tên user không được để trống!',
            'name.unique' => 'Tên user đã tồn tại',
            'image_path.required' => 'Ảnh đại diện không được để trống!',
            'email.required' =>'Email không được để trống!',
            'password.required' =>'Password không được để trống!',

        ];
    }
}
