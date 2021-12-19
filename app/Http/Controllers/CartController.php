<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Product;

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
    }
    /* Handle Request Add Remove Update Cart Session */
    public function getChange(Request $request)
    {
        /* Get Product */
        $product = Product::getModelProduct()->where("products.product_id", $request->id)
            ->first();
        if (!$product) {
            return response()->json([
                "status" => false,
                "message" => "404 Not Found!",
                "data" => null
            ], 404);
        }
        /* Handle Add Remove Update CartItem Session */
        if (!session("cart")) {
            $this->handleCreateCartSession();
        }
        /* Default qty =1 */
        $qtyDefault = (int) $request->qty ? $request->qty : 1;
        /* If Product Exist Handle $qty */
        $productCartId = session("cart.cartItem.{$request->id}");
        if ($productCartId) {
            $qtyDefault += $productCartId["qty"];
        }
        /* Get Qty Request Is Default */
        $qtyDefault = (int) $request->num ? (int) $request->num : $qtyDefault;
        /* Update Or Add Cart Item */
        session(["cart.cartItem.{$request->id}" => [
            "product_title" => $product->product_title,
            "qty" => $qtyDefault,
            "total_price" => $qtyDefault * $product->price,
            "price" => $product->price,
            "product_thumbnail" => $product->url
        ]]);
        $this->handleUpdateCartInfo();
        return response()->json([
            "status" => true,
            "message" => "Thêm Thành Công Vào Giỏ Hàng",
            "cartItem" => session("cart.cartItem.{$request->id}"),
            "cartInfo" => session("cart.cartInfo")
        ]);
    }

    private function handleUpdateCartInfo()
    {
        $totalQty = 0;
        $totalPrice = 0;
        $totalProduct = 0;
        foreach (session("cart.cartItem") as $cart) {
            $totalQty += $cart["qty"];
            $totalPrice += $cart["total_price"];
            $totalProduct++;
        };
        /* Update Cart Info Session */
        session(["cart.cartInfo" => [
            "totalQty" => $totalQty,
            "totalPrice" => $totalPrice,
            "totalProduct" => $totalProduct
        ]]);
    }

    private function handleCreateCartSession()
    {
        session(["cart" => [
            "cartItem" => [],
            "cartInfo" => ["totalQty" => 0, "totalPrice" => 0, "totalProduct" => 0]
        ]]);
    }

    /* Handle Show View Cart Index */
    public function getIndex()
    {
        $userAddress = Auth::check()
            ? Auth::user()->getAddress->first()
            : null;
        $cartItems = session("cart.cartItem");
        $cartInfo = session("cart.cartInfo");
        return view("user.cart.index", compact("cartItems", "cartInfo", "userAddress"));
    }

    /* Handle Delete Cart Item Api */
    public function getDelete(Request $request)
    {
        $ids = explode(",", $request->id);
        /* Loop Key  End  Delete Session Cart Key */
        $status = false;
        foreach ($ids as $id) {
            /* Check Id Session Cart Value */
            if (!session("cart.cartItem.{$id}")) {
                break;
            }
            $status = true;
            session()->forget("cart.cartItem.{$id}");
        }
        /* Update Cart Item*/
        $this->handleUpdateCartInfo();
        return response()->json([
            "status" => $status,
            "message" => $status ? "Xóa Thành Công!" : "Lỗi Truy Vấn!",
            "cartInfo" => session("cart.cartInfo")
        ], 200);
    }

    /* Handle Add Database Carts */
    public function getCheckOut()
    {
        $user = Auth::user();
        $userAddress = $user->getAddress->first();
        /* Don't CheckOut Empty Cart */
        $cartSession = session("cart");
        if (!$cartSession || !$userAddress) {
            return redirect()->route("home");
        };
        $address = implode(", ", [
            $userAddress->address,
            $userAddress->commune_name,
            $userAddress->district_name,
            $userAddress->province_name
        ]);
        $cartInfo = session("cart.cartInfo");
        $productIds = array_keys(session("cart.cartItem"));
        $cart = [
            "user_id" => $user->user_id,
            "code" => $this->handleCreateCode(),
            "address" => $address,
            "buyer_fullname" => $userAddress->fullname,
            "buyer_email" => $user->email,
            "buyer_phone" => $userAddress->phone,
            "total_price" => $cartInfo["totalPrice"],
            "total_qty" => $cartInfo["totalQty"],
            "total_product" => $cartInfo["totalProduct"]
        ];
        $cartDb = Cart::create((array)$cart);

        /* Convert Array Insert Database */
        foreach ($productIds as $productId) {
            $cartItem = session("cart.cartItem.{$productId}");
            $cartProduct[] = [
                "product_id" => $productId,
                "cart_id" => $cartDb->cart_id,
                "price" => $cartItem["price"],
                "qty" => $cartItem["qty"]
            ];
        }
        CartProduct::insert($cartProduct);
        /* Handle Send Mailer */
        dispatch(new \App\Jobs\Cart\SendMailJob($cartDb->cart_id));
        /* Delete All Cart */
        session()->forget("cart");
        return redirect()->route("cart.order", $cartDb->cart_id)->with("success", "Đặt Hàng Thành Công");
    }

    private function handleCreateCode($company = "td")
    {
        return $company . "_" . (time() + time());
    }

    /* Handle Show View CheckOut Cart */
    public function getOrder($id)
    {
        $userDb = Auth::user();
        $cart = Cart::cartModel();
        /* Only Admin And Buyer Allow Seen */
        if ($userDb->level < 2) {
            $cart = $cart->where("user_id", $userDb->user_id);
        };
        $cart = $cart->where("cart_id", $id)
            ->first();
        if (!$cart) {
            abort(404);
        }
        $cartProducts = CartProduct::select([
            "cart_products.price",
            "qty",
            "product_title",
            "product_slug",
            "products.product_id",
            "url"
        ])
            ->leftJoin("products", "products.product_id", "cart_products.product_id")
            ->leftJoin("product_thumbnails", "product_thumbnails.product_id", "products.product_id")
            ->where("cart_id", $id)
            ->groupBy("products.product_id")
            ->get();
        return view("user.cart.checkout", compact("cart", "cartProducts"));
    }

    /* Handle Show View History Order */
    public function getOrderHistory()
    {
        $carts = $this->getOrderData()->paginate(10);
        $cartStatus = $this->cartStatus;
        return view("user.cart.history", compact("carts", "cartStatus"));
    }

    public function getOrderHistoryRaw(Request $request)
    {
        $cart = $this->getOrderData();
        if ($request->cartStatus != null) {
            $cart->where("cart_status", $request->cartStatus);
        }
        $cart = $cart->paginate(10);
        return response()->json([
            "status" => true,
            "data" => $cart,
            "asset" => asset(""),
            "cartStatus" => $this->cartStatus
        ], 200);
    }

    public function getOrderData()
    {
        $userId = Auth::id();
        $carts = Cart::where("carts.user_id", $userId)
            ->select([
                "carts.cart_id",
                "code",
                "product_title",
                "total_price",
                "total_product",
                "carts.created_at",
                "cart_status",
                "cart_products.product_id",
                "product_slug",
                "url"
            ])
            ->leftJoin("cart_products", "carts.cart_id", "cart_products.cart_id")
            ->leftJoin("products", "cart_products.product_id", "products.product_id")
            ->leftJoin("product_thumbnails", "product_thumbnails.product_id", "products.product_id")
            ->groupBy("cart_products.cart_id")
            ->orderBy("carts.created_at", "DESC");
        return $carts;
    }
}
