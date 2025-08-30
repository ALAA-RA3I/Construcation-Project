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
        Schema::table('tickets', function (Blueprint $table) {
            // فقط أعمدة عادية، ما في علاقات FK

            if (!Schema::hasColumn('tickets', 'created_by')) {
                $table->unsignedBigInteger('created_by')->after('status');
            }

            if (!Schema::hasColumn('tickets', 'assigned_to')) {
                $table->unsignedBigInteger('assigned_to')->after('created_by');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            if (Schema::hasColumn('tickets', 'created_by')) {
                $table->dropColumn('created_by');
            }

            if (Schema::hasColumn('tickets', 'assigned_to')) {
                $table->dropColumn('assigned_to');
            }
        });
    }
};
