<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorAssignProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_assign_projects', function (Blueprint $table) {
            $table->id();
            $table->string('vendor_id');
            $table->string('project_id');
            $table->string('project_work_order');
            $table->string('category_id');
            $table->string('assign_date');
            $table->string('pi_number');
            $table->string('total_payable');
            $table->string('total_pay')->nullable();
            $table->string('total_due')->nullable();
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
        Schema::dropIfExists('vendor_assign_projects');
    }
}
