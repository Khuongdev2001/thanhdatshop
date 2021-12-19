<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    const CREATED_AT = "created_at";
    const UPDATED_AT = "updated_at";
    public $fillable = ["id", "user_id", "fullname","company","phone","province_id","district_id","commune_id","address","is_default","status","created_at","updateda_at"];
    public $primaryKey = "id";
    public $table = "user_address";
    public static function AddressModel(array $selectors=[]){
        return self::select(array_merge([
            "user_address.id",
            "fullname",
            "company",
            "phone",
            "address",
            "is_default"
        ],$selectors))->where("user_address.status",1);
    }
}
