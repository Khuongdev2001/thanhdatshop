<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CatPost;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /* Handle Show Post Api */
    public function getPosts(Request $request)
    {
        $posts = Post::select(
            "post_title",
            "post_description",
            "posts.created_at",
            "posts.updated_at",
            "fullname",
            "post_thumbnail",
            "post_slug"
        );
        $posts->leftJoin("users", "users.user_id", "=", "posts.user_id");
        $posts->where("post_status", 1);
        $posts->where("post_title", "LIKE", "%{$request->search}%");
        if ($request->cat_id) {
            $idFilters = [$request->cat_id];
            /* Get Cat Children */
            $catChildrends = CatPost::where("cat_status", 1)
                ->where("parent_id", $request->cat_id)->pluck('cat_id')->toArray();
            if (isset($catChildrends[0])) {
                $idFilters = array_merge($idFilters, $catChildrends);
            }
            $posts->whereIn("cat_id", $idFilters);
        }

        $postsPaginate = $posts->paginate(7);
        /* So Default No Add Paramater Url */
        $queryUrl = http_build_query($request->except("page"));
        return response()->json(
            [
                "status" => true,
                "data" => $postsPaginate,
                "code" => 200,
                "next_page_url" => $postsPaginate->nextPageUrl()
                    ? $postsPaginate->nextPageUrl() . "&" . $queryUrl
                    : null,
                "asset" => asset("")
            ],
            200
        );
    }
}
