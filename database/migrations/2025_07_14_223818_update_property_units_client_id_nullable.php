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
        Schema::table('property_units', function (Blueprint $table) {
            // Drop the existing foreign key constraint if it exists
            $table->dropForeign(['client_id']);

            // Modify the client_id column to be nullable
            $table->integer('client_id')->nullable()->change();

            // Recreate the foreign key constraint
            $table->foreign('client_id')->references('id')->on('clients')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('property_units', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['client_id']);

            // Change client_id back to not nullable
            $table->integer('client_id')->nullable(false)->change();

            // Recreate the foreign key constraint
            $table->foreign('client_id')->references('id')->on('clients')->cascadeOnDelete();
        });
    }
};
