<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CatProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /* Handle Show Products Api */
    public function getProducts(Request $request)
    {
        $products = Product::getModelProduct([
            DB::raw("FLOOR((`price_old`-`price`)/`price_old`*100) as `percer`")
        ]);
        $products->where("product_title", "LIKE", "%{$request->search}%");
        /* Query Category All Chidlren */
        if ($request->cat_id) {
            $cat_ids = explode(",", $request->cat_id);
            /* Get Cat Children */
            $catChildrends = CatProduct::where("cat_status", 1)
                ->whereIn("parent_id", $cat_ids)->pluck('cat_id')->toArray();

            $products->whereIn("products.cat_id", array_merge($catChildrends, $cat_ids));
        }
        /*  Query Between */
        if ($request->price) {
            $price = explode(",", $request->price);
            $products->whereBetween("price", [$price[0] ?? null, $price[1] ?? null]);
        }
        $products->groupBy("products.product_id");
        /* Handle Sort Price */
        $checkSort = ["asc", "desc"];
        if (in_array($request->price_sort, $checkSort)) {
            $products->orderBy("price",$request->price_sort);
        }
        $productsPaginate = $products->paginate(12);
        /* So Default No Add Paramater Url */
        $queryUrl = http_build_query($request->except("page"));
        return response()->json(
            [
                "status" => true,
                "data" => $productsPaginate,
                "code" => 200,
                "next_page_url" => $productsPaginate->nextPageUrl()
                    ? $productsPaginate->nextPageUrl() . "&" . $queryUrl
                    : null,
                "asset" => asset("")
            ],
            200
        );
    }
}
