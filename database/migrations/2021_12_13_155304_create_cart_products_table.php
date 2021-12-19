<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("product_id");
            $table->foreign("product_id")->references("product_id")->on("products")->onDelete("cascade");
            $table->unsignedBigInteger("cart_id");
            $table->foreign("cart_id")->references("cart_id")->on("carts")->onDelete("cascade");
            $table->bigInteger("price");
            $table->bigInteger("qty");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_products');
    }
}
