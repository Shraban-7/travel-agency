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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('tracking_code')->unique();
            $table->foreignId('client_id')->constrained('clients')->cascadeOnDelete();
            $table->string('service_type')->default('other');
            $table->nullableMorphs('applicable');
            $table->foreignId('country_id')->nullable()->constrained('countries')->nullOnDelete();
            $table->string('status')->default('submitted');
            $table->string('status_label')->nullable();
            $table->foreignId('assigned_to')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('submitted_at')->nullable();
            $table->decimal('total_fee', 12, 2)->default(0);
            $table->decimal('paid_amount', 12, 2)->default(0);
            $table->decimal('due_amount', 12, 2)->default(0);
            $table->text('remarks_internal')->nullable();
            $table->text('public_note')->nullable();
            $table->timestamp('closed_at')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->index(['status', 'service_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
