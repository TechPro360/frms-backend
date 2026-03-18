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
        Schema::create('ppmp_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('procurement_plan_ppmp_id')->constrained('procurement_plan_ppmps')->cascadeOnDelete();
            $table->foreignId('uacs_object_id')->constrained('uacs_objects')->restrictOnDelete();
            $table->string('description');
            $table->decimal('estimated_cost', 15, 2);
            $table->integer('quantity');
            $table->decimal('unit_cost', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppmp_items');
    }
};
