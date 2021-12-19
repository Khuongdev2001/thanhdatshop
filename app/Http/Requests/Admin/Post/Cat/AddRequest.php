<?php

namespace App\Http\Requests\Admin\Post\Cat;

use Illuminate\Foundation\Http\FormRequest;

class AddRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            "cat_title" => "required|max:50",
            "cat_slug"=>"nullable",
            "parent_id"=>"nullable",
            "sort"=>"nullable|integer|max:100"
        ];
    }

    public function messages()
    {
        return [
            "cat_title.required" => "Tiêu đề danh mục không được bỏ trống !",
            "cat_title.max" => "Tiêu đề tối đa 50 từ"
        ];
    }
}
