<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequestAttibute extends FormRequest
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
            'name'        =>'required|max:7',
            'menu_id' =>'required'
        ];
    }
    public function messages(){
        return [
            'name.required' =>'Bạn cần điền tên biến thể',
            'max.required' =>'Bạn cần điền < 7 ký tự',
            'menu_id.required'   =>'Bạn cần chọn danh mục biến thể'
        ];
    }
}
