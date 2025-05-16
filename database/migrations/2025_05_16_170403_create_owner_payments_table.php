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
        Schema::create('owner_payments', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('cost');
            $table->date('date_of_payment');
            $table->integer('owner_id');
            $table->foreign('owner_id')->references('id')->on('owners')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('owner_payments');
    }
};
