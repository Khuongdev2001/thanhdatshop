<?php

namespace App\Http\Controllers;

use App\Models\CatPost;
use App\Models\CatProduct;
use App\Models\Slider;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /* Handle Show View Home */

    public function index()
    {

        /* Get Slider Type 1 */
        $sliders = Slider::getSliderModel();
        $sliderBigs = $sliders->where("slider_type", 1)->get();
        $mainCats = CatProduct::getCatModel()->where("parent_id", 0)->get();
        /* Get Cat Product */
        $catProducts = CatProduct::getCatModel()->where("set_home", true)->get();
        /* Get Slider Type 0 */
        $sliderSmalls = Slider::getSliderModel()
            ->where("slider_type", 0)->get();
        /* Get Cat Post */
        $catPosts = CatPost::getCatModel()->where("set_home", true)->get();
        return view("user.home.index", compact("sliderBigs", "mainCats", "catProducts", "sliderSmalls", "catPosts"));
    }
}
