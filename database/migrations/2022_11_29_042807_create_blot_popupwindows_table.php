<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlotPopupwindowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blot_popupwindows', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->tinyInteger('pop_mobile')->default('1');
            $table->tinyInteger('pop_web')->default('1');
            
            $table->timestamp('pop_begin_time');
            $table->timestamp('pop_end_time');
            $table->integer('pop_disable_hours');
            $table->tinyInteger('pop_invisible')->default('1');

            
            $table->integer('pop_height');
            $table->integer('pop_width')->nullable(); 
            $table->integer('pop_left')->nullable(); 
            $table->integer('pop_top')->nullable();

            $table->string('title', 200);   
            $table->string('content');

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
        Schema::dropIfExists('blot_popupwindows');
    }
}
