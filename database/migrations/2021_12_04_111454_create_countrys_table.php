<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountrysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countrys', function (Blueprint $table) {
            $table->id("id");
            $table->string("coutry_name", 200);
            $table->string("province_id")->default(0);
            $table->string("district_id")->default(0);
            $table->string("commune_id")->default(0);
            $table->integer("type")->default(1);
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
        Schema::dropIfExists('countrys');
    }
}
