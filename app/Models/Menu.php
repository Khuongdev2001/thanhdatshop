<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    const CREATED_AT = "created_at";
    const UPDATED_AT = "updated_at";
    public $fillable = ["menu_id", "menu_title", "user_id", "menu_status", "parent_id", "created_at", "sort"];
    public $primaryKey = "menu_id";
    public $table = "menus";

    public static function getModel(array $selectors = [])
    {
        $model = self::select(array_merge([
            "menu_link",
            "parent_id",
            "sort",
        ], $selectors))->where("menu_status","<>", -1);
        return $model;
    }
}
