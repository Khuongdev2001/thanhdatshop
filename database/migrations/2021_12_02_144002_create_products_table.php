<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id("product_id");
            $table->string("product_title", 500);
            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")->references("user_id")->on("users")->onDelete("cascade");
            $table->text("product_description")->nullable();
            $table->text("product_content")->nullable();
            $table->string("product_slug", 500)->nullable();
            $table->integer("product_status")->default(0);
            $table->unsignedBigInteger("cat_id")->nullable();
            $table->foreign("cat_id")->references("cat_id")->on("cat_products")->onDelete("cascade");
            $table->integer("price")->nullable();
            $table->integer("price_old")->nullable();
            $table->unsignedBigInteger("brand_id")->nullable();
            $table->foreign("brand_id")->references("brand_id")->on("brands")->onDelete("cascade");
            $table->integer("product_type")->default(0)->comment("0:Thường 1:hot");
            $table->date("created_at")->nullable();
            $table->date("updated_at")->nullable();
            $table->date("deleted_at")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
