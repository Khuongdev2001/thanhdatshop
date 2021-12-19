<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_posts', function (Blueprint $table) {
            $table->id("cat_id");
            $table->string("cat_title",100);
            $table->string("cat_slug",100); 
            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")->references("user_id")->on("users")->onDelete("cascade");
            $table->integer("cat_status")->default(1);
            $table->integer("parent_id")->default(0);
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
        Schema::dropIfExists('cat_posts');
    }
}
