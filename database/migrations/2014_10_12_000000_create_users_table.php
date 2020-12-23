<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('role_id')->default('2');
            $table->string('name');

            $table->string('mobile_number')->nullable();
            $table->string('address')->nullable();
            $table->string('image');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('skill')->nullable();

//            Personal Information
            $table->string('blood_group')->nullable();
            $table->string('marital_status')->nullable();

//            Official Information
            $table->integer('department_id');
            $table->string('designation');
            $table->date('join_date');
            $table->string('salary');
            $table->string('loan')->nullable();
            $table->string('emp_type')->default('1'); //full time or contract
            $table->string('emp_status')->default('1'); //Active or Inactive

//            Educational Information
            $table->string('edu')->nullable(); // select Field SSC, HSC, BSC, MSC
            $table->string('edu_year')->nullable(); //graduation year

//            Work experience
            $table->string('pre_work')->nullable(); //Previous Company Name
            $table->string('pre_work_year')->nullable(); // Working Year

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
