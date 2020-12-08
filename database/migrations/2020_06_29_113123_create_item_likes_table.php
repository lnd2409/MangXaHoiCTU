<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_likes', function (Blueprint $table) {
            //foreign key
            $table->bigInteger('item_id')->index()->unsigned();
            $table->integer('stu_id')->unsigned();
            
            $table->foreign('item_id')->references('item_id')->on('items')->onDelete('cascade');
            $table->foreign('stu_id')->references('stu_id')->on('students')->onDelete('cascade');

            $table->primary(['item_id', 'stu_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_likes');
    }
}
