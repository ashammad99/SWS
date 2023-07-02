<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildsEduStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('childs_edu_status', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('child_id');
            $table->enum('child_edu_level', ['Under School Age', 'Kindergarten', 'Primary School']);
            $table->string('school_name',255)->nullable();
            $table->boolean('need_lessons')->default(false)->nullable();
            $table->string('intensive_lessons',100)->nullable()->default(null);
            $table->integer('cost_lesson')->nullable();
            $table->string('hobbies',255)->nullable()->default(null);
            $table->timestamps();
        });

        Schema::table('childs_edu_status', function($table) {
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
        Schema::dropIfExists('childs_edu_status');
    }
}
