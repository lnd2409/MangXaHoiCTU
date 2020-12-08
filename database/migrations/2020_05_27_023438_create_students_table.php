<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->Increments('stu_id');
            $table->string('username',60)->index();
            $table->string('password',60);
            $table->string('remember_token',100);
            $table->string('stu_avatar');
            $table->string('stu_name');
            $table->string('stu_birth');
            $table->string('stu_code')->index();
            $table->string('stu_address');
            $table->string('stu_gmail');

            //foreign key
            $table->integer('yb_id')->unsigned();

            $table->foreign('yb_id')->references('yb_id')->on('youth_branchs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
