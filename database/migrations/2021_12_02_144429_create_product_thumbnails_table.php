<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductThumbnailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_thumbnails', function (Blueprint $table) {
            $table->id("thumbnail_id");
            $table->unsignedBigInteger("product_id");
            $table->foreign("product_id")->references("product_id")->on("products")->onDelete("cascade");
            $table->string("url")->nullable();
            $table->string("cdn")->nullable();
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
        Schema::dropIfExists('product_thumbnails');
    }
}
