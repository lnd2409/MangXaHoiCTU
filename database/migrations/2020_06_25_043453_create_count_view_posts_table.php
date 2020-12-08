<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountViewPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('count_view_posts', function (Blueprint $table) {
            $table->integer('stu_id')->index()->unsigned();
            $table->bigInteger('p_id')->index()->unsigned();
          
            $table->foreign('stu_id')->references('stu_id')->on('students')->onDelete('cascade');
            $table->foreign('p_id')->references('p_id')->on('posts')->onDelete('cascade');
            $table->primary(['stu_id', 'p_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('count_view_posts');
    }
}
