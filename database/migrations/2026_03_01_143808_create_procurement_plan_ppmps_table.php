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
        Schema::create('procurement_plan_ppmps', function (Blueprint $table) {
            $table->id();
            $table->string('ppmp_number'); // Auto-gen
            $table->foreignId('responsibility_center_id')->constrained('responsibility_centers')->restrictOnDelete();
            $table->foreignId('fund_cluster_id')->constrained('fund_clusters')->restrictOnDelete();
            $table->integer('fiscal_year');
            $table->string('mfo_pap_code')->nullable();
            $table->decimal('estimated_cost', 15, 2)->default(0);
            $table->string('status')->default('Draft'); // Draft, Approved, Cancelled
            $table->foreignId('parent_ppmp_id')->nullable()->constrained('procurement_plan_ppmps')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('procurement_plan_ppmps');
    }
};
