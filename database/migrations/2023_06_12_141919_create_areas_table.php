<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('areas', function (Blueprint $table) {
            $table->id();
            $table->string('area_name_en');
            $table->string('area_name_ar');
            $table->unsignedBigInteger('governorate_id');
            $table->timestamps();
        });
        Schema::table('areas', function($table) {
            $table->foreign('governorate_id')->references('id')->on('governorates');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('areas');
    }
}
