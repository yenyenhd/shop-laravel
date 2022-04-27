<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class RequestCustomer extends FormRequest
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
            'name' => 'required',
            'username'=>'required|unique:customers,username'.$this->id,
            'phone' => 'required',
            'email' => 'required',
            'password'=>'required|min:6|max:32',
            'passwordAgain'=>'required|same:password',
            'g-recaptcha-response' => new Captcha(), 
        ];
    }
    public function messages()
    {
        return [
            'name.required' =>'Họ tên không được để trống!',
            'username.required' =>'Tên đăng nhập không được để trống!',
            'name.unique' => 'Tên đăng nhập đã tồn tại',
            'phone.required' => 'Số điện thoại không được để trống!',
            'email.required' =>'Email không được để trống!',
            'password.required' =>'Mật khẩu không được để trống!',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'password.max' => 'Mật khẩu chỉ được tối đa 32 ký tự',
            'passwordAgain.required' => 'Bạn chưa nhập lại mật khẩu',
            'passwordAgain.same'=> 'Mật khẩu nhập lại không đúng',
        ];
    }
}
