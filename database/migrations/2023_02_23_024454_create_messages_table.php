<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('idx');
            $table->unsignedBigInteger('from');
            $table->unsignedBigInteger('to');
            $table->string('text');
            $table->timestamps();

            
            $table->foreign('from')->references('id')-> on ( 'users');
            $table->foreign('to')   ->references('id')  -> on ('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
