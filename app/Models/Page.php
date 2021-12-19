<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    const CREATED_AT="created_at";
    const UPDATED_AT="updated_at";
    public $fillable=["page_id","page_title","page_content","page_slug","user_id","page_status","created_at","updated_at","deleted_at"];
    public $primaryKey="page_id";
    public $table="pages";

    public static function getPageAdmins(){
        $pages=self::select("page_id","page_title","fullname","page_status","pages.created_at")
        ->leftJoin("users","users.user_id","=","pages.user_id")
        ->where("page_status","<>",-1)
        ->get();
        return $pages;
    }

    public static function getModel(array $selectors=[]){
        $model=self::select(array_merge([
            "page_title",
            "page_slug"
        ],$selectors))
        ->where("page_status",true);
        return $model;
    }
}
