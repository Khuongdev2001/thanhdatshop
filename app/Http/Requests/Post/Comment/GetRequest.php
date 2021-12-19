<?php

namespace App\Http\Requests\Post\Comment;

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
        return false;
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
            "module_id" => [Rule::exists("posts", "post_id")
            ->where(function ($query) {
                $query->where("post_status", true);
            })],
        ];
    }
}
