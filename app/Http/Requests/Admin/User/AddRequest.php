<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class AddRequest extends FormRequest
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
            "fullname"=>"required|min:5|max:50",
            "email"=>"nullable|email|min:5|max:50|unique:users",
            "password"=>"required|min:5|max:50",
            "password_confirm"=>"same:password",
            "phone"=>"nullable|min:5|max:50",
            "provice"=>"nullable|max:50",
            "district"=>"nullable|max:50",
            "address"=>"nullable|max:500",
            "level"=>"nullable|in:0,1,2",
        ];
    }
    public function messages()
    {
        return
        [
            "fullname.required"=>"Không Được Để Trống Họ Và Tên!",
            "email.unique"=>"Email đã tồn tại hệ thống !",  
        ];
    }
}
