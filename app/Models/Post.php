<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    const CREATED_AT="created_at";
    const UPDATED_AT="updated_at";
    public $fillable=["post_id","post_title","post_description","post_content","post_slug","user_id","post_thumbnail","post_status","cat_id","created_at","updated_at","deleted_at"];
    public $primaryKey="post_id";
    public $table="posts";

    public static function getPostAdmins(){
        $posts=self::select("post_id","post_thumbnail","post_title","cat_title","fullname","post_status","posts.created_at")
        ->leftJoin("cat_posts",function($join){
            $join->on("posts.cat_id","=","cat_posts.cat_id");
            /* Remove Cat Status = -1 Deleted */
            $join->on("cat_posts.cat_status","=",DB::raw(1));
        })
        ->leftJoin("users","users.user_id","=","posts.user_id")
        ->where("post_status","<>",-1)
        ->get();
        return $posts;
    }

    public static function getModel(array $selects = []){
        $catModel = self::select(
            array_merge([
                "post_title",
                "post_description",
                "post_slug",
                "post_thumbnail",
                "posts.created_at"
            ], $selects)
        )->where("post_status", true);
        return $catModel;
    }
}
