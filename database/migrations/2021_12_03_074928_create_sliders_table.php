<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->id("slider_id");
            $table->string("slider_thumbnail", 100);
            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")->references("user_id")->on("users")->onDelete("cascade");
            $table->integer("slider_status")->default(0);
            $table->integer("slider_type");
            $table->integer("sort")->default(0);
            $table->string("slider_link", 50)->nullable();
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
        Schema::dropIfExists('sliders');
    }
}
