<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Countrys extends Model
{
    const CREATED_AT="created_at";
    const UPDATED_AT="updated_at";
    public $fillable=["id","country_name","province_id","district_id","commune_id","type","created_at","updated_at"];
    public $primaryKey="id";
    public $table="countrys";
}
