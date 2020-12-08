<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYearSemestersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('year_semesters', function (Blueprint $table) {
            //foreign key
            $table->integer('semester_id')->index()->unsigned();
            $table->integer('school_year_id')->index()->unsigned();
            
            $table->foreign('semester_id')->references('semester_id')->on('semesters')->onDelete('cascade');
            $table->foreign('school_year_id')->references('school_year_id')->on('school_years')->onDelete('cascade');

            $table->primary(['semester_id', 'school_year_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('year_semesters');
    }
}
