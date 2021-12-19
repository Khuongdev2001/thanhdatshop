<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartProduct extends Model
{
    const CREATED_AT = "created_at";
    const UPDATED_AT = "updated_at";
    public $fillable = ["id", "product_id","cart_id","price","qty", "created_at", "updated_at"];
    public $primaryKey = "id";
    public $table = "cart_products";
}
