<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlotContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blot_contacts', function (Blueprint $table) { 

            $table->bigIncrements('id');
            $table->string('con_company')->comment("회사명");
            $table->string('con_department')->comment("담당부서")->nullable(); 
            $table->string('con_manager')->comment("담당자")->nullable(); 
            $table->integer('con_tel')->comment("연락처")->nullable(); 
            $table->string('con_email')->comment("이메일")->nullable(); 
            $table->string('con_url')->comment("홈페이지URL")->nullable(); 
            $table->string('con_address')->comment("회사주소")->nullable(); 
            
            $table->string('con_service')->comment("신청 서비스")->nullable(); 
            $table->string('con_referrence01')->comment("참고사이트01")->nullable(); 
            $table->string('con_referrence02')->comment("참고사이트02")->nullable(); 
            $table->string('con_date')->comment("오픈예상일")->nullable(); 
            $table->string('con_budget')->comment("예산")->nullable(); 
            $table->string('con_page')->comment("예상페이지수")->nullable(); 
            $table->string('con_etc')->comment("기타문의사항")->nullable(); 
            $table->longtext('con_file01')->comment("첨부파일01")->nullable(); 
            $table->longtext('con_file02')->comment("첨부파일02")->nullable(); 
            $table->string('con_answerYN')->comment("답변여부")->nullable()->default('N'); 
            $table->longtext('con_answer')->comment("답변")->nullable(); 
            $table->string('con_answer_id')->comment("답변자")->nullable(); 
            $table->timestamp('con_answer_date')->comment("답변일자")->nullable();        
            
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
        Schema::dropIfExists('blot_contacts');
    }
}
