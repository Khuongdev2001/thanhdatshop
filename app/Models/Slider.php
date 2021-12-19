<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    const CREATED_AT = "created_at";
    const UPDATED_AT = "updated_at";
    public $fillable = ["slider_id", "user_id", "slider_status", "slider_thumbnail", "slider_type", "slider_link", "created_at", "updated_at", "deleted_at"];
    public $primaryKey = "slider_id";
    public $table = "sliders";

    public static function getSliderAdmins()
    {
        $sliders = self::select("slider_id", "sort", "slider_thumbnail", "slider_link", "slider_type", "fullname", "slider_status", "created_at")
            ->leftJoin("users", "sliders.user_id", "=", "users.user_id")
            ->where("slider_status", "<>", -1)->get();
        return $sliders;
    }

    public static function getSliderModel(array $selects = [])
    {
        $sliderModel = self::select(array_merge([
            "slider_link",
            "slider_thumbnail"
        ]), $selects)
            ->where("slider_status", 1);
        return $sliderModel;
    }
}
