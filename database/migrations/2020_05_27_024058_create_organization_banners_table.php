<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organization_banners', function (Blueprint $table) {
            $table->Increments('ob_id');
            $table->string('ob_path');

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
        Schema::dropIfExists('organization_banners');
    }
}
