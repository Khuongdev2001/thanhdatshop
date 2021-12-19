<?php

namespace App\Http\Requests\Admin\Slider;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            "file" => ["image","mimes:jpeg,png","mimetypes:image/jpeg,image/png","max:1024",Rule::requiredIf(function(){
                return !request("imgs");
            })],
            "slider_status"=>"nullable|in:0,1",
            "slider_link"=>"nullable",
            "slider_type"=>"nullable|in:0,1",
            "sort" => "nullable|integer|max:100",
        ];
    }
}
