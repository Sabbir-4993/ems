<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssingprojectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assingproject', function (Blueprint $table) {
            $table->id();
            $table->string('contractor_id');
            $table->string('project_id');
            $table->string('category_id');
            $table->string('assign_date');
            $table->string('end_date');
            $table->string('work_order');
            $table->string('total_payable');
            $table->string('total_pay')->unsigned();
            $table->string('total_due')->unsigned();
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
        Schema::dropIfExists('assingproject');
    }
}
