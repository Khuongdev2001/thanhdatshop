<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\CatPost as Cat;
use App\Models\Post;
use App\Models\CommentPost;

class PostController extends Controller
{
    /* Handle Show View Post */
    public function getIndex($slug = null)
    {
        $cat = Cat::getCatModel()
            ->where("cat_slug", $slug)
            ->orWhere("set_home", true)
            ->first();
        return view("user.post.index", compact("cat"));
    }


    /* Handle Show View  */
    public function getDetails($slug)
    {
        $post = Post::getModel([
            "post_id",
            "posts.cat_id",
            "cat_title",
            "post_content"
        ])
            ->where("post_slug", $slug)
            ->leftJoin("cat_posts", "posts.cat_id", "cat_posts.cat_id")
            ->first();
        if (!$post) {
            abort(404);
        }
        /* get post same */
        $postSames = Post::getModel([
            "fullname"
        ])
            ->leftJoin("users", "users.user_id", "posts.user_id")
            ->where("post_id", "<>", $post->post_id)
            ->where("cat_id", $post->cat_id)
            ->limit(10)
            ->get();
        return view("user.post.details", compact("post", "postSames"));
    }

    /* Handle Add Comment  */

    public function postAddComment(\App\Http\Requests\Post\Comment\AddRequest $request)
    {
        $commentRq = $request->validated(); 
        if (isset($commentRq["parent_id"])) {
            /* Get Comment by id with parent_id */
            $commentParent = CommentPost::find($commentRq["parent_id"]);
            $commentRq["comment_tree"] = $commentParent->comment_tree
            ? $commentParent->comment_tree
            : $commentParent->comment_id;
            
            $commentRq["parent_id"] = (int) $commentRq["parent_id"];
        }
        $commentRq["post_id"] = $commentRq["module_id"];
        $commentRq["user_id"] = Auth::id();
        $comment = CommentPost::create($commentRq);
        return response()->json([
            "status" => true,
            "data" => $comment,
            "code" => 200
        ], 200);
    }

    /* Handle Get Comment */
    public function getComment(Request $request)
    {
        $comments = DB::table("comment_posts as parents")
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
                    (select count(`comment_id`) from `comment_posts`
                    where `comment_tree` = `parents`.`comment_id`  and `comment_status` = true)
                    as `count_comment_children`
                ")
            ])
            ->leftJoin("users", "users.user_id", "parents.user_id")
            ->where("comment_status", true)
            ->where("post_id", $request->module_id);
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
