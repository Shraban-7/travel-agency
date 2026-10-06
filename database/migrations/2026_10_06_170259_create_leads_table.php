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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('service_type')->default('other');
            $table->foreignId('interested_country_id')->nullable()->constrained('countries')->nullOnDelete();
            $table->nullableMorphs('interested_item');
            $table->text('message')->nullable();
            $table->string('source')->default('web_form');
            $table->json('utm')->nullable();
            $table->string('status')->default('new');
            $table->foreignId('assigned_to')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('follow_up_at')->nullable();
            $table->string('lost_reason')->nullable();
            $table->string('ip', 45)->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->index('phone');
            $table->index(['status', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
