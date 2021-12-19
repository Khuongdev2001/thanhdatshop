<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    const CREATED_AT="created_at";
    const UPDATED_AT="updated_at";
    public $fillable=["id","province_id","province_name","created_at","updated_at"];
    public $primaryKey="id";
    public $table="provinces";
}
