<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    const CREATED_AT = "created_at";
    const UPDATED_AT = "updated_at";
    public $fillable = ["cart_id", "user_id", "code", "address", "total_price", "total_product", "total_qty", "cart_status","buyer_fullname", "buyer_email","buyer_phone", "created_at", "updated_at"];
    public $primaryKey = "cart_id";
    public $table = "carts";

    public static function cartModel(array $selects = [])
    {
        $cartModel = self::select(array_merge(
            [
                "carts.cart_id",
                "code",
                "address",
                "buyer_fullname",
                "buyer_email",
                "buyer_phone",
                "total_price",
                "total_qty",
                "total_product",
                "cart_status"
            ],
            $selects
        ));
        return $cartModel;
    }
}
