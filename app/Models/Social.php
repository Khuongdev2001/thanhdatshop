<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Social extends Model
{
    const CREATED_AT = "created_at";
    const UPDATED_AT = "updated_at";
    public $fillable = ["social_type_id", "name", "image", "created_at", "updated_at", "deleted_at"];
    public $primaryKey = "social_type_id";
    public $table = "socials";

    public static function getSocials($userId){
        return self::select("name","image","is_primary","socials.social_type_id","social_id")
        ->leftJoin("user_socials",function($join)use($userId){
            $join->on('user_socials.social_type_id','=','socials.social_type_id');
            $join->on("user_id",DB::raw($userId));
        })
        ->get();
    }
}
