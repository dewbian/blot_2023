<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlotRecruitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blot_recruits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('rec_type')->comment("구분");
            $table->string('rec_department')->comment("지원분야")->nullable(); 
            $table->string('rec_name')->comment("지원자명")->nullable(); 
            $table->integer('rec_tel')->comment("연락처")->nullable(); 
            $table->string('rec_email')->comment("이메일")->nullable(); 
            $table->string('rec_date')->comment("출근가능일")->nullable(); 
            $table->string('rec_content')->comment("상세내용")->nullable(); 
            $table->string('rec_file')->comment("파일")->nullable(); 
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
        Schema::dropIfExists('blot_recruits');
    }
}
