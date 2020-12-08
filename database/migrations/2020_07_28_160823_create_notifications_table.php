<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->bigIncrements('noti_id');
            $table->string('noti_content');
            $table->boolean('noti_status')->default(false);
            $table->timestamp('noti_created')
            ->default(DB::raw('CURRENT_TIMESTAMP'));
            //foreign key
            $table->integer('stu_id')->unsigned();
            
            $table->foreign('stu_id')->references('stu_id')->on('students')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
