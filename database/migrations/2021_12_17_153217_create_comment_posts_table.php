<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_posts', function (Blueprint $table) {
            $table->id("comment_id");
            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")->references("user_id")->on("users");
            $table->string("comment_content",500);
            $table->unsignedBigInteger("post_id");
            $table->foreign("post_id")->references("post_id")->on("posts");
            $table->boolean("comment_status")->default(true);
            $table->unsignedBigInteger("parent_id")->default(0);
            $table->integer("comment_tree")->nullable();
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
        Schema::dropIfExists('comment_post');
    }
}
