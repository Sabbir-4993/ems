<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApprovedRequisitionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('approved_requisition_details', function (Blueprint $table) {
            $table->id();
            $table->integer('requisition_id');
            $table->string('particular');
            $table->string('quantity');
            $table->string('unit');
            $table->string('unit_price');
            $table->string('total_price');
            $table->string('pro_remarks')->nullable();
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
        Schema::dropIfExists('approved_requisition_details');
    }
}
