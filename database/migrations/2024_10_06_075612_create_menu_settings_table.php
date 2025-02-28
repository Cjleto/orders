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
        Schema::create('menu_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->string('primary_color')->nullable();
            $table->string('secondary_color')->nullable();
            $table->string('title')->nullable();
            $table->float('background_opacity')->nullable();
            $table->string('template')->default('template1');
            $table->string('selected_font')->default('Arial');
            $table->string('text_footer')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_settings');
    }
};
