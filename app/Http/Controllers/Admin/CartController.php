<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct()
    {
        $this->cartStatus = [
            "Chờ Xác Nhận",
            "Đã Thanh Toán",
            "Đang Vận Chuyển",
            -1 => "Đã Hủy"
        ];
        View::share("cartStatus", $this->cartStatus);
    }

    /* Handle Show View Cart Order */
    public function getIndex()
    {
        return view("admin.cart.index");
    }

    /* Handle Show Handle Database */
    public function getDatatable()
    {
        $carts = Cart::cartModel([
            "product_title",
            "carts.created_at",
            "cart_products.product_id",
            "product_slug",
            "url"
        ])
            ->leftJoin("cart_products", "carts.cart_id", "cart_products.cart_id")
            ->leftJoin("products", "cart_products.product_id", "products.product_id")
            ->leftJoin("product_thumbnails", "product_thumbnails.product_id", "products.product_id")
            ->groupBy("cart_products.cart_id")
            ->orderBy("carts.created_at", "DESC")
            ->get();
        /* Option Case */
        $setText = function ($value) {
            return "<span>{$value}</span>";
        };
        $setAvatar = function ($thumbnail) {
            if ($thumbnail) {
                return '<a href="" class="box-thumbnail avatar">
                            <img src="' . asset($thumbnail) . '"/>
                        </a>';
            }
            return 'No Image';
        };
        $setAction = function ($cart) {
            $routeUpdate = route("admin.cart.update", $cart->cart_id);
            $routeDelete = route("cart.order",$cart->cart_id);
            return '
            <div>
                <a href="' . $routeUpdate . '" class="btn btn-info btn-edit" target="_blank">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                </a>
                <a href="' . $routeDelete . '" class="btn btn-warning btn-delete" target="_blank">
                    <i class="fa fa-eye"></i>
                </a>
            </div>';
        };
        $cartRenders = \Yajra\Datatables\Datatables::of($carts)
            ->editColumn("code", function ($cart) use ($setText) {
                return $setText($cart->code);
            })
            ->editColumn("url", function ($cart) use ($setAvatar) {
                return $setAvatar($cart->url);
            })
            ->editColumn("cart_info", function ($cart) use ($setText) {
                $cartInfo = $cart->product_title . ($cart->total_product > 1
                    ? "...và còn {$cart->total_product} sản phẩm khác"
                    : null);
                return $setText($cartInfo);
            })
            ->editColumn("total_price", function ($cart) use ($setText) {
                return $setText($cart->total_price
                    ? currencyFormat($cart->total_price)
                    : "...");
            })
            ->editColumn("fullname", function ($cart) use ($setText) {
                return $setText($cart->fullname);
            })
            ->editColumn("cart_status", function ($cart) use ($setText) {
                return $setText($this->cartStatus[$cart->cart_status]);
            })
            ->editColumn("created_at", function ($cart) use ($setText) {
                return $setText($cart->created_at);
            })
            ->addColumn("action", function ($carts) use ($setAction) {
                return $setAction($carts);
            })
            ->rawColumns(
                [
                    "code",
                    "url",
                    "cart_info",
                    "cat_title",
                    "fullname",
                    "cart_status",
                    "total_price",
                    "brand_name",
                    "created_at",
                    "action"
                ]
            )
            ->make(true);

        return $cartRenders;
    }

    /* Hanlde Show View Update Cart */
    public function getUpdate($id)
    {
        $cart = Cart::find($id);
        if (!$cart) {
            abort(404);
        }
        return view("admin.cart.update", compact("cart"));
    }

    /* handle Process Update Cart */
    public function postUpdate(\App\Http\Requests\Admin\Cart\UpdateRequest $request, $id)
    {
        $cart = Cart::find($id);
        if (!$cart) {
            abort(404);
        }
        $cart->update([
            "cart_status" => $request->cart_status
        ]);
        return redirect()->back()->with("success", "Cập Nhật Trạng Thái Thành Công!");
    }
}
