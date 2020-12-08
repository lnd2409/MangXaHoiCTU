<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountViewUnionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('count_view_unions', function (Blueprint $table) {
            $table->integer('stu_id')->index()->unsigned();
            $table->integer('up_id')->index()->unsigned();
          
            $table->foreign('stu_id')->references('stu_id')->on('students')->onDelete('cascade');
            $table->foreign('up_id')->references('up_id')->on('union_posts')->onDelete('cascade');
            $table->primary(['stu_id', 'up_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('count_view_unions');
    }
}
