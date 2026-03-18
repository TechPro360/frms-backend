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
        Schema::create('fund_transaction_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fund_cluster_id')->constrained('fund_clusters')->cascadeOnDelete();
            $table->string('required_document_type'); // "ORS" or "BURS"
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fund_transaction_types');
    }
};
