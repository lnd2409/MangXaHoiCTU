<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statuses', function (Blueprint $table) {
            $table->Increments('s_id');
            $table->string('s_status');
            $table->string('s_content');
            $table->timestamp('s_created')
            ->default(DB::raw('CURRENT_TIMESTAMP'));

            //foreign key
            $table->integer('ad_id')->unsigned();
            $table->integer('ub_id')->nullable()->unsigned();
            $table->integer('uo_id')->nullable()->unsigned();
            $table->integer('c_id')->nullable()->unsigned();
            
            $table->foreign('ad_id')->references('ad_id')->on('admins')->onDelete('cascade');
            $table->foreign('ub_id')->references('ub_id')->on('union_branchs')->onDelete('cascade');
            $table->foreign('uo_id')->references('uo_id')->on('union_organizations')->onDelete('cascade');
            $table->foreign('c_id')->references('c_id')->on('clubs')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statuses');
    }
}
