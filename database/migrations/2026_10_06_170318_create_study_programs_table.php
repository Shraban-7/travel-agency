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
        Schema::create('study_programs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('university_id')->constrained('universities')->cascadeOnDelete();
            $table->json('name');
            $table->string('level')->default('bachelor');
            $table->string('field')->nullable();
            $table->string('duration')->nullable();
            $table->decimal('tuition_fee', 12, 2)->nullable();
            $table->char('currency', 3)->default('BDT');
            $table->string('language')->nullable();
            $table->json('requirements')->nullable();
            $table->json('scholarship_info')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('study_programs');
    }
};
