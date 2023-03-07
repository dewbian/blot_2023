<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlotBoardAttachesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blot_board_attaches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('content_id');
            $table->longtext('file_url')->nullable();  
            $table->integer('download')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blot_board_attaches');
    }
}
