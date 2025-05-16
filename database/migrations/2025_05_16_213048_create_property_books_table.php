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
        Schema::create('property_books', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('area');
            $table->integer('number_of_room');
            $table->integer('floor');
            $table->integer('cost');
            $table->string('description');
            $table->string('payment_period');
            $table->integer('project_id');
            $table->foreign('project_id')->references('id')->on('projects')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_books');
    }
};
