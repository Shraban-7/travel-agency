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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('full_name_bn')->nullable();
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('gender')->nullable();
            $table->date('dob')->nullable();
            $table->text('nid_no')->nullable();
            $table->string('nid_no_hash', 64)->nullable()->index();
            $table->text('passport_no')->nullable();
            $table->string('passport_no_hash', 64)->nullable()->index();
            $table->date('passport_expiry')->nullable();
            $table->text('address')->nullable();
            $table->string('district')->nullable();
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_phone')->nullable();
            $table->foreignId('lead_id')->nullable()->constrained('leads')->nullOnDelete();
            $table->text('notes')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->index('phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
