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
        Schema::create('study_intakes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_id')->constrained('study_programs')->cascadeOnDelete();
            $table->string('intake_name');
            $table->date('start_date')->nullable();
            $table->date('application_deadline')->nullable();
            $table->integer('seats')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('study_intakes');
    }
};
