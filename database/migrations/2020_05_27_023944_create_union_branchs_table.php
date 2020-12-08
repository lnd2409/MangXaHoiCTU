<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnionBranchsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('union_branchs', function (Blueprint $table) {
            $table->Increments('ub_id');
            $table->string('ub_name');
            $table->string('ub_slug')->index();
               //foreign key
          $table->integer('uo_id')->unsigned();
          
          $table->foreign('uo_id')->references('uo_id')->on('union_organizations')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('union_branchs');
    }
}
