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
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->string('session_id'); // Per evitare duplicati nella stessa sessione
            $table->string('ip_address')->nullable(); // Per ulteriore controllo
            $table->string('user_agent')->nullable(); // Per identificare il dispositivo
            $table->string('route'); // Rotta visitata
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};
