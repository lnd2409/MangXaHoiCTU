<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            //foreign key
            $table->bigInteger('com_id')->index()->unsigned();
            $table->integer('stu_id')->unsigned();
            $table->integer('l_status')->unsigned();

            $table->foreign('com_id')->references('com_id')->on('comments')->onDelete('cascade');
            $table->foreign('stu_id')->references('stu_id')->on('students')->onDelete('cascade');

            $table->primary(['com_id', 'stu_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('likes');
    }
}
