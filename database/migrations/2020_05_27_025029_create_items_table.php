<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('item_id');
            $table->string('item_name');
            $table->string('item_price');
            $table->string('item_phone');
            $table->string('item_title');
            $table->string('item_content');
            $table->string('item_slug');
            $table->string('item_view_count')->default(0);
            $table->string('item_avatar');
            $table->timestamp('item_created')
            ->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->timestamp('item_deleted')
            ->nullable();

               //foreign key
          $table->integer('stu_id')->index()->unsigned();
          $table->integer('type_id')->index()->unsigned();
          
          $table->foreign('stu_id')->references('stu_id')->on('students')->onDelete('cascade');
          $table->foreign('type_id')->references('type_id')->on('types')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
