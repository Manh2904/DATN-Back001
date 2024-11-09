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
            'atb_name'        =>'required|unique:attributes,atb_name,'.$this->id,
            'atb_type'        =>'required',
            'atb_category_id' =>'required'
        ];
    }
    public function messages(){
        return [
            'atb_name.required' =>'Bạn cần điền tên thuộc tính sản phẩm',
            'atb_name.unique'   =>'Tên thuộc tính đã tồn tại',
            'atb_type'          =>'Bạn cần chọn thể loại thuộc tính',
            'atb_category_id'   =>'Bạn cần chọn thể loại sản phẩm'
        ];
    }
}
