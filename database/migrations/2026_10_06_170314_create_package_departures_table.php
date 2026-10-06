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
        Schema::create('package_departures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_id')->constrained()->cascadeOnDelete();
            $table->date('departure_date');
            $table->date('return_date')->nullable();
            $table->integer('seats_total')->default(0);
            $table->integer('seats_booked')->default(0);
            $table->decimal('price', 12, 2)->nullable();
            $table->date('booking_deadline')->nullable();
            $table->string('status')->default('open');
            $table->timestamps();
            $table->index(['departure_date', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_departures');
    }
};
