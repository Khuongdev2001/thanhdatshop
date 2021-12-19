<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function getOrderHistory(){
        $cartModel=app("App\Http\Controllers\CartController")->getOrderData();
        return auth()->user();
        $cartModel=$cartModel->paginate();
        return $cartModel;
    }
}
