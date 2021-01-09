<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('project_name');
            $table->string('company_name');
            $table->string('description');
            $table->string('company_email');
            $table->longText('address');
            $table->string('phone');
            $table->string('project_leader');
            $table->string('status');
            $table->string('est_budget');
            $table->string('total_amount');
            $table->string('pro_duration');
            $table->string('project_start');
            $table->string('project_end');
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
        Schema::dropIfExists('projects');
    }
}
