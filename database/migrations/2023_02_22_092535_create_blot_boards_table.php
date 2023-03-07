<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlotBoardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blot_boards', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('bo_table');
            $table->string('bo_subject', 100); 
            $table->string('bo_category');            
            $table->integer('bo_list_count');
            $table->string('bo_skin');   
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
        Schema::dropIfExists('blot_boards');
    }
}
