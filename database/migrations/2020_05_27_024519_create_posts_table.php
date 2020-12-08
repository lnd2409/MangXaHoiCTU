<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('p_id');
            $table->string('p_slug')->index();
            $table->string('p_title');
            $table->string('p_content');
            $table->string('p_view_count')->default(0);
            $table->timestamp('p_created')
            ->default(DB::raw('CURRENT_TIMESTAMP'));

            //foreign key
            $table->integer('stu_id')->unsigned();
            $table->integer('sub_id')->unsigned();
            
            $table->foreign('stu_id')->references('stu_id')->on('students')->onDelete('cascade');
            $table->foreign('sub_id')->references('sub_id')->on('subjects')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
