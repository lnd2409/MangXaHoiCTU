<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFoldersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('folders', function (Blueprint $table) {
            $table->bigIncrements('fo_id');
            $table->string('fo_slug')->index();
            $table->string('fo_name');
            $table->string('fo_permission');
            //foreign key
          $table->integer('sub_id')->index()->unsigned();
          $table->integer('stu_id')->index()->unsigned();
          $table->bigInteger('fo_child')->index()->nullable()->unsigned();
          
          $table->foreign('sub_id')->references('sub_id')->on('subjects_student')->onDelete('cascade');
          $table->foreign('stu_id')->references('stu_id')->on('subjects_student')->onDelete('cascade');
          $table->foreign('fo_child')->references('fo_id')->on('folders')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('folders');
    }
}
