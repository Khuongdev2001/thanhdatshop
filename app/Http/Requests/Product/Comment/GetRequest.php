<?php

namespace App\Http\Requests\Product\Comment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GetRequest extends FormRequest
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
            "comment_id"=>"nullable",
            "module_id" => [Rule::exists("products", "product_id")
            ->where(function ($query) {
                $query->where("product_status", true);
            })],
        ];
    }
}
