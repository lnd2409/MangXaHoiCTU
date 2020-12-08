<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnionPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('union_posts', function (Blueprint $table) {
            $table->increments('up_id');
            $table->string('up_slug')->index();
            $table->string('up_avatar');
            $table->string('up_title');
            $table->text('up_content');
            $table->integer('up_view_count')->default(0);
            $table->timestamp('up_created')
                ->default(DB::raw('CURRENT_TIMESTAMP'));

            //foreign key
            $table->integer('stu_id')->unsigned();
            $table->integer('ub_id')->index()->unsigned();
            
            $table->foreign('stu_id')->references('stu_id')->on('students')->onDelete('cascade');
            $table->foreign('ub_id')->references('ub_id')->on('union_branchs')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('union_posts');
    }
}
