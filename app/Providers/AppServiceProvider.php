<?php

namespace App\Providers;

use App\Models\Menu;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /* Share User Login All View */
        View::composer('*', function ($view) {
            $userLogin = Auth::user();
            $view->with('userLogin', $userLogin);
        });

        /* Share Menu */
        View::composer(["user.master.layout"], function ($view) {
            $menus =  Menu::getModel([
                "menu_title",
                "menu_id"
            ])->orderBy("sort", "DESC")->limit(10)->get();
            /* clone copy object */
            $view->with("menus", clone $menus);
            $view->with("menuMobiles", clone $menus);
        });

        View::composer(["user.user.include.social"], function ($view) {
            $socials = \App\Models\Social::getSocials(Auth::id());
            $view->with('socials', $socials);
        });

        /* Share View Product Seen */
        View::composer(["user.product.include.productSeen"], function ($view) {
            $idProductSeens = session("idProductSeens", []);
            $productSeens = [];
            if ($idProductSeens) {
                $idProductSeensImplode = implode(",", $idProductSeens);
                /* Product Seens FIELD So Mysql Search product_id to small from big */
                $productSeens = \App\Models\Product::getModelProduct()
                    ->whereIn("products.product_id", $idProductSeens)
                    ->orderByRaw("FIELD(`products`.`product_id`,{$idProductSeensImplode})")
                    ->get();
            }
            $view->with('productSeens', $productSeens);
        });
    }
}
