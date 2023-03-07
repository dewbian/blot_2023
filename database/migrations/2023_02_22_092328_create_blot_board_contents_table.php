<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlotBoardContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blot_board_contents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('bo_id')->comment("게시판아이디");
            $table->integer('member_id')->comment("등록아이디");
            $table->string('title', 100)->nullable();
            $table->longtext('content')->nullable();
            $table->integer('view')->default('0');
            $table->string('category1')->nullable();
            $table->string('category2')->nullable(); 
            $table->string('notice', 5)->nullable(); 
            $table->integer('order')->default('0');
            $table->string('trash', 2)->default('Y');
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
        Schema::dropIfExists('blot_board_contents');
    }
}
