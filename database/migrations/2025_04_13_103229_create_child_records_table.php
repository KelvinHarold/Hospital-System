<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildRecordsTable extends Migration
{
    public function up()
    {
        Schema::create('child_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_id')->constrained()->onDelete('cascade');
            $table->date('record_date')->default(now());
            $table->float('weight');
            $table->float('height');
            $table->float('head_circumference');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('child_records');
    }
}
