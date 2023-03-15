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
        Schema::create('estadistica_jugadors', function (Blueprint $table) {
            $table->id();
            $table->integer('goles')->unsigned();
            $table->integer('remates')->unsigned();
            $table->integer('asistencias')->unsigned();
            $table->foreignId('calendario_id')->constrained('calendarios');
            $table->foreignId('sanciones_id')->constrained('sancions')->nullable();
            $table->foreignId('jugador_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estadistica_jugadors');
    }
};
