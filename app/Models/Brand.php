<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    const CREATED_AT = "created_at";
    const UPDATED_AT = "updated_at";
    public $fillable = ["brand_id", "brand_name","brand_image", "brand_status","brand_link", "created_at", "sort", "updated_at", "deleted_at"];
    public $primaryKey = "brand_id";
    public $table = "brands";
    

    public static function getBrandModel(array $selects = [])
    {
        $brandModel = self::select(array_merge([
            "brand_id",
            "brand_name"
        ]), $selects)
            ->where("brand_status", 1);
        return $brandModel;
    }
}
