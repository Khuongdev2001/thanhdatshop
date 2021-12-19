<?php

namespace App\Http\Requests\User\Address;

use Illuminate\Database\Eloquent\Model;
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
            "fullname" => "required|min:2|max:100",
            "company" => "nullable|max:100",
            "phone" => "nullable|min:5|max:50",
            "province_id" => ["required",function ($attribute, $value, $fail) {
                $check = \App\Models\User::checkCoutry(
                    request("province_id"),
                    request("district_id"),
                    request("commune_id")
                );
                if (!$check) {
                    $fail("Lỗi");
                }
            }],
            "district_id"=>"nullable",
            "commune_id"=>"nullable",
            "address"=>"required|max:200|min:2",
            "is_default"=>"nullable|in:0,1"
        ];
    }
}
