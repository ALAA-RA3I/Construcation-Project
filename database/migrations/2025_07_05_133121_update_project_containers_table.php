<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('project_containers', function (Blueprint $table) {
            // Drop unwanted columns
            $table->dropColumn(['remaining-quantity', 'required-quantity']);
        });

        Schema::table('project_containers', function (Blueprint $table) {
            // Rename columns
            $table->renameColumn('quantity-available', 'quantity_available');
            $table->renameColumn('expected-quantity', 'expected_quantity');
            $table->renameColumn('consumed-quantity', 'consumed_quantity');
        });

        Schema::table('project_containers', function (Blueprint $table) {
            // Add unique constraint
            $table->unique(['project_id', 'items_id']);
        });
    }

    public function down()
    {
        Schema::table('project_containers', function (Blueprint $table) {
            $table->dropUnique(['project_id', 'items_id']);

            // Revert to integer (default null)
            $table->integer('quantity_available')->nullable()->change();
            $table->integer('expected_quantity')->nullable()->change();
            $table->integer('consumed_quantity')->nullable()->change();

            // Rename columns back
            $table->renameColumn('quantity_available', 'quantity-available');
            $table->renameColumn('expected_quantity', 'expected-quantity');
            $table->renameColumn('consumed_quantity', 'consumed-quantity');

            // Re-add dropped columns
            $table->integer('remaining-quantity')->nullable();
            $table->integer('required-quantity')->nullable();
        });
    }
};
