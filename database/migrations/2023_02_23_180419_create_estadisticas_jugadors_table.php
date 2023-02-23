<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('estadisticas_jugadors', function (Blueprint $table) {
            $table->id();
            $table->integer('goles')->unsigned();
            $table->integer('remates')->unsigned();
            $table->integer('asistencias')->unsigned();
            $table->foreignId('torneo_id')->constrained('torneos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estadisticas_jugadors');
    }
};
