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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_id')->constrained('applications')->cascadeOnDelete();
            $table->foreignId('client_id')->constrained('clients')->cascadeOnDelete();
            $table->decimal('amount', 12, 2);
            $table->char('currency', 3)->default('BDT');
            $table->string('method')->default('cash');
            $table->string('reference_no')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->string('type')->default('installment');
            $table->string('receipt_no')->unique();
            $table->foreignId('received_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('note')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
