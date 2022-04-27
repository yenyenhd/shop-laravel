<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestPost extends FormRequest
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
            'title'=>'required|unique:posts,title'.$this->id,
            'image_path' => 'required',
            'description' => 'required',
            'content' => 'required',
            'keyword' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'title.required' =>'Tên bài viết không được để trống!',
            'title.unique' => 'Tên bài viết đã tồn tại',
            'image_path.required' =>'Ảnh bài viết không được để trống!',
            'description.required' =>'Mô tả bài viết không được để trống!',
            'content.required' =>'Nội dung bài viết không được để trống!',
            'keyword.required' =>'Từ khóa không được để trống!',
        ];
    }
}
