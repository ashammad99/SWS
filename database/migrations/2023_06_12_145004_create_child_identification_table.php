<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildIdentificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('child_identification', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('child_code')->unique();
            $table->string('child_fullName_en');
            $table->string('child_fullName_ar');

            $table->integer('child_id_no')->unique();;
            $table->enum('gender', ['Male', 'Female']);
            $table->enum('category', ['Orphan', 'Needy', 'Special Needs']);
            $table->date('birth_date');


            $table->string('mother_fullName_en');
            $table->string('mother_fullName_ar');
            $table->integer('mother_id_no')->unique();;

            $table->enum('mother_martial_status', ['Divorced', 'Married', 'Widow','Abandon']);


            $table->string('father_fullName_en');
            $table->string('father_fullName_ar');

            $table->integer('father_id_no')->unique();;
            $table->date('death_date')->nullable();

            $table->boolean('has_disability')->default(false);
            $table->string('disability_type')->nullable();
            $table->string('sponsorship_category');
            $table->enum('scale_of_poverty',['VERY POOR','SEVERE','POOR']);

            $table->unsignedBigInteger('sr_id')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('child_identification', function($table) {
                $table->foreign('sr_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('child_identification');
    }
}
