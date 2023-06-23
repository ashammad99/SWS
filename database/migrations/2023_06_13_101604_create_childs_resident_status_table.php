<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildsResidentStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('childs_resident_status', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('child_id');
            $table->enum('resident_status', ['Ownership', 'Shared', 'Rent']);
            $table->enum('resident_type', ['Concrete', 'Asbestos', 'Zinc plate']);
            $table->enum('resident_description', ['Good', 'Moderate', 'Bad']);
            $table->string('resident_needs');
            $table->integer('rent_cost')->nullable();
            $table->integer('no_rooms');
            $table->integer('house_area');
            $table->timestamps();
        });
        Schema::table('childs_resident_status', function($table) {
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
        Schema::dropIfExists('childs_resident_status');
    }
}
