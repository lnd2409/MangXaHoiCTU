<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsUbTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students_ub', function (Blueprint $table) {
            $table->string('sub_status');
            $table->string('sub_role')->index();
            $table->timestamp('sub_created')
            ->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->timestamp('sub_deleted')
            ->nullable();

            //foreign key
            $table->integer('stu_id')->unsigned();
            $table->integer('ub_id')->index()->unsigned();
            
            $table->foreign('stu_id')->references('stu_id')->on('students')->onDelete('cascade');
            $table->foreign('ub_id')->references('ub_id')->on('union_branchs')->onDelete('cascade');

            $table->primary(['stu_id', 'ub_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students_ub');
    }
}
