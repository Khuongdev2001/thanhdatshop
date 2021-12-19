<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id("post_id");
            $table->string("post_title",500);
            $table->text("post_description")->nullable();
            $table->text("post_content")->nullable();
            $table->string("post_slug",500)->nullable();
            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")->references("user_id")->on("users")->onDelete("cascade");
            $table->unsignedBigInteger("cat_id")->nullable();
            $table->foreign("cat_id")->references("cat_id")->on("cat_posts")->onDelete("cascade");
            $table->string("post_thumbnail",100)->nullable();
            $table->integer("post_status")->default(0);
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
        Schema::dropIfExists('posts');
    }
}
