<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id("menu_id");
            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")->references("user_id")->on("users")->onDelete("cascade");
            $table->string("menu_title");
            $table->unsignedBigInteger("parent_id")->default(0);
            $table->string("menu_link");
            $table->integer("menu_status")->default(1);
            $table->integer("sort")->default(0);
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
        Schema::dropIfExists('menus');
    }
}
