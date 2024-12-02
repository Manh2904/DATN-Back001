<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminCreateQtvRequest extends FormRequest
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
            'email'             =>'required|min:5|max:180|unique:admins,email',
            'name'              =>'required|min:5|max:180',
            'password'          =>'required|min:5|max:180|confirmed',

        ];
    }
    public function messages(){
        return[
            'email.required'    =>"Bạn cần điền email",
            'email.min'         =>"Email phải lớn hơn 5 ký tự",
            'email.max'         =>"Email phải ít hơn 180 ký tự",
            'email.unique'      =>"Email đã được đăng ký",

            'name.required'     =>"Bạn cần điền tên người dùng",
            'name.min'          =>"Tên người dùng phải lớn hơn 5 ký tự",
            'name.max'          =>"Tên người dùng phải ít hơn 180 ký tự",

            'password.required' =>"Bạn cần điền mật khẩu",
            'password.min'      =>"Mật khẩu phải lớn hơn 5 ký tự",
            'password.max'      =>"Mật khẩu phải ít hơn 180 ký tự",
            'password.confirmed'=>"Mật khẩu xác nhận không đúng",

        ];
    }
}
