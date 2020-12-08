<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_banners', function (Blueprint $table) {
            $table->Increments('bb_id');
            $table->string('bb_path');

            //foreign key
            $table->integer('ub_id')->unsigned();

            $table->foreign('ub_id')->references('ub_id')->on('union_branchs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('branch_banners');
    }
}
