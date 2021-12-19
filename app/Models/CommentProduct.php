<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommentProduct extends Model
{
    const CREATED_AT = "created_at";
    const UPDATED_AT = "updated_at";
    public $fillable = ["comment_id", "user_id", "comment_content", "product_id", "comment_status","comment_tree", "parent_id","updated_at", "created_at"];
    public $primaryKey = "comment_id";
    public $table = "comment_products";
}
