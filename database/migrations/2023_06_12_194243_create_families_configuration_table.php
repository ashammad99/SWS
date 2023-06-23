<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamiliesConfigurationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('families_configuration', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('child_id');
            $table->integer('members_count');
            $table->integer('members_university');
            $table->integer('members_school');
            $table->integer('members_worker');
            $table->json('relatives')->nullable();
            $table->timestamps();

            $table->foreign('child_id','fk_families_configuration_child_id')->references('id')->on('child_identification');

        });
//        Schema::table('families_configuration', function($table) {
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('families_configuration');
    }
}
