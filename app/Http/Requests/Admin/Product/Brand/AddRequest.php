<?php

namespace App\Http\Requests\Admin\Product\Brand;

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
            "brand_name" => "required|max:50",
            "sort" => "nullable|integer|max:100",
            "brand_link"=>"nullable|max:100",
            "file" => "nullable|image|mimes:jpeg,png|mimetypes:image/jpeg,image/png|max:1024"
        ];
    }
}
