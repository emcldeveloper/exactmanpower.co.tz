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
        Schema::create('seo_pages', function (Blueprint $table) {
            $table->id();
            // Example: home, services, eor, recruitment
            $table->string('page_key')->unique();

            $table->string('title', 255);
            $table->text('description')->nullable();

            $table->string('canonical_url')->nullable();

            $table->string('og_title', 255)->nullable();
            $table->text('og_description')->nullable();
            $table->string('og_image')->nullable();

            // Schema.org JSON-LD
            $table->json('schema')->nullable();

            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seo_pages');
    }
};
