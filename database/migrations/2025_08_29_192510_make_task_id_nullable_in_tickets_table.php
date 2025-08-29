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
            // Drop the foreign key first
            $table->dropForeign(['task_id']);

            // Make column nullable
            $table->integer('task_id')->nullable()->change();

            // Re-add foreign key (with cascade if needed)
            $table->foreign('task_id')
                ->references('id')
                ->on('tasks')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            // Drop foreign key first
            $table->dropForeign(['task_id']);

            // Revert column back to NOT NULL
            $table->integer('task_id')->nullable(false)->change();

            // Re-add foreign key
            $table->foreign('task_id')
                ->references('id')
                ->on('tasks')
                ->cascadeOnDelete();
        });
    }
};
