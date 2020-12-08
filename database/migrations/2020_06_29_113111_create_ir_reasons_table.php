<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIrReasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ir_reasons', function (Blueprint $table) {
                //foreign key
                $table->integer('reason_id')->unsigned();
                $table->biginteger('ir_id')->unsigned();
                
                $table->foreign('reason_id')->references('reason_id')->on('reasons')->onDelete('cascade');
                $table->foreign('ir_id')->references('ir_id')->on('item_reports')->onDelete('cascade');
      
                $table->primary(['reason_id', 'ir_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ir_reasons');
    }
}
