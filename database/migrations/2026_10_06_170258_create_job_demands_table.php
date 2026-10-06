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
        Schema::create('job_demands', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('category_id')->nullable()->constrained('job_categories')->nullOnDelete();
            $table->string('slug')->unique();
            $table->json('title');
            $table->string('company_name')->nullable();
            $table->integer('positions')->default(1);
            $table->decimal('salary_min', 12, 2)->nullable();
            $table->decimal('salary_max', 12, 2)->nullable();
            $table->char('salary_currency', 3)->default('BDT');
            $table->integer('contract_months')->nullable();
            $table->json('benefits')->nullable();
            $table->json('requirements')->nullable();
            $table->json('required_documents')->nullable();
            $table->decimal('estimated_total_cost', 12, 2)->nullable();
            $table->json('service_charge_note')->nullable();
            $table->string('demand_ref')->nullable();
            $table->date('application_deadline')->nullable();
            $table->string('status')->default('open');
            $table->boolean('is_published')->default(true);
            $table->string('cover_image')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->index(['status', 'application_deadline']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_demands');
    }
};
