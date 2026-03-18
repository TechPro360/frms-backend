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
        Schema::create('collections', function (Blueprint $table) {
            $table->id();
            $table->string('or_number')->unique();
            $table->date('date');
            $table->decimal('amount', 15, 2);
            $table->foreignId('fund_cluster_id')->constrained('fund_clusters')->restrictOnDelete();
            $table->foreignId('payee_payor_id')->constrained('payee_payors')->restrictOnDelete();
            $table->foreignId('uacs_object_id')->nullable()->constrained('uacs_objects')->restrictOnDelete();
            $table->string('details')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collections');
    }
};
