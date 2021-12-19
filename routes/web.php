<?php

use Illuminate\Support\Facades\Route;
/*
| Backend Start 28-11-2021
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Define Router Of Admin Page */

Route::prefix('admin')->group(function () {
    Route::get("login", "Admin\UserController@getLogin")
        ->name("admin.user.login");
    Route::post("login", "Admin\UserController@postLogin");
    /* Group Check Login And Admin */
    Route::middleware(["CheckLogin", "CheckAdmin"])->group(function () {
        Route::get("user/add", "Admin\UserController@getAdd")
            ->name("admin.user.add");
        Route::post("user/add", "Admin\UserController@postAdd");
        Route::post("user/check/email", "Admin\UserController@checkEmail")
            ->name("admin.user.check.email");
        Route::get("user", "Admin\UserController@getIndex")
            ->name("admin.user");
        Route::get("user/datatable", "Admin\UserController@getDatatable")
            ->name("admin.user.datatable");
        Route::get("user/update/{id}", "Admin\UserController@getUpdate")
            ->name("admin.user.update");
        Route::post("user/update/{id}", "Admin\UserController@postUpdate");
        Route::get("user/logout", "Admin\UserController@getLogout")
            ->name("admin.user.logout");
        Route::get("user/role/{id}", "Admin\UserController@setRole")
            ->name("admin.user.role");

        /* Handle Router Moudle Post */
        Route::prefix("post")->group(function () {
            Route::get("category/add/{id?}", "Admin\PostController@getAddCategory")
                ->name("admin.post.category.add");
            Route::post("category/add", "Admin\PostController@postAddCategory");
            Route::get("category/datatable", "Admin\PostController@getDatableCategory")
                ->name("admin.post.category.datatable");
            Route::post("category/update/{id}", "Admin\PostController@postUpdateCategory")
                ->name("admin.post.category.update");
            Route::get("category/delete/{id}", "Admin\PostController@getDeleteCategory")
                ->name("admin.post.category.delete");
            Route::get("add", "Admin\PostController@getAdd")
                ->name("admin.post.add");
            Route::post("add", "Admin\PostController@postAdd");
            Route::get("/", "Admin\PostController@getIndex")
                ->name("admin.post");
            Route::get("datatable", "Admin\PostController@getDatatable")
                ->name("admin.post.datatable");
            Route::get("update/{id}", "Admin\PostController@getUpdate")
                ->name("admin.post.update");
            Route::post("update/{id}", "Admin\PostController@postUpdate");
            Route::get("delete/{id}", "Admin\PostController@getDelete")
                ->name("admin.post.delete");
        });
        /* Handle Router Module Product */
        Route::prefix("product")->group(function () {
            Route::get("category/add/{id?}", "Admin\ProductController@getAddCategory")
                ->name("admin.product.category.add");
            Route::post("category/add", "Admin\ProductController@postAddCategory");
            Route::get("category/datatable", "Admin\ProductController@getDatatableCategory")
                ->name("admin.product.category.datatable");
            Route::post("category/update/{id}", "Admin\ProductController@postUpdateCategory")
                ->name("admin.product.category.update");
            Route::get("category/delete/{id}", "Admin\ProductController@getDeleteCategory")
                ->name("admin.product.category.delete");
            Route::get("add", "Admin\ProductController@getAdd")
                ->name("admin.product.add");
            Route::post("add", "Admin\ProductController@postAdd");
            Route::get("/", "Admin\ProductController@getIndex")
                ->name("admin.product");
            Route::get("datatable", "Admin\ProductController@getDatatable")
                ->name("admin.product.datatable");
            Route::get("update/{id}", "Admin\ProductController@getUpdate")
                ->name("admin.product.update");
            Route::post("update/{id}", "Admin\ProductController@postUpdate");
            Route::get("delete/{id}", "Admin\ProductController@getDelete")
                ->name("admin.product.delete");
            Route::get("brand/add/{id?}", "Admin\ProductController@getAddBrand")
                ->name("admin.product.brand.add");
            Route::post("brand/add/{id?}", "Admin\ProductController@postAddBrand");
            Route::get("brand/datatable", "Admin\ProductController@getDatatableBrand")
                ->name("admin.product.brand.datatable");
            Route::post("brand/update/{id?}", "Admin\ProductController@postUpdateBrand")
                ->name("admin.product.brand.update");
            Route::get("brand/delete/{id?}", "Admin\ProductController@getDeleteBrand")
                ->name("admin.product.brand.delete");
        });
        /* Handle Router Module Slider */
        Route::prefix("slider")->group(function () {
            Route::get("add/{id?}", "Admin\SliderController@getAdd")
                ->name("admin.slider.add");
            Route::post("add", "Admin\SliderController@postAdd");
            Route::get("datatable", "Admin\SliderController@getDatatable")
                ->name("admin.slider.datatable");
            Route::post("update/{id?}", "Admin\SliderController@postUpdate")
                ->name("admin.slider.update");
            Route::get("admin/slider/delete/{id}", "Admin\SliderController@getDelete")
                ->name("admin.slider.delete");
        });
        /* Hanle Router Module Page */
        Route::prefix("page")->group(function () {
            Route::get("add", "Admin\PageController@getAdd")
                ->name("admin.page.add");
            Route::post("add", "Admin\PageController@postAdd");
            Route::get("/", "Admin\PageController@getIndex")
                ->name("admin.page");
            Route::get("datatable", "Admin\PageController@getDatatable")
                ->name("admin.page.datatable");
            Route::get("update/{id?}", "Admin\PageController@getUpdate")
                ->name("admin.page.update");
            Route::post("update/{id?}", "Admin\PageController@postUpdate");
            Route::get("delete/{id?}", "Admin\PageController@getDelete")
                ->name("admin.page.delete");
        });
        Route::post("editor/upload/image", "Admin\ImageController@handleUploadEditor")
            ->name("admin.editor.upload.image");

        /* Handle Router Module Cart */
        Route::prefix("cart")->group(function () {
            Route::get("/", "Admin\CartController@getIndex")->name("admin.cart");
            Route::get("/datatable", "Admin\CartController@getDatatable")->name("admin.cart.datatable");
            Route::get("update/{id}", "Admin\CartController@getUpdate")->name("admin.cart.update");
            Route::post("update/{id}", "Admin\CartController@postUpdate");
        });
        /* Handle Router Moudle Template */
        Route::prefix("template")->group(function () {
            Route::prefix("menu")->group(function () {
                Route::get("add/{id?}", "Admin\TemplateController@getMenuAdd")->name("admin.template.menu.add");
                Route::post("add", "Admin\TemplateController@postMenuAdd");
                Route::get("datatable", "Admin\TemplateController@getMenuDatatable")->name("admin.template.menu.datatable");
                Route::get("update/{id}", "Admin\TemplateController@getMenuUpdate")->name("admin.template.menu.update");
                Route::post("update/{id}", "Admin\TemplateController@postMenuUpdate")->name("admin.template.menu.update");
                Route::get("delete/{id}", "Admin\TemplateController@getDeleteMenu")->name("admin.template.menu.delete");
            });
        });
    });
});

/* Defind Router Of User Page */
Route::get("/", "HomeController@index")
    ->name("home");
Route::post("login", "UserController@postLogin")
    ->name("login");
Route::get("logout", "UserController@getLogout")
    ->name("logout");
Route::post("reg", "UserController@postReg")
    ->name("reg");
Route::get("login/social/{mode}", "UserController@getLoginSocial")
    ->where("mode", "1|2")
    ->name("user.login.social");
Route::get("account/social/callback/{mode}", "UserController@getCallbackSocial")
    ->where("mode", "1|2");
/* Check Login */
Route::middleware(["CheckLogin"])->group(function () {
    Route::get("account/connect/{mode}/{option}", "userController@getConnect")
        ->where("mode", "1|2")
        ->where("option", "remove|add")
        ->name("user.account.connect");
    Route::get("account", "UserController@getUpdate")
        ->name("user.account");
    Route::post("account", "UserController@postUpdate");
    Route::post("account/password", "UserController@postChangePassword")
        ->name("user.account.changePassword");
    Route::get("account/address", "UserController@getAddress")->name("user.address");
    Route::get("account/address/add/{id?}", "UserController@getAddAddress")->name("user.address.add");
    Route::post("account/address/add", "UserController@postAddAddress");
    Route::post("account/address/update/{id}", "UserController@postUpdateAddress")->name("user.address.update");
    Route::get("account/address/delete/{id?}", "UserController@getDeleteAddress")->name("user.address.delete");
});

/* Define Router Cart */

Route::prefix("cart")->group(function () {
    Route::get("/", "CartController@getIndex")->name("cart");
    Route::middleware(["CheckLogin"])->group(function () {
        Route::get("change", "CartController@getChange")->name("cart.change");
        Route::get("delete", "CartController@getDelete")->name("cart.delete");
        Route::get("checkout", "CartController@getCheckOut")->name("cart.checkout");
        Route::get("order/{id}", "CartController@getOrder")->name("cart.order");
        Route::get("history", "CartController@getOrderHistory")->name("cart.history");
        Route::get("history/raw", "CartController@getOrderHistoryRaw");
    });
});

Route::prefix("post")->group(function () {
    Route::get("comment", "PostController@getComment")->name("post.comment");
    Route::middleware(["CheckLogin"])->group(function () {
        Route::post("comment/add", "PostController@postAddComment")->name("post.comment.add");
    });
    Route::get("{slug}.html", "PostController@getDetails")->name("post.details");
    Route::get("{slug?}", "PostController@getIndex")->name("post");
});

/* Defind Router Page */
Route::prefix("page")->group(function () {
    Route::get("{slug}", "PageController@getDetails")->name("page.details");
});


/* Define Router Product */
Route::prefix("/")->group(function () {
    Route::get("product/comment", "ProductController@getComment")->name("product.comment");
    Route::get("product/list/{catSlug?}", "ProductController@getIndex")->name("product");
    Route::get("{id}/{slug}", "ProductController@getDetails")->name("product.details");
    Route::middleware(["CheckLogin"])->group(function () {
        Route::post("product/comment/add", "ProductController@postAddComment")->name("product.comment.add");
    });
});
