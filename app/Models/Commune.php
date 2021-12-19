<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    const CREATED_AT="created_at";
    const UPDATED_AT="updated_at";
    public $fillable=["id","commune_id","commune_name","created_at","updated_at"];
    public $primaryKey="id";
    public $table="communes";
}
