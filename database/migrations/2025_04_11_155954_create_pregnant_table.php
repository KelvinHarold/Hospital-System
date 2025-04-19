<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePregnantTable extends Migration
{
    public function up()
    {
        Schema::create('pregnant', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('full_name');
            $table->integer('age');
            $table->integer('pregnancy_week');
            $table->date('expected_delivery_date');
            $table->text('health_conditions')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pregnant');
    }
}
