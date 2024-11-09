<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;

class ApiUpdateRequest extends BaseRequest
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
            'name' => 'required|string|between:2,100',
            'phone' => 'required|string|min:6',
            'address' => 'required',
            'gender' => 'required',
        ];
    }
    public function messages(){
        return [
        ];
    }
}
