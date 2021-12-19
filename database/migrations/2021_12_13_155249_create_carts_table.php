<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id("cart_id");
            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")->references("user_id")->on("users")->onDelete("cascade");
            $table->string("code", 200);
            $table->string("address", 500);
            $table->bigInteger("total");
            $table->string("buyer_email",200);
            $table->string("buyer_phone",200);
            $table->string("buyer_fullname",200);
            $table->integer("cart_status")->default(0);
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
        Schema::dropIfExists('carts');
    }
}
