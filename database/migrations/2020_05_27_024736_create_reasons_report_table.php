<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReasonsReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reasons_report', function (Blueprint $table) {
          //foreign key
          $table->integer('reason_id')->unsigned();
          $table->integer('r_id')->unsigned();
          
          $table->foreign('reason_id')->references('reason_id')->on('reasons')->onDelete('cascade');
          $table->foreign('r_id')->references('r_id')->on('reports')->onDelete('cascade');

          $table->primary(['reason_id', 'r_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reasons_report');
    }
}
