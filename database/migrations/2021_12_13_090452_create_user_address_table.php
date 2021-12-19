<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_address', function (Blueprint $table) {
            $table->id("id");
            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")->references("user_id")->on("users")->onDelete("cascade");
            $table->string("fullname",200);
            $table->string("company",200)->nullable();
            $table->string("phone",200);
            $table->integer("provice_id")->nullable();
            $table->integer("district_id")->nullable();
            $table->integer("commune_id")->nullable();
            $table->string("address",500)->nullable();
            $table->boolean("is_default")->default(false);
            $table->boolean("status")->default(true);
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
        Schema::dropIfExists('user_address');
    }
}
