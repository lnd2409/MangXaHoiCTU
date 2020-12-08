<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClubPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('club_posts', function (Blueprint $table) {
            $table->Increments('cp_id');
            $table->string('cp_slug');
            $table->string('cp_avatar');
            $table->string('cp_title');
            $table->string('cp_content');
            $table->string('cp_view_count')->default(0);
            $table->timestamp('cp_created')
            ->default(DB::raw('CURRENT_TIMESTAMP'));

            //foreign key
            $table->integer('stu_id')->unsigned();
            $table->integer('c_id')->index()->unsigned();
            
            $table->foreign('stu_id')->references('stu_id')->on('students')->onDelete('cascade');
            $table->foreign('c_id')->references('c_id')->on('clubs')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('club_posts');
    }
}
