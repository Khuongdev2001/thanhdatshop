<?php

namespace App\Mail\Cart;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CheckOutMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $cart;
    private $products;
    public function __construct($cart, $products)
    {
        $this->cart = $cart;
        $this->products = $products;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $cart = $this->cart;
        $products = $this->products;
        return $this->view('mail.cart.checkout', compact("cart", "products"))
            ->from("company142001@gmail.com")
            ->subject("{$cart["buyer_fullname"]} ơi! có đơn hàng mới nè!");
    }
}
