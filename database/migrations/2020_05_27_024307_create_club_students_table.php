<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClubStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('club_students', function (Blueprint $table) {
            $table->string('cs_role');
            $table->timestamp('cs_created')
                ->default(DB::raw('CURRENT_TIMESTAMP'));
            //foreign key
            $table->integer('stu_id')->unsigned();
            $table->integer('c_id')->unsigned();
            
            $table->foreign('stu_id')->references('stu_id')->on('students')->onDelete('cascade');
            $table->foreign('c_id')->references('c_id')->on('clubs')->onDelete('cascade');

            $table->primary(['stu_id', 'c_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clc_students');
    }
}
