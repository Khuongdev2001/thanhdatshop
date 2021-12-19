<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    const CREATED_AT = "created_at";
    const UPDATED_AT = "updated_at";
    public $fillable = ["product_id", "product_title", "product_description", "product_content", "product_slug", "user_id", "price", "price_old", "product_status", "cat_id", "product_type", "brand_id", "created_at", "updated_at", "deleted_at"];
    public $primaryKey = "product_id";
    public $table = "products";

    public static function getproductAdmins()
    {
        $products = self::select("products.product_id", "brand_name", "url as product_thumbnail", "product_title", "cat_title", "fullname", "product_status", "price", "products.created_at")
            ->leftJoin("cat_products", function ($join) {
                $join->on("products.cat_id", "=", "cat_products.cat_id");
                /* Remove Cat Status = -1 Deleted */
                $join->on("cat_products.cat_status", "=", DB::raw(1));
            })
            ->leftJoin("users", "users.user_id", "=", "products.user_id")
            ->leftJoin("product_thumbnails", "products.product_id", "=", "product_thumbnails.product_id")
            ->leftJoin("brands", "brands.brand_id", "products.brand_id")
            ->where("product_status", "<>", -1)
            /* So Product_thumbnails Very Image */
            ->groupBy("products.product_id")
            ->get();
        return $products;
    }

    public function images()
    {
        $asset = asset(null);
        return $this->hasMany("App\Models\ProductThumbnail", "product_id")
            ->select("thumbnail_id as id", DB::raw("CONCAT('${asset}',`url`) as `src`"));
    }

    public static function getModelProduct(array $selects=[])
    {
        $product = Product::select(
            array_merge(
                [
                    "products.product_id",
                    "product_title",
                    "price",
                    "price_old",
                    "cat_slug",
                    "cat_title",
                    "products.cat_id",
                    "brand_name",
                    "url",
                    "product_type",
                    "product_slug"
                ],
                $selects
            )
        )
            ->where("product_status", 1)
            ->leftJoin("cat_products", "cat_products.cat_id", "=", "products.cat_id")
            ->leftJoin("brands", "brands.brand_id", "=", "products.brand_id")
            ->leftJoin("product_thumbnails", "products.product_id", "=", "product_thumbnails.product_id")
            ->groupBy("products.product_id");
        return $product;
    }
}
