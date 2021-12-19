<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id("user_id");
            $table->string("email",100)->nullable()->unique();
            $table->string("fullname",100)->nullable();
            $table->string("password_hash",100);
            $table->string("phone",20)->nullable();
            $table->string("facebook_id")->nullable();
            $table->string("google_id")->nullable();
            $table->string("avatar",200)->nullable();
            $table->boolean("user_active_mail")->default(false);
            $table->string("token",200)->nullable();
            $table->integer("level")->default(0);
            $table->date("user_created_at")->nullable();
            $table->date("user_updated_at")->nullable();   
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
