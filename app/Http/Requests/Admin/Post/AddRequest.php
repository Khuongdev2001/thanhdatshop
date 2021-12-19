<?php

namespace App\Http\Requests\Admin\Post;

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
            "post_title"=>"required|max:200",
            "cat_id"=>"nullable|exists:cat_posts,cat_id",
            "file"=>"nullable|image|mimes:jpeg,png|mimetypes:image/jpeg,image/png|max:1024",
            "post_description"=>"nullable",
            "post_content"=>"nullable",
            "post_status"=>"in:0,1"
        ];
    }
}
