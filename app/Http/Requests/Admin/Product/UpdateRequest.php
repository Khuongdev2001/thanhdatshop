<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
        $maxNumFileValidate=new \App\Rules\maxNumFile(10);
        return [
            "product_title"=>"required|max:200",
            "cat_id"=>["nullable",Rule::exists("cat_products","cat_id")->where(function ($query){
                return $query->where("cat_status",1);
            })],
            "files.*"=>"image|mimes:jpeg,png|mimetypes:image/jpeg,image/png|max:1024",
            "files"=>[$maxNumFileValidate],
            "product_description"=>"nullable",
            "product_content"=>"nullable",
            "product_status"=>"in:0,1",
            "imgs"=>[$maxNumFileValidate]
        ];
    }
}
