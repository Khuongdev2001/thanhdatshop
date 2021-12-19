<?php

namespace App\Http\Requests\Post\Comment;

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
            "comment_content" => "required|max:300",
            "module_id" => [Rule::exists("posts", "post_id")
                ->where(function ($query) {
                    $query->where("post_status", true);
                })],
            "parent_id" => ["nullable", Rule::exists("comment_posts", "comment_id")
                ->where(function ($query) {
                    $query->where("comment_status", true);
                })]
        ];
    }
}
