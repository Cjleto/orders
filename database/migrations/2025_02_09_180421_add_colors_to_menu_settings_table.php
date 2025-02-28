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
        Schema::table('menu_settings', function (Blueprint $table) {
            $table->string('tertiary_color')->nullable()->after('secondary_color');
            $table->string('quaternary_color')->nullable()->after('tertiary_color');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menu_settings', function (Blueprint $table) {
            $table->dropColumn('tertiary_color');
            $table->dropColumn('quaternary_color');
        });
    }
};
