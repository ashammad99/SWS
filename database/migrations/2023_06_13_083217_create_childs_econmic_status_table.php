<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildsEconmicStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('childs_economic_status', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('child_id');
            $table->enum('jobs_members',
                ['No','From GBP 0 - GBP 200','From GBP 200 - GBP 500','More than GBP 500']);

            $table->enum('periodic_sponsorships',
                ['No','From GBP 0 - GBP 60','From GBP 60 - GBP 150','More than GBP 150']);

            $table->enum('irregular_aids',
                ['No','From GBP 0 - GBP 100','From GBP 100 - GBP 250','More than GBP 250']);

            $table->integer('house_fees');
            $table->integer('edu_fees');
            $table->integer('rents');
            $table->integer('medical_fees');
            $table->string('family_needs');
            $table->string('project_type');
            $table->integer('project_cost');
            $table->string('notes');
            $table->timestamps();
        });
        Schema::table('childs_economic_status', function($table) {
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
        Schema::dropIfExists('childs_econmic_status');
    }
}
