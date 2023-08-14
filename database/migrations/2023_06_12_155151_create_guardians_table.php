<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuardiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guardians', function (Blueprint $table) {
            $table->id();
            $table->string('guardian_fullName_en');
            $table->string('guardian_fullName_ar');

            $table->enum('rel_to_en',['FATHER', 'MOTHER', 'GRANDFATHER', 'GRANDMOTHER', 'BROTHER', 'SISTER', 'UNCLE', 'ANT', 'FATHER IN LAW', 'MOTHER IN LAW', 'SETP-FATHER', 'STEP-MOTHER', 'SON', 'HIM/HERSELF', 'HER/HIMSELF', 'AUNT', 'COUSIN', 'WIFE']);
            $table->enum('rel_to_ar',['ام', 'اب', 'الجد/ة', 'عم/ة', 'نفسه/ا', 'زوج الام', 'اخ/اخت', 'الزوج/ة', 'زوجة الاب', 'ابن/ابنة عم/خال', 'ابن/ة', 'العم/الخال', 'خالة', 'نفسه']);

            $table->integer('guardian_id_no');

            $table->enum('guardian_martial_status', ['Divorced', 'Married', 'Widow']);
            $table->enum('work', ['Employee', 'Jobless', 'Irregular work']);

            $table->enum('edu_level',['Primary', 'Preparator', 'Secondary', 'Diploma', 'University', 'Higher Degree', 'Vocational', 'illiterate']);
            $table->enum('monthly_salary',['000-200 GBP', '200-500 GBP', 'More than 500 GBP']);


            $table->unsignedBigInteger('child_id');
            //Address info of guardian
            $table->string('address_details');

            $table->unsignedBigInteger('governorate_id');
            $table->unsignedBigInteger('area_id');


            $table->string('email');

            $table->string('phone_no')->nullable();
            $table->string('mobile_1');
            $table->string('mobile_2');

            $table->unsignedBigInteger('child_code');
            $table->timestamps();
        });

        Schema::table('guardians', function($table) {
            $table->foreign('governorate_id')->references('id')->on('governorates');
            $table->foreign('area_id')->references('id')->on('areas');
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
        Schema::dropIfExists('guardians');
    }
}
