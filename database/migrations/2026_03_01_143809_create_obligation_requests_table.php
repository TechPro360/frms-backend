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
        Schema::create('obligation_requests', function (Blueprint $table) {
            $table->id();
            $table->string('serial_number'); // Auto Formatted based on rules
            $table->foreignId('procurement_plan_ppmp_id')->constrained('procurement_plan_ppmps')->restrictOnDelete();
            $table->foreignId('payee_payor_id')->constrained('payee_payors')->restrictOnDelete();
            $table->foreignId('requestor_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('certified_box_a_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('certified_box_b_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->decimal('requested_amount', 15, 2);
            $table->string('status')->default('Draft'); // Tracks Box A, Box B, Cancelled, etc.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('obligation_requests');
    }
};
