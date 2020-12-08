<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_reports', function (Blueprint $table) {
            $table->bigIncrements('ir_id');
            //foreign key
            $table->bigInteger('item_id')->index()->unsigned();
            $table->integer('stu_id')->unsigned();
            
            $table->foreign('item_id')->references('item_id')->on('items')->onDelete('cascade');
            $table->foreign('stu_id')->references('stu_id')->on('students')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_reports');
    }
}
