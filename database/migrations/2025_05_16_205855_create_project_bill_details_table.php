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
        Schema::create('project_bill_details', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('item');
            $table->integer('quantity');
            $table->integer('cost');
            $table->integer('project-bills-id');
            $table->foreign('project-bills-id')->references('id')->on('project_bills')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_bill_details');
    }
};
