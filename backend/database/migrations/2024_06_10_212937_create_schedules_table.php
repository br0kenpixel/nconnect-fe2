<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string("title", 64);
            $table->text("description");
            $table->time("start");
            $table->time("end");
            $table->unsignedBigInteger("speaker")->nullable();
            $table->unsignedBigInteger("stage");
            $table->unsignedInteger("seats");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
