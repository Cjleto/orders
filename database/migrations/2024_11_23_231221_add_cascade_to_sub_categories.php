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
        Schema::table('sub_categories', function (Blueprint $table) {
            // Rimuovi il vincolo esistente
            $table->dropForeign(['category_id']);

            // Aggiungi il nuovo vincolo con ON DELETE CASCADE
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sub_categories', function (Blueprint $table) {
            // Rimuovi il vincolo aggiornato
            $table->dropForeign(['category_id']);

            // Ripristina il vincolo originale senza ON DELETE CASCADE
            $table->foreign('category_id')
                ->references('id')
                ->on('categories');
        });
    }
};
