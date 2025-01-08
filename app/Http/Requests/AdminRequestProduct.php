<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequestProduct extends FormRequest
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
            'pro_name'                  =>'required',
            'pro_description'           =>'required',
            'pro_category'              =>'required',
            'pro_price'                 =>'required|max:10',
            'pro_content'               =>'required'
        ];
    }
    public function messages(){
        return [
            'pro_name.required'         =>'Tên sản phẩm không được để trống',
            'pro_description.required'  =>'Mô tả sản phẩm không được để trống',
            'pro_category.required'     =>"Bạn chưa chọn thể loại sản phẩm",
            'pro_price.required'        => 'Bạn chưa điền giá sản phẩm',
            'pro_price.max'        => 'Số tiền phải dưới 10 chữ số',
            'pro_content.required'      =>'Bạn chưa điền nội dung sản phẩm'
        ];
    }
}
