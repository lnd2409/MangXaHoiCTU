<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYouthBranchsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('youth_branchs', function (Blueprint $table) {
            $table->Increments('yb_id');
            $table->string('yb_name')->index();
              //foreign key
          $table->integer('course_id')->unsigned()->index();
          $table->integer('major_id')->unsigned()->index();
          
          $table->foreign('course_id')->references('course_id')->on('courses')->onDelete('cascade');
          $table->foreign('major_id')->references('major_id')->on('majors')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('youth_branchs');
    }
}
