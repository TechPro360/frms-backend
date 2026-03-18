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
        Schema::create('uacs_objects', function (Blueprint $table) {
            $table->id();
            $table->string('object_code')->nullable(); // Parked strictness
            $table->string('account_title');
            $table->foreignId('parent_object_id')->nullable()->constrained('uacs_objects')->restrictOnDelete();
            $table->boolean('is_sub_object')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uacs_objects');
    }
};
