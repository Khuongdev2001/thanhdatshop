<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatPost extends Model
{
    const CREATED_AT="created_at";
    const UPDATED_AT="updated_at";
    public $fillable=["cat_id","cat_title","cat_slug","set_home","user_id","cat_status","parent_id","created_at","sort","updated_at","deleted_at"];
    public $primaryKey="cat_id";
    public $table="cat_posts";

    public static function getCatModel(array $selects = [])
    {
        $catModel = self::select(
            array_merge([
                "cat_id",
                "cat_title",
                "cat_slug"
            ], $selects)
        )->where("cat_status", true);
        return $catModel;
    }

    public function getPosts(){
        return $this->hasMany("App\Models\Post","cat_id")->select([
            "post_title",
            "post_description",
            "post_slug",
            "post_thumbnail",
            "fullname",
            "posts.created_at"
        ])->leftJoin("users","posts.user_id","users.user_id")
        ->paginate(10);
    }
}
