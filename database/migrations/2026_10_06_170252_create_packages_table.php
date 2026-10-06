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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->nullable()->constrained('services')->nullOnDelete();
            $table->string('slug')->unique();
            $table->string('type')->default('other');
            $table->json('title');
            $table->json('summary')->nullable();
            $table->json('description')->nullable();
            $table->json('itinerary')->nullable();
            $table->json('inclusions')->nullable();
            $table->json('exclusions')->nullable();
            $table->integer('duration_days')->nullable();
            $table->decimal('base_price', 12, 2)->default(0);
            $table->char('currency', 3)->default('BDT');
            $table->json('price_note')->nullable();
            $table->json('hotel_info')->nullable();
            $table->string('airline')->nullable();
            $table->string('cover_image')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_published')->default(true);
            $table->integer('sort_order')->default(0);
            $table->json('seo_title')->nullable();
            $table->json('seo_desc')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
