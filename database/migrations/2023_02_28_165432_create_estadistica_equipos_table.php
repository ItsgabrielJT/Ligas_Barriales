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
        Schema::create('estadistica_equipos', function (Blueprint $table) {
            $table->id();
            $table->integer('total_disparos')->unsigned();
            $table->integer('total_pases')->unsigned();
            $table->integer('posesion')->unsigned();
            $table->integer('tiros_esquina')->unsigned();
            $table->integer('pases_fallidos')->unsigned();
            $table->integer('tiros_fallidos')->unsigned();
            $table->foreignId('calendario_id')->constrained('calendarios');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estadistica_equipos');
    }
};
