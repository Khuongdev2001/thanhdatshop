<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatProduct extends Model
{
    const CREATED_AT = "created_at";
    const UPDATED_AT = "updated_at";
    public $fillable = ["cat_id", "cat_title", "cat_slug", "set_home", "user_id", "cat_status", "parent_id", "created_at", "sort", "updated_at", "deleted_at", "cat_thumbnail"];
    public $primaryKey = "cat_id";
    public $table = "cat_products";

    public function getChildrens()
    {
        return CatProduct::select("cat_thumbnail","cat_id","cat_title")->where("cat_status", 1)->where("parent_id", $this->cat_id)->get();
    }

    public static function getCatModel(array $selects = [])
    {
        $catModel = self::select(
            array_merge([
                "cat_id",
                "cat_title",
                "cat_slug",
                "cat_thumbnail"
            ], $selects)
        )->where("cat_status", true);

        return $catModel;
    }
}
