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
        Schema::create('consulting_engineers', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('consulting_company_id');
            $table->foreign('consulting_company_id')->references('id')->on('consulting_companies')->cascadeOnDelete();
            $table->integer('engineer_specialization_id');
            $table->foreign('engineer_specialization_id')->references('id')->on('engineer_specializations');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consulting_engineers');
    }
};
