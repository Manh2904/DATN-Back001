<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequestNewPassword extends FormRequest
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
            'confirm_password'    =>'required|same:password',
            'password'            =>'required',
        ];
    }
    public function messages(){
        return [
            'password.required' =>"Bạn cần điền mật khẩu",
            'confirm_password.required' =>"Bạn cần điền xác nhận mật khẩu",
            'confirm_password.same' =>"Xác nhận mật khẩu không khớp",
        ];
    }
}
