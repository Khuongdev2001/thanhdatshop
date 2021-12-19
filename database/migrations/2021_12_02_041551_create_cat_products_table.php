<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_products', function (Blueprint $table) {
            $table->id("cat_id");
            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")->references("user_id")->on("users")->onDelete("cascade");
            $table->string("cat_title",100);
            $table->integer("cat_status")->default(0);
            $table->string("cat_thumbnail",200)->nullable();
            $table->integer("parent_id")->default(0);
            $table->string("cat_slug",200);
            $table->integer("sort")->default(0);
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
        Schema::dropIfExists('cat_products');
    }
}
