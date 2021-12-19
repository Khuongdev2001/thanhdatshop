<?php

namespace App\Http\Requests\Admin\Template\Menu;

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
            "menu_title" => "required|max:50",
            "parent_id"=>"nullable",
            "menu_link"=>"nullable",
            "sort"=>"nullable|integer|max:100"
        ];
    }

    public function messages()
    {
        return [
            "menu_title.required" => "Tiêu đề menu không được bỏ trống !",
            "menu_title.max" => "Tiêu đề tối đa 50 từ"
        ];
    }
}
