<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Slider;
use App\Models\Brand;
use App\Models\CatProduct as Cat;
use App\Models\CommentProduct;
use App\Models\Product;

class ProductController extends Controller
{
    public function getIndex()
    {
        /* Get Sliders Type 1 */
        $sliders = Slider::getSliderModel();
        $sliderBigs = $sliders->where("slider_type", 1)->get();
        /* Get Cats */
        $cats = Cat::getCatModel()->where("parent_id", 0)->get();
        /* Get Brands */
        $brands = Brand::getBrandModel()->get();
        return view("user.product.index", compact("sliderBigs", "cats", "brands"));
    }

    /* Handle Show View Product Details */
    public function getDetails($id, $slug)
    {
        $product = Product::getModelProduct([
            "product_content",
            "product_description"
        ])->where("products.product_id", $id)->first();
        $productImages = $product->images;
        $catFamily = [$product->cat_id];
        $cats = Cat::where("cat_status", 1)
            ->where("parent_id", $product->cat_id)->pluck('cat_id')->toArray();
        $productSames = Product::getModelProduct()
            ->whereIn("products.cat_id", array_merge($cats, $catFamily))
            ->where("products.product_id", "<>", $product->product_id)
            ->get();

        $this->handleSetProductSeens($product->product_id);
        return view("user.product.details", compact("product", "productImages", "productSames"));
    }

    private function handleGetProductSeens()
    {
        return session("idProductSeens", []);
    }

    private function handleSetProductSeens($value)
    {
        /* Only Show 8 Products Seen */
        session()->forget("idProductSeens.8");
        $idSessions = session("idProductSeens", []);
        if (!in_array($value, $idSessions)) {
            session(["idProductSeens"
            => array_merge([$value], $idSessions)]);
        }
    }
    /* Handle Add Comment  */

    public function postAddComment(\App\Http\Requests\Product\Comment\AddRequest $request)
    {
        $commentRq = $request->validated(); 
        if (isset($commentRq["parent_id"])) {
            /* Get Comment by id with parent_id */
            $commentParent = CommentProduct::find($commentRq["parent_id"]);
            $commentRq["comment_tree"] = $commentParent->comment_tree
            ? $commentParent->comment_tree
            : $commentParent->comment_id;
            
            $commentRq["parent_id"] = (int) $commentRq["parent_id"];
        }
        $commentRq["product_id"] = $commentRq["module_id"];
        $commentRq["user_id"] = Auth::id();
        $comment = CommentProduct::create($commentRq);
        return response()->json([
            "status" => true,
            "data" => $comment,
            "code" => 200
        ], 200);
    }

    /* Handle Get Comment */
    public function getComment(Request $request)
    {
        $comments = DB::table("comment_products as parents")
            ->select([
                "comment_id",
                "comment_content",
                "parents.parent_id",
                "fullname",
                "parents.user_id",
                "parents.created_at",
                "avatar",
                "avatar_cdn",
                "parents.created_at",
                DB::raw("
                    (select count(`comment_id`) from `comment_products`
                    where `comment_tree` = `parents`.`comment_id`  and `comment_status` = true)
                    as `count_comment_children`
                ")
            ])
            ->leftJoin("users", "users.user_id", "parents.user_id")
            ->where("comment_status", true)
            ->where("product_id", $request->module_id);
        /* Handle Get Comment Children */
        $comments = $comments->where("comment_tree", $request->parent_id ?? null);
        $comments = $comments->paginate(10);
        $queryUrl = http_build_query($request->except("page"));
        return response()->json([
            "status" => true,
            "code" => 200,
            "data" => $comments,
            "next_page_url" => $comments->nextPageUrl()
                ? $comments->nextPageUrl() . "&" . $queryUrl
                : null,
        ]);
    }
}
