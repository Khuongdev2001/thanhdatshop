<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function getDetails($slug){
        $page=Page::getModel([
            "page_content"
        ])->where("page_slug",$slug)->first();
        if (!$page) {
            abort(404);
        }
        return view("user.page.details",compact("page"));
    }
}
