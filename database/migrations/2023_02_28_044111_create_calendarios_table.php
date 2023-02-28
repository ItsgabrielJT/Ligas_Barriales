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
        Schema::create('calendarios', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha_partido');    
            $table->foreignId('local_id')->constrained('equipos');
            $table->foreignId('visitante_id')->constrained('equipos');
            $table->foreignId('torneo_id')->constrained('torneos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calendarios');
    }
};
