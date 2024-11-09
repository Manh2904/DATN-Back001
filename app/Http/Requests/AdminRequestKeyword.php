<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequestKeyword extends FormRequest
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
            'k_name'                 =>'required|min:2|max:180|unique:keyword,k_name',
            'k_description'          =>'required|min:2|max:180',

        ];
    }
    public function messages(){
        return [
            'k_name.required'        =>'Bạn chưa điền từ khóa',
            'k_name.min'             =>'Từ khóa phải nhiều hơn 2 kí tự',
            'k_name.max'             =>'Từ khóa phải ít hơn 180 kí tự',
            'k_name.unique'          =>'Từ khóa đã tồn tại',
            'k_description.required' =>'Bạn chưa điền mô tả từ khóa',
            'k_description.min'      =>'Mô tả từ khóa phải nhiều hơn 5 kí tự',
            'k_description.max'      =>'Mô tả từ khóa phải ít hơn 180 kí tự',
        ];
    }
}
