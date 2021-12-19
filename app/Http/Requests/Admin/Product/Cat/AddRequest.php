<?php

namespace App\Http\Requests\Admin\Product\Cat;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Whoops\Run;

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
            "cat_title" => "required|max:50",
            "sort" => "nullable|integer|max:100",
            "parent_id" => ["nullable",Rule::exists("cat_products","cat_id")->where(function ($query){
                return $query->where("cat_status",1);
            })],
            "file" => "nullable|image|mimes:jpeg,png|mimetypes:image/jpeg,image/png|max:1024"
        ];
    }
}
