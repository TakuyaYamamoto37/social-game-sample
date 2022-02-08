<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterLoginItemTable extends Migration
{
    public function up()
    {
        Schema::create('master_login_item', function (Blueprint $table) {
			$table->unsignedInteger('login_day')->default(0);
            $table->unsignedInteger('item_type')->default(0);
            $table->unsignedInteger('item_count')->default(0);
            $table->primary('login_day');
        });
    }

    public function down()
    {
        Schema::dropIfExists('master_login_item');
    }
}
