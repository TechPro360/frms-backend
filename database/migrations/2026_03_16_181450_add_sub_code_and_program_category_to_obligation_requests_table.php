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
        Schema::table('obligation_requests', function (Blueprint $table) {
            $table->string('sub_code')->nullable()->after('serial_number'); // A, B, C suffixes
            $table->string('program_category')->nullable()->after('sub_code'); // GAS, STN, M&E, Research, Extension (Fund 101)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('obligation_requests', function (Blueprint $table) {
            $table->dropColumn(['sub_code', 'program_category']);
        });
    }
};
