<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_works', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id');
            $table->string('subWork_name');
            $table->string('assign_employee');
            $table->string('subWork_start');
            $table->string('subWork_end');
            $table->string('ref_no')->nullable();
            $table->string('created_by');
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('sub_works');
    }
}
