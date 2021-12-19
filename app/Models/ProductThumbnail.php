<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductThumbnail extends Model
{
    const CREATED_AT="created_at";
    const UPDATED_AT="updated_at";
    public $fillable=["thumbnail_id","product_id","url","cdn","created_at","updated_at"];
    public $primaryKey="thumbnail_id";
    public $table="product_thumbnails";
}
