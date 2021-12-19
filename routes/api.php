<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get("province", "Api\CountryController@getProvince")->name("api.getProvince");
Route::get("district/{province_id}", "Api\CountryController@getDistrict")->name("api.getDistrict");
Route::get("commune/{district_id}", "Api\CountryController@getCommune")->name("api.getCommune");
/* Define Router Api */
Route::prefix("v2")->group(function () {
    Route::get("product/list", "Api\ProductController@getProducts")->name("api.product");
    Route::get("post/list","Api\PostController@getPosts")->name("api.post");
});
