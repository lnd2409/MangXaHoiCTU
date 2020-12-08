<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFavouritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favourites', function (Blueprint $table) {
            //foreign key
          $table->integer('stu_id')->index()->unsigned();
          $table->bigInteger('fo_id')->index()->unsigned();
          
          $table->foreign('stu_id')->references('stu_id')->on('students')->onDelete('cascade');
          $table->foreign('fo_id')->references('fo_id')->on('folders')->onDelete('cascade');

          $table->primary(['stu_id', 'fo_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('favourites');
    }
}
