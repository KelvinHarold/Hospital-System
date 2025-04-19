<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHealthTipsTable extends Migration
{
    public function up()
    {
        Schema::create('health_tips', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->enum('target_type', ['pregnant', 'breastfeeding', 'children', 'general'])->default('general');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('health_tips');
    }
}
