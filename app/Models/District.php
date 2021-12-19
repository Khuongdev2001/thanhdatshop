<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    const CREATED_AT="created_at";
    const UPDATED_AT="updated_at";
    public $fillable=["id","district_id","district_name","created_at","updated_at"];
    public $primaryKey="id";
    public $table="districts";
}
