<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSocial extends Model
{
    const CREATED_AT = "created_at";
    const UPDATED_AT = "updated_at";
    public $fillable = ["id", "user_id", "social_type_id", "social_id","is_primary","created_at", "updated_at", "deleted_at"];
    public $primaryKey = "id";
    public $table = "user_socials";
}
