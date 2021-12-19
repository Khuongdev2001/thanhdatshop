<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_products', function (Blueprint $table) {
            $table->id("comment_id");
            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")->references("user_id")->on("users");
            $table->string("comment_content",500);
            $table->unsignedBigInteger("product_id");
            $table->foreign("product_id")->references("product_id")->on("products");
            $table->boolean("comment_status")->default(true);
            $table->unsignedBigInteger("parent_id")->default(0);
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
        Schema::dropIfExists('comment_products');
    }
}
