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
        Schema::create('obligation_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('obligation_request_id')->constrained('obligation_requests')->cascadeOnDelete();
            $table->foreignId('ppmp_item_id')->constrained('ppmp_items')->restrictOnDelete();
            $table->decimal('amount_charged', 15, 2);
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('obligation_details');
    }
};
