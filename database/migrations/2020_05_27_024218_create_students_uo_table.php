<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsUoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students_uo', function (Blueprint $table) {
            $table->string('suo_status');
            $table->string('suo_role')->index();
            $table->timestamp('suo_created')
            ->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->timestamp('suo_deleted')
            ->nullable();

            //foreign key
            $table->integer('stu_id')->unsigned();
            $table->integer('uo_id')->index()->unsigned();
            
            $table->foreign('stu_id')->references('stu_id')->on('students')->onDelete('cascade');
            $table->foreign('uo_id')->references('uo_id')->on('union_organizations')->onDelete('cascade');

            $table->primary(['stu_id', 'uo_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students_uo');
    }
}
