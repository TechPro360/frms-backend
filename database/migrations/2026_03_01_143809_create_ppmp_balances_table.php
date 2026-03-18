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
        Schema::create('ppmp_balances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ppmp_item_id')->unique()->constrained('ppmp_items')->cascadeOnDelete();
            $table->decimal('total_allocated', 15, 2)->default(0);
            $table->decimal('obligated_amount', 15, 2)->default(0); // Deducted at Box B
            $table->decimal('remaining_balance', 15, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppmp_balances');
    }
};
