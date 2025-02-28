<?php

use App\Enums\CompanyType;
use App\Enums\CompanyStatus;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('address');
            $table->string('slug');
            $table->date('expiration_date');
            $table->foreignId('user_id')->constrained('users');
            $table->string('status')->default(CompanyStatus::ACTIVE->value);
            $table->string('type')->default(CompanyType::GENERICO);
            $table->string('google_review_link')->nullable();
            $table->string('facebook_link')->nullable();
            $table->string('instagram_link')->nullable();
            $table->string('site_link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
