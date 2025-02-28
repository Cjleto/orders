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
        Schema::create('translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('translatable_id');
            $table->string('translatable_type'); // Nome del modello (Dish, Category, ecc.)
            $table->string('locale'); // Codice lingua ('en', 'it', 'fr', ecc.)
            $table->string('field'); // Campo tradotto (es. 'description', 'name')
            $table->text('value'); // Testo tradotto
            $table->timestamps();

            $table->unique(['translatable_id', 'translatable_type', 'locale', 'field'], 'translatable_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('translations');
    }
};
