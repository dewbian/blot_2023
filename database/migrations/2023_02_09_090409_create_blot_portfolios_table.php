<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlotPortfoliosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blot_portfolios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('po_type');
            $table->string('po_subject');
            $table->timestamp('po_begin_time')->nullable();
            $table->timestamp('po_end_time')->nullable();
            $table->string('po_client', 200)->nullable();
            $table->string('po_client_url', 200)->nullable();
            $table->string('po_tag', 200)->nullable();
            $table->integer('po_order')->nullable();
            $table->longtext('po_thumnail')->nullable();
            $table->string('po_head_summary')->nullable();
            $table->string('po_head_descript')->nullable();             
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
        Schema::dropIfExists('blot_portfolios');
    }
}
