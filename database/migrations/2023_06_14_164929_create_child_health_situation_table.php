<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildHealthSituationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('child_health_situation', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('child_id');
            $table->boolean('good_health')->default(false);
            $table->boolean('has_disease')->default(false);
            $table->json('patients')->nullable();
            $table->string('medications')->nullable();
            $table->timestamps();

            $table->foreign('child_id')->references('id')->on('child_identification');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('child_health_situation');
    }
}
