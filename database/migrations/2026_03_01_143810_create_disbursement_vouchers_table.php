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
        Schema::create('disbursement_vouchers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('obligation_request_id')->unique()->constrained('obligation_requests')->cascadeOnDelete();
            $table->string('dv_number')->unique();
            $table->decimal('net_amount', 15, 2);
            $table->string('payment_mode');
            $table->string('check_ada_number')->nullable();
            $table->date('dv_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disbursement_vouchers');
    }
};
