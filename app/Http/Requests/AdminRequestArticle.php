<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequestArticle extends FormRequest
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
            'a_name'                  =>'required|unique:articles,a_name',
            'a_description'           =>'required',
            'a_menu_id'               =>'required',
            'a_content'               =>'required'
        ];
    }

    public function messages(){
        return [
            'a_name.required'         =>'Tên bài viết không được để trống',
            'a_name.unique'           =>'Bài viết đã tồn tại',
            'a_description.required'  =>'Mô tả bài viết không được để trống',
            'a_menu_id.required'     =>"Bạn chưa chọn thể loại bài viết",
            'a_content.required'      =>'Bạn chưa điền nội dung bài viết'
        ];
    }
}
