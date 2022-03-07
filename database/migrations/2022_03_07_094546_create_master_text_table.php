<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterTextTable extends Migration
{
    public function up()
    {
        Schema::create('master_text', function (Blueprint $table) {
            $table->string('text_id')->charset('utf8');
            $table->unsignedTinyInteger('region');
            $table->string('message_text')->charset('utf8');
            $table->primary(['text_id','region']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('master_text');
    }
}
