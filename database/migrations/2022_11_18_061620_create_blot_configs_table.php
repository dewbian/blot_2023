<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlotConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blot_configs', function (Blueprint $table) { 
            $table->string('cf_title');
            $table->string('cf_admin_email')->unique();
            $table->string('cf_admin_email_name');
            $table->string('cf_sns_thumbnail');
            $table->string('cf_favicon_img');
            $table->string('cf_allow_ip');
            $table->string('cf_block_ip');
            $table->string('cf_analysis_script');
            $table->string('cf_add_meta');
            $table->rememberToken();
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
        Schema::dropIfExists('blot_configs');
    }
}
