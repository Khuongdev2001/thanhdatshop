<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    const CREATED_AT = "user_created_at";
    const UPDATED_AT = "user_updated_at";
    public $fillable = ["user_id", "email", "fullname", "password_hash", "phone", "province_id", "district_id", "commune_id", "address", "facebook_id", "google_id", "social_default", "avatar", "avatar_cdn", "user_active_mail", "level", "user_created_at", "user_updated_at"];
    public $primaryKey = "user_id";
    public $table = "users";
    protected $hidden = [
        'password', 'password_hash',
    ];

    public static function createToken()
    {
        return "My_Pham_Thanh_Dat_" . Hash::make(time());
    }

    public static function checkCoutry($provinceId, $districtId, $communeId)
    {
        $countrys = DB::table('districts')
            ->leftJoin("communes", "districts.district_id", "communes.district_id")
            ->where("districts.province_id", $provinceId)
            ->where("districts.district_id", $districtId)
            ->where("communes.commune_id", $communeId)
            ->count("districts.id");
        return $countrys;
    }

    public function getAddress()
    {
        return $this->hasMany("App\Models\UserAddress", "user_id")
            ->select([
                "fullname",
                "phone",
                "address",
                "province_name",
                "district_name",
                "commune_name"
            ])
            ->leftJoin("provinces", "provinces.province_id", "user_address.province_id")
            ->leftJoin("districts", "districts.district_id", "user_address.district_id")
            ->leftJoin("communes", "communes.commune_id", "user_address.commune_id")  
            ->where("status",true) 
            ->where("is_default",true);
    }
}
