<?php

namespace App\Jobs\Cart;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Models\Cart;
use App\Models\CartProduct;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $cartId;
    public function __construct($cartId)
    {
        $this->cartId = $cartId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        /* Get Cart By Id */
        $cart = Cart::find($this->cartId);
        /* Handle Get Products Cart */
        $products = CartProduct::select([
            "cart_products.price",
            "qty",
            "product_title",
            "product_slug",
            "products.product_id",
            "url"
        ])
            ->leftJoin("products", "products.product_id", "cart_products.product_id")
            ->leftJoin("product_thumbnails", "product_thumbnails.product_id", "products.product_id")
            ->where("cart_id", $cart->cart_id)
            ->groupBy("products.product_id")
            ->get();

        Mail::to($cart->buyer_email)->send(new \App\Mail\Cart\CheckOutMail($cart, $products));
    }
}
