<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->bigIncrements('f_id');
            $table->string('f_name');
            $table->string('f_size');
            $table->string('f_path');
            $table->timestamp('f_created')
            ->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('f_updated')
            ->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->timestamp('f_deleted')
            ->nullable();

            //foreign key
          $table->bigInteger('fo_id')->index()->unsigned();
          
          $table->foreign('fo_id')->references('fo_id')->on('folders')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
}
