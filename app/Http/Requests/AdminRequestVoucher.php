<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequestVoucher extends FormRequest
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
            'name'          =>'required|unique:vouchers,name,'.$this->id,
            'minimum'       =>'required|int',
            'amount'        =>'required|int',
            'expired_date'  =>'required'
        ];
    }
    public function messages(){
        return [
            'name.required' =>'Bạn cần điền tên thuộc tính sản phẩm',
            'name.unique'   =>'Voucher đã tồn tại',
            'minimum.required'      =>'Bạn cần điền giá trị tối thiểu',
            'minimum.int'           =>'Giá trị tối thiểu phải là số',
            'amount.required'       =>'Bạn cần điền giá trị đơn hàng tối thiểu',
            'amount.int'            =>'Số tiền giảm giá phải là số',
            'expired_date.required' =>'Bạn cần chọn ngày hết hạn'
        ];
    }
}
